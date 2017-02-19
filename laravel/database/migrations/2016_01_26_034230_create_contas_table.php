<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contas', function(Blueprint $table)
		{

			//'contas' sempre serão relacionadas a contas_produtos na tabela contas_produtos
			$table->increments('id');					
			//a conta pode estar vinculada a um cliente ou a uma mesa
			$table->integer('cliente_id')->unsigned()->nullable();
			$table->integer('mesa_numero')->unsigned()->nullable();
			//funcionário que atendeu a mesa
			$table->integer('funcionario_id')->unsigned()->nullable();
			$table->float('valor');		
			$table->boolean('encerrada');		//verifica se a conta está aberta ou já foi encerrada

			//chaves estrangeiras
			$table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
			$table->foreign('mesa_numero')->references('numero')->on('mesas')->onDelete('cascade');
			$table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');

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
		Schema::drop('contas');
	}

}
