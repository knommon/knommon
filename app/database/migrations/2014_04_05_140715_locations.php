<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Locations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// http://forumsarchive.laravel.io/viewtopic.php?id=5133
		Schema::create('locations', function(Blueprint $table) {
			$table->increments('id');
			$table->string('street_number', 32);
			$table->string('establishment', 128);
			$table->string('route', 128);
			$table->string('locality', 128);
			$table->string('administrative_area_level_3', 128);
			$table->string('administrative_area_level_2', 128);
			$table->string('administrative_area_level_1', 128);
			$table->string('state', 4);
			$table->string('country', 128);
			$table->string('postal_code', 16);
		});

		DB::statement("ALTER TABLE locations ADD COLUMN position point;");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('locations');
	}

}
