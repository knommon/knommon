<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$type = ($this->connection) ? $this->connection : Config::get('database.default');

		$providers = array('Facebook', 'Google', 'Twitter', 'Yahoo', 'Github', 'LinkedIn');

		Schema::create('accounts', function(Blueprint $table) use ($type, $providers) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('provider_uid', 255);
			if ($type != 'pgsql') {
				$table->enum('provider', $providers);
			}
			$table->string('first_name', 64)->nullable()->default(null);
			$table->string('last_name', 64)->nullable()->default(null);
			$table->string('email', 128)->nullable()->default(null);
			$table->char('gender', 1)->nullable()->default(null);
			$table->string('profile_url', 255)->nullable()->default(null);
			$table->string('photo_url', 255)->nullable()->default(null);
			$table->string('website_url', 255)->nullable()->default(null);
			$table->string('language', 8)->nullable()->default(null);
			$table->date('birthday')->nullable()->default(null);
			$table->string('address', 64)->nullable()->default(null);
			$table->string('country', 32)->nullable()->default(null);
			$table->string('region', 32)->nullable()->default(null);
			$table->string('city', 32)->nullable()->default(null);
			$table->string('zip', 16)->nullable()->default(null);
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));;
			$table->string('access_token', 255)->nullable();
			$table->timestamp('expires_at')->nullable();
		});

		if ($type == 'pgsql') {
			$enum = "'" . implode("', '", $providers) . "'";
			DB::statement("DROP TYPE IF EXISTS providers;");
			DB::statement("CREATE TYPE providers AS ENUM ({$enum});");
			DB::statement("ALTER TABLE accounts ADD COLUMN provider providers;");
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$type = ($this->connection) ? $this->connection : Config::get('database.default');

		Schema::dropIfExists('accounts_user_id_foreign');
		Schema::dropIfExists('accounts');

		if ($type == 'pgsql') {
			DB::statement("DROP TYPE IF EXISTS providers;");
		}
	}

}