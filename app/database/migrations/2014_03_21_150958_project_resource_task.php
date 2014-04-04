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
		$type = Config::get('database.default');

		$resource_types = array('Article', 'Book', 'Course', 'Image', 'Text', 'Video', 'Other');

		Schema::create('projects', function($table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('title');
			$table->string('slug');
			$table->text('about');
			$table->string('tagline', 255);
			$table->timestamps();
		});

		Schema::create('resources', function($table) use ($resource_types, $type) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('name');
			if ($type != 'pgsql') {
				$table->enum('type', $resource_types);
			}
			$table->string('url', 2048);
			$table->unsignedInteger('votes');
			$table->text('body');
			$table->timestamps();
		});

		if ($type == 'pgsql') {
			$enum = "'" . implode("', '", $resource_types) . "'";
			DB::statement("DROP TYPE IF EXISTS resource_type;");
			DB::statement("CREATE TYPE resource_type AS ENUM ({$enum});");
			DB::statement("ALTER TABLE resources ADD COLUMN type resource_type;");
		}

		//@todo: add dependencies and blockers?
		Schema::create('tasks', function($table){
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('title');
			$table->text('description');
			$table->dateTime('taskstart');
			$table->dateTime('taskend');
			$table->unsignedInteger('project_id');
			$table->foreign('project_id')->references('id')->on('projects');
			$table->timestamps();
		});

		Schema::create('project_resource', function($table) {
			$table->increments('id');
			$table->unsignedInteger('project_id');
			$table->foreign('project_id')->references('id')->on('projects');
			$table->unsignedInteger('resource_id');
			$table->foreign('resource_id')->references('id')->on('resources');
			$table->unique(array('project_id', 'resource_id')); //felixkiss/uniquewith-validator
		});

	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$type = Config::get('database.default');

		Schema::dropIfExists('tasks');
		Schema::dropIfExists('project_resource');
		Schema::dropIfExists('projects');
		Schema::dropIfExists('resources');

		if ($type == 'pgsql') {
			DB::statement("DROP TYPE IF EXISTS resource_type;");
		}
	}

}
