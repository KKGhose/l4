<?php

use Illuminate\Database\Migrations\Migration;

class AddUserAgentColumnToAccessLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('accessLogs', function($table)
		{
			$table->string('user_agent')->after('host');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('accessLogs', function($table)
		{
			$table->dropColumn('user_agent');
		});
	}

}