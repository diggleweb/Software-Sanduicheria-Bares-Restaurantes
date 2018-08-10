<?php

use App\Pedido;
use App\Funcionario;
use App\ProdutosItens;
use App\Produto;
use App\Conta;
use App\ContasProdutos;
use App\Cliente;

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('/excluirUsuario/', ['as' => 'excluirUsuario', 'uses' => 'UsersController@destroy']);

Route::get('/buscarProdutos', function() {
	return Produto::all();
});


Route::get('/garcom', 'GarcomController@index');


Route::get('/pesquisarCliente',  function() {
	$input = Input::only('telefone');
	$telefone = $input['telefone'];
	
	$cliente = new App\Cliente();
	$clientes = $cliente->where('telefone', 'LIKE', $telefone)->get();

	return $clientes;
});

Route::get('/excluirCliente', function() {
	$input = Input::all();
	$id = $input['idCliente'];
	
	$cliente = new App\Cliente();
	$cliente->where('id', '=', $id)->first()->delete();
});

Route::get('/filtrarCliente', function() {
	$input = Input::all();
	$filtro = $input['filtro'];
	$filtrarPor = $input['filtrarPor'];
	
	$cliente = new App\Cliente();
	$clientes = $cliente->where($filtrarPor, "LIKE", "%" . $filtro . "%")->get();

	return $clientes;
});

Route::get('/cadastrarNovoCliente', function() {
	$input = Input::only('telefone', 'cep', 'endereco', 'nome');

	$cliente = new App\Cliente();
	$cliente->telefone = $input['telefone'];
	$cliente->nome = $input['nome'];
	$cliente->endereco = $input['endereco'];
	$cliente->cep = $input['cep'];
	$affectedRows = $cliente->save();

	$id = $cliente->id;
	return $id;
});

Route::get('/editarCliente', function() {
	$input = Input::only('telefone', 'cep', 'endereco', 'nome', 'idCliente');

	$idCliente = $input['idCliente'];

	$cliente = App\Cliente::where('id', '=', $idCliente)->first();
	$cliente->telefone = $input['telefone'];
	$cliente->nome = $input['nome'];
	$cliente->endereco = $input['endereco'];
	$cliente->cep = $input['cep'];
	$affectedRows = $cliente->save();

	$id = $cliente->id;
	return $id;
});


Route::group(['prefix' => 'atendente'], function() {
	// Route::get('/', 'AtendenteController@login');
	// Route::post('/postLogin', 'AtendenteController@postLogin');
	Route::get('/', 'AtendenteController@index');
	Route::get('/googlemaps', ['as' => 'googlemaps', 'uses' => 'AtendenteController@maps']);
	
});


Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

//rotas agrupadas pois utilizam o mesmo prefixo /administrador/ ... e porque são rotas restritas a usuários autenticados
Route::group(['prefix' => 'administrador'], function() {
	Route::get('/', ['as' => 'administrador', 'uses' => 'AdministradorController@index']);

	//página inicial de administrador, mas com filtros diferentes
	Route::get('/filtrarPeriodo{periodo}', ['as' => 'filtrarPorPeriodo', 'uses' => 'AdministradorController@filtrar']);

	Route::get('/listarProdutos', ['as' => 'listarProdutos', 'uses' => 'ProdutosController@index']);
	Route::get('/listarProdutos/novoProduto', ['as' => 'novoProduto', 'uses' => 'ProdutosController@create']);	
	Route::get('/listarProdutos/editarProduto{id}', ['as' => 'editarProduto', 'uses' => 'ProdutosController@edit']);
	Route::put('/listarprodutos/updateProduto{id}', ['as' => 'updateProduto', 'uses' => 'ProdutosController@update']);
	Route::get('/listarProdutos/filtrar/', ['as' => 'filtrarProduto', 'uses' => 'ProdutosController@filtrar']);
	
	Route::get('/listarItens', ['as' =>'listarItens', 'uses' => 'ItensController@index']);
	Route::get('/listarItens/novoItem', ['as' =>'novoItem', 'uses' => 'ItensController@create']);
	Route::get('/listarItens/editarItem{id}', ['as' => 'editarItem', 'uses' => 'ItensController@edit']);

	Route::get('/listarItens/filtrar/', ['as' => 'filtrarItem', 'uses' => 'ItensController@filtrar']);

	Route::post('/salvarItem', 'ItensController@store');
	Route::put('/listarItens/updateItem{id}', ['as' => 'updateItem', 'uses' => 'ItensController@update']);
	
	Route::get('/contasEncerradas', ['as' => 'contasEncerradas', 'uses' => 'ContasController@index']);

	Route::get('/listarFuncionarios', ['as' => 'listarFuncionarios', 'uses' => 'FuncionariosController@index']);
	Route::get('/listarFuncionarios/novoFuncionario', ['as' => 'novoFuncionario', 'uses' => 'FuncionariosController@create']);
	Route::get('/listarFuncionarios/editarFuncionario{id}', ['as' => 'editarFuncionario', 'uses'=>'FuncionariosController@edit']);
	Route::put('/listarFuncionarios/updateFuncionario{id}', ['as' => 'updateFuncionario', 'uses' => 'FuncionariosController@update']);

	Route::get('/listarUsuarios', ['as' => 'listarUsuarios', 'uses' => 'UsersController@index']);
	Route::put('/listarUsuarios/updateUsuario{id}', ['as' => 'updateUsuario', 'uses' => 'UsersController@update']);
	Route::get('/listarUsuarios/editarUsuario{id}', ['as' => 'editarUsuario', 'uses'=>'UsersController@edit']);
	Route::get('/listarUsuarios/novoUsuario', ['as' => 'novoUsuario', 'uses'=>'UsersController@create']);
	Route::post('/listarUsuarios/novoUsuario', ['as' => 'novoUsuarioPost', 'uses'=>'UsersController@store']);
});


//Esta rota existe porque a alguns produtos podem ser adicionados itens, alterando assim seu valor final
Route::get('/addPedidoComItens', function() {
	$contadorProdutos = 0; //contador de produtos que serão adicionados

	//busca os dados da view
	$input = Input::only('idConta', 'produtos', 'produtosAlterados');
	$idConta = trim($input['idConta']);
	$produtosAlterados = $input['produtosAlterados'];	//produtos para o qual foram adicionados itens, portanto seu valor final sera alterado
	$produtosNaoAlterados = $input['produtos'];	
	//$idCliente = $input['idCliente'];

												//obs: isso eh um array de obj, contendo o id do produto e o preco final

	/* observacao importante: em $produtosNaoAlterados vem tambem os ids dos produtos alterados, preciso retirar estes ids para nao repetir no banco */
	//percorre todos os produtos alterados para buscar dentro de produtos nao alterados qual possui o mesmo id, para retirar
	foreach($produtosAlterados as $produtoAlterado) {
		$id = $produtoAlterado['id'];
		foreach($produtosNaoAlterados as $key => $pna) {		//percorre todos os produtos nao alterados
			if ($pna == $id)									//caso o id do produto alterado seja igual ao do nao alterado
				array_splice($produtosNaoAlterados, $key, 1);	//retira o elemento repetido do array de nao alterados
		}

		//aproveitando o foreach de produtos alterados, podemos adicionar ao banco adicionando o preco correto
		$contadorProdutos++;		//incrementa o contador de produtos para o garcom
		$idProduto = $produtoAlterado['id'];
		$precoProduto = $produtoAlterado['preco'];		//pega o novo preco, com o valor dos itens embutidos
		$contasProdutos = new App\ContasProdutos();		//nova instancia de contasprodutos
		$contasProdutos['conta_id'] = $idConta;			
		$contasProdutos['precoFinal'] = $precoProduto;
		$contasProdutos['produto_id'] = $idProduto;
		$contasProdutos->save();						//salva no banco

		//adiciona o valor na tabela conta
		$contas = new App\Conta();
		$contaAtual = $contas->where('id', '=', $idConta)->first();
		$precoContaAtual = $contaAtual->valor;
		$contaAtual->valor = $precoContaAtual + $precoProduto;
		$contaAtual->save();
	}

	/* agora que adicionamos os produtos alterados, devemos adicionar os produtos nao alterados */
	foreach($produtosNaoAlterados as $pna) {
		$contadorProdutos++;
		$idProduto = $pna;
		$contasProdutos = new App\ContasProdutos();
		$contasProdutos['conta_id'] = $idConta;
		$contasProdutos['produto_id'] = $idProduto;

		//temos que buscar no banco de dados qual eh o valor real do produto (sem alteracoes de itens)
		$produtos = new App\Produto();
		$objProduto = $produtos->select('precoVenda')->where('id', '=', $idProduto)->first();
		$contasProdutos['precoFinal'] = $objProduto->precoVenda;
		$contasProdutos->save();

	}

	atualizarProdutosDoGarcom($idConta, $contadorProdutos);
});



//recebe uma requisição ajax da view do garçom e adiciona novos produtos na conta, baseado nos IDs dos ítens
//e no número da conta referente à mesa
Route::get('/addPedido', function() {
	
	$contadorProdutos = 0; //contador de produtos que serão adicionados

	//busca os dados da view
	$input = Input::only('idConta', 'produtos');
	$idConta = trim($input['idConta']);
	
	//percorre o array de produtos e insere no banco (tabela: contasProdutos)
	foreach($input['produtos'] as $idProduto) {
		$contadorProdutos++;
		$idProduto = trim($idProduto);
		$contasProdutos = new App\ContasProdutos();
		$contasProdutos['conta_id'] = $idConta;	
		$contasProdutos['produto_id'] = $idProduto;

		//busca o preco do produto para preencher o campo precoFinal
		$produto = new App\Produto();
		$obj = $produto->select('precoVenda')->where('id', '=', $idProduto)->first();
		$precoFinal = $obj->precoVenda;
		$contasProdutos['precoFinal'] = $precoFinal;	//obs: o preco final deste produto eh igual ao preco de venda dele, diferente de quando se adiciona 
		
		$contasProdutos->save();

		//adiciona o valor na tabela conta
		$contas = new App\Conta();
		$contaAtual = $contas->where('id', '=', $idConta)->first();
		$precoContaAtual = $contaAtual->valor;
		$contaAtual->valor = $precoContaAtual + $precoFinal;
		$contaAtual->save();
	}

	atualizarProdutosDoGarcom($idConta, $contadorProdutos);
});

//helper function apenas para não repetir código (utilizado nas rotas /addPedido e /addPedidoComItens)
function atualizarProdutosDoGarcom($idConta, $contadorProdutos) {

/* apenas atualiza o número de vendas do garçom */
	//busca qual funcionário é o responsável por esses produtos

	//cria uma nova instância de 'contas'
	$contas = new App\Conta();
	//pega o ID do funcionário relacionado a esta conta (para aumentar o número de produtos vendidos)
	$idFuncionario = $contas->where('id', '=', $idConta)->select('funcionario_id')->first();
	//apenas uma conversão
	$idFuncionario = $idFuncionario['funcionario_id'];

	$funcionarios = new App\Funcionario();
	//pega quantos produtos ja foram vendidos até então por este funcionário
	$produtosVendidos = $funcionarios->where('id', '=', $idFuncionario)->select('produtosVendidos')->first();

	//apenas uma conversão
	$produtosVendidos = $produtosVendidos['produtosVendidos'];

	//incrementa com o número de produtos que foram adicionados
	$produtosVendidos += $contadorProdutos;
	
	//salva no banco o novo valor
	$funcionario = $funcionarios->where('id', '=', $idFuncionario)->first();
	$funcionario['produtosVendidos'] = $produtosVendidos;
	$funcionario->update();

}


//rota que irá retornar uma o id da conta que está relacionada ao número da mesa
Route::get('/buscarContaRelacionada', function() {
	//busca os dados do ajax
	$input = Input::only('numeroMesa');
	//usei isso apenas porque $input era um array, mas quero a string que tá dentro dele, na posição 'numeroMesa'
	$numeroMesa = $input['numeroMesa'];

	//para buscar o id da conta relacionado ao número desta mesa:
	//verificar se existe alguma conta não encerrada (encerrada = false) cujo valor da mesa é igual ao parâmetro passado
	$contas = new App\Conta();
	$contaDesejada = $contas->where('mesa_numero', '=', $numeroMesa)->where('encerrada', '=', '0')->first();

	if (is_null($contaDesejada)) {	//caso nenhuma conta para esta mesa tenha sido encontrada
		return -1;	//retorna -1 para a home.blade.php tratar e fazer alterações na  view
	}

	return $contaDesejada['id'];

});

//dado o número da conta, busca o nome e o preço de  todos os produtos relacionados a esta conta
Route::get('/buscarProdutos', function() {
	$input = Input::only('idConta');
	$idConta = trim($input['idConta']);

	$contaProdutos = new App\ContasProdutos();
	$dados = $contaProdutos
	->where('conta_produtos.conta_id', '=', $idConta)
	->join('produtos', 'conta_produtos.produto_id', '=', 'produtos.id')
	->select('conta_produtos.id', 'conta_produtos.conta_id', 'produtos.nome', 'conta_produtos.produto_id', 'conta_produtos.precoFinal', DB::raw('count(*) as quantidade'))		//DB::RAW faz uma query SQL normal
	->orderBy('produtos.id', 'asc')
	->groupBy('conta_produtos.produto_id', 'conta_produtos.precoFinal')
	->get();

	return $dados;

	/* obs: sql alterado em 13/02/2017: trocado 'select(produtos.precoVenda) por select(conta_produtos.precoVenda) porque o preco de venda pode ser alterado conforme adiciona-se ou retira-se itens do produto */
});


//dado o número da conta, busca o nome, o preço e   todos os produtos relacionados a esta conta
Route::get('/buscarProdutosComDetalhes', function() {
	$input = Input::only('idConta');
	$idConta = $input['idConta'];

	//faz um inner join.
	//na tabela 'conta_produtos' existe a coluna produto.id e quero relacionar este id com o id da tabela produtos
	//busco, então, o preco de venda, o nome e a quantidade
	
	$contaProdutos = new App\ContasProdutos();
	$dados = $contaProdutos
	->where('conta_produtos.conta_id', '=', $idConta)
	->join('produtos', 'conta_produtos.produto_id', '=', 'produtos.id')
	->select('conta_produtos.conta_id', 'conta_produtos.created_at', 'produtos.nome', 'conta_produtos.precoFinal')		//DB::RAW faz uma query SQL normal
	->orderBy('conta_produtos.created_at', 'asc')
	->get();
	/* obs: sql alterado em 13/02/2017: trocado 'select(produtos.precoVenda) por select(conta_produtos.precoFinal) porque o preco de venda pode ser alterado conforme adiciona-se ou retira-se itens do produto' */

	return $dados;
});


//rota que irá encerrar uma conta
Route::get('/encerrarConta', function() {

	$contas = new App\Conta();
	$id = Input::get('id');			//busca o id da conta

	$conta = $contas->where('id', '=', $id)->first();	//busca no banco a conta com o ID dado
	$conta['encerrada'] = true;	//coloca o valor de encerrada em true
	$conta->update();	//update

	return 0;
});


Route::get('/criarNovaConta', function() {
	
		$input = Input::only('idFuncionario', 'numeroMesa');
		$numeroMesa = $input['numeroMesa'];
		$idFuncionario = $input['idFuncionario'];

		//cria uma nova conta, seta os dados
		$novaConta = new App\Conta();
		$novaConta['mesa_numero'] = $numeroMesa;
		$novaConta['valor'] = 0;
		$novaConta['encerrada'] = false;
		$novaConta['funcionario_id'] = $idFuncionario;
		$novaConta->save();	//salva no banco
		//busca novamente o id

		$contas = new App\Conta();
		$contaDesejada = $contas->where('mesa_numero', '=', $numeroMesa)->where('encerrada', '=', '0')->first();

		return 0;
});


//função utilizada em atendente.js, cria uma nova conta e relaciona esta conta a um id de um cliente
Route::get('/criarNovaContaCliente', function() {
	$input = Input::only('idCliente');
	$idCliente = $input['idCliente'];

	$novaConta = new App\Conta();
	$novaConta->cliente_id = $idCliente;
	$novaConta->funcionario_id = 1;
	$novaConta->valor = 0;
	$novaConta->encerrada = 0;

	$novaConta->save();

	return $novaConta->id;

});

Route::get('/criarNovaContaAtendente', function() {
	
		$input = Input::only('idFuncionario');
		$idFuncionario = $input['idFuncionario'];

		//cria uma nova conta, seta os dados
		$novaConta = new App\Conta();
		$novaConta['valor'] = 0;
		$novaConta['encerrada'] = false;
		$novaConta['funcionario_id'] = $idFuncionario;
		$novaConta->save();	//salva no banco
		//busca novamente o id
		return $novaConta;
});


Route::get('/buscaFuncionario', function() {
		$input = Input::only('idConta');
		$idConta = $input['idConta'];

		$contas = new App\Conta();

		$contaFuncionario = $contas->where('id', '=', $idConta)->select('funcionario_id')->get();
		$idFuncionario = trim($contaFuncionario[0]["funcionario_id"]);
		
		//query utilizada apenas para buscar o nome do funcionário
		$funcionarios = new App\Funcionario();
		$funcionario = $funcionarios->where('id', '=', $idFuncionario)->select('nome')->get();
		
		return $funcionario;		//retorna o nome do funcionário (é utilizado para mostrar na tela quem é o funcionário responsável)
});


//para cancelar um produto preciso do nome do produto e do ID da conta
Route::get('/cancelarProduto', function() {
	
	//busca os dados que vêm da view
	$idConta = Input::get('idConta');
	$idContasProdutos = Input::get('idContasProdutos');

	//cria uma nova instância de 'contas'
	$contas = new App\Conta();

	//pega o ID do funcionário relacionado a esta conta (para aumentar o número de produtos vendidos)
	$idFuncionario = $contas->select('funcionario_id')->where('id', '=', $idConta)->first();
	//apenas uma conversão
	$idFuncionario = $idFuncionario['funcionario_id'];

	$funcionarios = new App\Funcionario();
	//pega quantos produtos ja foram vendidos até então por este funcionário
	$produtosVendidos = $funcionarios->where('id', '=', $idFuncionario)->select('produtosVendidos')->first();
	//apenas uma conversão 
	$produtosVendidos = $produtosVendidos['produtosVendidos'];
	//retira 1
	$produtosVendidos--;
	//salva no banco o novo valor
	$funcionario = $funcionarios->where('id', '=', $idFuncionario)->first();
	$funcionario['produtosVendidos'] = $produtosVendidos;
	$funcionario->update();

	$cp = new App\ContasProdutos();	
	
	//pega o objeto conta 
	$objConta = $contas->where('id', '=', $idConta)->first();
	//pega o preço do item que está sendo excluído para que eu possa descontar na tabela contas
	$precoDescontado = $cp->where('id', '=', $idContasProdutos)->first()->precoFinal;
	//pega o preço anterior desta conta
	$precoAnterior = $objConta->valor;
	//desconta e atualiza a tabela
	$precoFuturo = $precoAnterior - $precoDescontado;
	//Atualiza o valor na tabela
	$objConta->valor = $precoFuturo;
	//atualiza a tabela
	$objConta->save();

	$cp->where('id', '=', $idContasProdutos)->first()->delete();	//deleta o produto da tabela conta_produtos

});

Route::post('/salvarFuncionario', 'FuncionariosController@store');
//Route::get('/excluirGarcom/{id}', ['as' => 'excluirGarcom', 'uses' => 'FuncionariosController@destroy']);
Route::get('/excluirGarcom/', ['as' => 'excluirGarcom', 'uses' => 'FuncionariosController@destroy']);
Route::get('/excluirItem', ['as' => 'excluirItem', 'uses' => 'ItensController@destroy']);
Route::get('/excluirProduto', ['as' => 'excluirProduto', 'uses' => 'ProdutosController@destroy']);
Route::post('/salvarProduto', 'ProdutosController@store');

Route::get('/excluirContaEncerrada', ['as' => 'excluirContaEncerrada', 'uses' => 'ContasController@destroy']);

//retorna os itens que são utilizados em um determinado produto
Route::get('/encontrarItens', function() {
	$id = Input::get('idProduto');
	$produtosItens = new ProdutosItens();
	//$idsItens = array de ids dos itens de um determinado produto
	$idsItens = $produtosItens->where('produto_id', '=', $id)->select('item_id')->get();

	return $idsItens;
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);