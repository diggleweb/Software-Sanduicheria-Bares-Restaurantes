<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContasProdutosHasItens extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contas_produtos_has_itens', function(Blueprint $table) {
			$table->integer('conta_produtos_id')->unsigned();
			$table->integer('itens_id')->unsigned();

			$table->foreign('conta_produtos_id')->references('id')->on('conta_produtos')->onDelete('cascade');
			$table->foreign('itens_id')->references('id')->on('items')->onDelete('cascade');
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
		Schema::drop('contas_produtos_has_itens');
	}

}
