<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContaProdutos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

	
		Schema::create('conta_produtos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('conta_id')->unsigned();
			$table->integer('produto_id')->unsigned();			
			// $table->integer('item_id')->unsigned()->nullable();		

			// $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
			$table->foreign('conta_id')->references('id')->on('contas')->onDelete('cascade');
			$table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');

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
			Schema::drop('conta_produtos');
	}

}
