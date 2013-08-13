<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropLastAccessColumnFromAccessLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('accessLogs', function(Blueprint $table) {
			
			$table->dropColumn('last_access');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('accessLogs', function(Blueprint $table) {

			$table->date('last_access')->default(date("Y-m-d H:i:s"))->after('host');
			
		});
	}

}
