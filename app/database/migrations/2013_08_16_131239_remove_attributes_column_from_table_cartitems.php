<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveAttributesColumnFromTableCartItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cartItems', function(Blueprint $table) {
			$table->dropColumn('attributes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cartItems', function(Blueprint $table) {
			$table->text('attributes');
		});
	}

}
