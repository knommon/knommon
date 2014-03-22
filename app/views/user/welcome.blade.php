@extends('layouts/main')
@section('title')
	Welcome | @parent
@stop

@section('content')
	<div class="welcome">
		<?php if (Auth::check()): ?>
			<a href="/user/logout">Logout</a>
		<?php endif; ?>
		<h1>Welcome to Knommon!</h1>
		<pre><?php
			$social = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
			$provider = $social->authenticate('google');

			var_dump($provider->getAccessToken());
			$profile = $provider->getUserProfile();

			var_dump($profile);
		?></pre>
	</div>
@stop
