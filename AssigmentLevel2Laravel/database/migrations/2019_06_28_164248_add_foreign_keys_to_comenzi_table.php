<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComenziTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('comenzi', function(Blueprint $table)
		{
			$table->foreign('id_order', 'comenzi_ibfk_1')->references('id')->on('client')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_produs', 'comenzi_ibfk_2')->references('id')->on('produs')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comenzi', function(Blueprint $table)
		{
			$table->dropForeign('comenzi_ibfk_1');
			$table->dropForeign('comenzi_ibfk_2');
		});
	}

}
