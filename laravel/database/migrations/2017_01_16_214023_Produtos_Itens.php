<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProdutosItens extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produtos_itens', function(Blueprint $table) {
			$table->integer('produto_id')->unsigned();
			$table->integer('item_id')->unsigned();

			$table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
			$table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
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
		Schema::drop('produtos_itens');
	}

}
