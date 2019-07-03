<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nume', 30);
			$table->string('prenume', 50);
			$table->string('email', 50);
			$table->string('telefon', 13);
			$table->string('strada', 75);
			$table->string('adresa', 75);
			$table->string('oras', 30);
			$table->string('judet', 30);
			$table->text('observatii', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('client');
	}

}
