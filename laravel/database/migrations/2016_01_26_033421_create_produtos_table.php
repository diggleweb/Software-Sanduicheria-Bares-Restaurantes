<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produtos', function(Blueprint $table)
		{
			
			$table->increments('id');
			$table->integer('idCategoria')->unsigned()->nullable();
			$table->string('nome', 150);
			$table->float('precoCompra');
			$table->float('precoVenda');
			$table->string('urlImagem', 255);
			$table->boolean('ativo');

			$table->foreign('idCategoria')->references('id')->on('categorias')->onDelete('cascade');

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
		Schema::drop('produtos');
	}

}
