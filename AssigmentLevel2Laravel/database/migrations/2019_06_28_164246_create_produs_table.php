<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nume', 50);
			$table->integer('pret');
			$table->string('descriere', 150);
			$table->string('categorie', 30)->index('FOREIGN');
			$table->string('imagine_front', 50);
			$table->string('imagine_single_product', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produs');
	}

}
