<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectResourceTask extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function($table){
			$table->increments('id');
			$table->string('title');
			$table->text('about');
			$table->timestamps();
		});

		Schema::create('resources', function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('type');
			$table->string('url');
			$table->text('about');
			$table->timestamps();
		});

		Schema::create('task', function($table){
			$table->increments('id');
			$table->string('title');
			$table->text('description');
			$table->dateTime('taskstart');
			$table->dateTime('taskend');
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('projects');
			$table->timestamps();
		});

		Schema::create('project_resource', function($table){
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('projects');
			$table->integer('resource_id')->unsigned();
			$table->foreign('resource_id')->references('id')->on('resources');
		});

			}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
		Schema::drop('resources');
		Schema::drop('tasks');
		Schema::drop('project_resource');
	}

}
