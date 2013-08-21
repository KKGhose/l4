<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cartItems', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('cart_id');
			$table->integer('product_id');
			$table->integer('quantity')->notNullable()->default(1);
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
