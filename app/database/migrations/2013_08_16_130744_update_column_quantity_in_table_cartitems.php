<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateColumnQuantityInTableCartitems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::unprepared('ALTER TABLE cartItems CHANGE COLUMN quantity quantity INT NOT NULL DEFAULT 1');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::unprepared('ALTER TABLE cartItems CHANGE COLUMN quantity quantity INT DEFAULT NULL');
	}

}
