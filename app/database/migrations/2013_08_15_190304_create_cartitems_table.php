<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cartItems', function(Blueprint $table) {
			$table->increments('id');
			$table->string('cart_id');
			$table->integer('product_id');
			$table->text('attributes');
			$table->integer('quantity');
			$table->boolean('buy_now');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cartItems');
	}

}
