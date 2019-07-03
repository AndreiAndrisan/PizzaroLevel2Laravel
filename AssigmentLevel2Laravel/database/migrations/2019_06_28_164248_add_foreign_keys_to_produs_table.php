<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProdusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('produs', function(Blueprint $table)
		{
			$table->foreign('categorie', 'produs_ibfk_1')->references('nume')->on('categorie')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('produs', function(Blueprint $table)
		{
			$table->dropForeign('produs_ibfk_1');
		});
	}

}
