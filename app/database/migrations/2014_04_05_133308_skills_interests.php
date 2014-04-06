<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SkillsInterests extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('skills', function($table){
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->unique('user_id');
		});

		Schema::create('interests', function($table){
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->unique('user_id');
		});

		Schema::table('users', function($table){
			$table->text('about')->nullable()->default(NULL);
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
			{
    			$table->dropColumn('about');
			});
		Schema::dropIfExists('interests');
		Schema::dropIfExists('skills');
	}

}
