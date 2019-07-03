<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComenziTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comenzi', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_order')->index('id_client');
			$table->integer('id_produs')->index('id_produs');
			$table->integer('q_produs');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comenzi');
	}

}
