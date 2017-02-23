<?php
	
	use App\Cliente;
	use App\Produto;

	$factory('App\Cliente', [
	    'nome' => $faker->name,
	    'telefone' => $faker->randomNumber(8),
	    'endereco' => $faker->address
	]);

	$factory('App\Produto', [
	    'nome' => $faker->name,
	    'preco' => $faker->randomNumber(3),
	]);