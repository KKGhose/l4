<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProducts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->integer('product_type')->unsigned();
			$table->string('product_name', 255);
			$table->decimal('product_price');
			$table->string('product_language', 100);
			$table->text('product_description');
			$table->string('product_author', 255);
			$table->string('product_isbn10', 50);
			$table->smallInteger('quantity')->default(100);
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
		Schema::drop('products');
	}

}
