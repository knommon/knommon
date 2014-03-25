<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Defines the users table in the database.
	 * Using Migration allows this code to be cross platform.
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('fname', 20)->nullable()->default(null);
			$table->string('lname', 20)->nullable()->default(null);
			$table->string('email', 128)->unique();
			$table->char('password', 60)->nullable();
			//$table->string('photo_url', 2048)->nullable()->default(null);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}

}
