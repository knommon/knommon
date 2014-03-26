<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserRelations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//defines the user-to-project relationship
		Schema::create('members', function($table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->unsignedInteger('project_id');
			$table->foreign('project_id')->references('id')->on('projects');
			//$table->enum('role', array('Admin', 'Edit'));
			$table->unique(array('user_id', 'project_id')); //felixkiss/uniquewith-validator
		});

		//defines another user-to-project relationship
		Schema::create('follows', function($table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->unsignedInteger('project_id');
			$table->foreign('project_id')->references('id')->on('projects');
			$table->unique(array('user_id', 'project_id')); //felixkiss/uniquewith-validator
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('membership');
		Schema::dropIfExists('follow');
	}

}
