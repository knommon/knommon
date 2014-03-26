<?php

include_once 'UserController.php';

use Illuminate\Support\MessageBag;
use Jyggen\Curl\Curl;

/**
 * Defines social routes that can be used to register a new user,
 * login an existing user or add a social account to a signed in
 * user. The routes are the same for all of these actions.
 */
class SocialController extends Controller {

	public function getAuth() {
		try {
			Hybrid_Endpoint::process();
		} catch (Exception $e) {
			//redirect and try again
			$provider = Session::get('social_login');
			if (empty($provider)) {
				return Redirect::to('/');
			}
			return Redirect::action('SocialController@get' . $provider);
		}
		return;
	}

	public function getFacebook() {
		return $this->attemptLogin('Facebook');
	}

	public function getTwitter() {
		return $this->attemptLogin('Twitter');
	}

	public function getGoogle() {
		return $this->attemptLogin('Google');
	}

	/**
	 * @todo find a way to use a ?continue query parameter to change the default redirect
	 * 
	 * Tries to authenticate the user with the given $providerName, if successful logs
	 * the user in with the given social profile. If no user with a corresponding social
	 * profile exists in the database, then one is created and attached to this profile.
	 * @param string $providerName the provider's name supported by HybridAuth exactly
	 * with the first letter capital, and the rest lowercase
	 */
	protected function attemptLogin($providerName) {
		Session::put('social_login', $providerName);

		try {
			$hybridAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
			$provider = $hybridAuth->authenticate($providerName);

			$profile = $provider->getUserProfile();
			$token = $provider->getAccessToken();
			$token['expires_at'] = date('Y-m-d H:i:s', $token['expires_at']);

			//check if a social account exists in the database
			$result = DB::table('accounts')->select('id', 'user_id')
				->where('provider_uid', '=', $profile->identifier)
				->where('provider', '=', $providerName)
				->take(1)->first();

			$id;
			//couldn't find an account in the database
			if (count($result) == 0) {
				//create new user if not logged in
				$user = Auth::user();
				// check emails to avoid duplicates
				if ($user == null) {
					$user = User::where('email', $profile->email)->take(1)->first();
				}
				// still can't find a user, create one
				if ($user == null) {
					$user = new User;
					$user->fname = $profile->firstName;
					$user->lname = $profile->lastName;
					$user->email = $profile->email;
					$user->password = null;
					if ($profile->photoURL != null)
						$user->photo_url = $this->getPhoto($providerName, $profile->photoURL);
					$user->save();
				} else if ($user->photo_url == null && $profile->photoURL != null) {
					//we have a profile image to insert
					$user->photo_url = $this->getPhoto($providerName, $profile->photoURL);
					$user->save();
				}

				$id = $user->id;

				$this->createAccount($id, $providerName, $profile, $token);

				//should we have a welcome page specifically or set a bool welcome on user?
				//Auth::loginUsingId($id);
				//return Redirect::intended('user/welcome');
			} else {
				$id = $result->user_id;
				//update existing social account credentials
				$result = DB::table('accounts')
					->where('id', '=', $result->id)
					->update(array(
						'access_token' => $token['access_token'],
						'expires_at' => $token['expires_at']
					));
			}
			
			Auth::loginUsingId($id);

			return Redirect::intended('/');

		} catch (Exception $e) {
			$error = '';
			switch( $code = $e->getCode() ){ 
				case 0 : $error = "Unspecified error."; break;
				case 1 : $error = "Hybriauth configuration error."; break;
				case 2 : $error = "Provider not properly configured."; break;
				case 3 : $error = "Unknown or disabled provider."; break;
				case 4 : $error = "Missing provider application credentials."; break;
				case 5 : $error = "Authentication failed. The user has canceled the authentication or the provider refused the connection."; break;
				case 6 : $error = "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again."; 
					$adapter->logout(); 
					break;
				case 7 : $error = "User not connected to the provider."; 
					$adapter->logout(); 
					break;
			}

			//don't display these errors to the user, give a helpful hint instead
			$error .= "\n<b>Original error message:</b> " . $e->getMessage() . " on line (" . $e->getLine() . ")";
			Log::error($error);

			$msg = "Internal error. Please try a different sign-in method.";
			if ($code == 5 || $code == 6) {
				$msg = "Error connecting to {$providerName}, please try again.";
			}

			$errors = new MessageBag();
			$errors->add('error', $msg);

			return Redirect::back()->withErrors($errors);
		}
	}

	/**
	 * Create a new social account with the given user's profile and access token.
	 * @param  int $user_id      the User id from our database
	 * @param  string $providerName the provider's name that matches the providers type in the database
	 * @param  object Hybrid_User_Profile $profile
	 * @param  array oauth access $token
	 * @return boolean if the account was created successfully
	 */
	protected function createAccount($user_id, $providerName, $profile, $token) {

		$gender = empty($profile->gender) ? null : substr($profile->gender, 0, 1);
		$birthday = null;
		if ($profile->birthMonth != 0 && $profile->birthDay != 0 && $profile->birthYear != 0) {
			$birthday = date('Y-m-d', mktime(0, 0, 0, $profile->birthMonth, $profile->birthDay, $profile->birthYear));
		}

		return DB::table('accounts')->insert(array(
			'user_id' => $user_id,
			'provider' => $providerName,
			'provider_uid' => $profile->identifier,
			'first_name' => $profile->firstName,
			'last_name' => $profile->lastName,
			'email' => $profile->email,
			'gender' => $gender,
			'profile_url' => $profile->profileURL,
			'photo_url' => $profile->photoURL,
			'website_url' => $profile->webSiteURL,
			'language' => $profile->language,
			'birthday' => $birthday,
			'address' => $profile->address,
			'country' => $profile->country,
			'region' => $profile->region,
			'city' => $profile->city,
			'zip' => $profile->zip,
			'access_token' => $token['access_token'],
			'expires_at' => $token['expires_at'],
		));
	}

	protected function getPhoto($provider, $photoURL, $size = 100) {
		$url;
		switch ($provider) {
			case 'Google':
				$parts = explode('?sz=', $photoURL);
				$url = $parts[0] . '?sz=' . $size;
				break;
			case 'Facebook':
				$parts = explode('?', $photoURL);
				$url = $parts[0] . "?width={$size}&height={$size}";

				/*$cr = curl_init($url); 
				curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($cr, CURLOPT_FOLLOWLOCATION, 1);
				curl_exec($cr);
				$info = curl_getinfo($cr);
				$url = $info["url"];*/
				$request = new Jyggen\Curl\Request($url);
				$request->setOption(CURLOPT_FOLLOWLOCATION, true);
				$request->execute();
				$info = $request->getInfo();
				$url = $info['url'];

				break;
		}

		return $url;
	}
}
