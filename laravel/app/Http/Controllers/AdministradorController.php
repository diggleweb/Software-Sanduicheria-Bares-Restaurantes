<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ContasProdutos;
use App\Produto;
use App\Funcionario;
use DB;

class AdministradorController extends Controller {



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	//busca no banco o nome do produto mais vendido
		$produtoMaisVendido = DB::select(
		'SELECT nome, urlImagem
		FROM produtos
		WHERE id = (
			SELECT produto_id
			FROM conta_produtos
			GROUP BY produto_id
			ORDER BY count(*) DESC
			LIMIT 1
		);');

		$nomeProduto = $produtoMaisVendido[0]->nome; //faz apenas uma pequena conversão porque vem do banco como um array
		$urlMaisVendido = $produtoMaisVendido[0]->urlImagem;

		
	//busca quantas unidades foram vendidas do produto que mais vendeu
		$unidadesProdutoMaisVendido = DB::select(
			'SELECT count(*) AS vendidos
			 FROM conta_produtos
			 GROUP BY produto_id
			 ORDER BY count(*) DESC
			 LIMIT 1');
		//faz apenas uma pequena conversão
		$unidadesProdutoMaisVendido = $unidadesProdutoMaisVendido[0]->vendidos;

	//busca o lucro total (baseado em todos os produtos que foram vendidos)
		$produtosVendidos = DB::select(
		'SELECT produto_id, count(*) AS quantidade
		 FROM conta_produtos
		 GROUP BY produto_id');		//retorna duas colunas: a primeira com ids dos produtos vendidos
							//a segunda com a quantidade de cada produto vendido		

		$produtos = new Produto();
		$lucroTotal = 0;	//variável que irá incrementar a cada iteração de produtos vendidos e trará no final o valor de lucro total	
		$maiorLucro = 0;	//variávle que irá verificar qual é o produto mais lucrativo
		$produtoMaisLucrativo = '';
		$urlMaisLucrativo = '';

		//para cada id de produto que foi vendido, buscar na tabela de produtos
		//e verificar qual o lucro de cada unidade vendida deste produto
		//e multiplicar este lucro pela quantidade vendida (count(*))
		foreach($produtosVendidos as $produto) {
			$id = $produto->produto_id;
			$resultado = $produtos->select('precoCompra', 'precoVenda', 'nome', 'urlImagem')->where('id', '=', $id)->first();	//pega o preço de compra e de venda do produto selecionado
			//subtrai preço de venda pelo preço de compra (lucro)
			$lucro = $resultado->precoVenda - $resultado->precoCompra;

			//multiplica o lucro pela quantidade que foi vendida
			$lucroTotal += $lucro * $produto->quantidade;

			//verifica, a cada iteração, se o lucro total deste produto é o maior de todos (para pegar o produto mais lucrativo)
			if (($lucro * $produto->quantidade) > $maiorLucro) {
				$maiorLucro = $lucroTotal;
				$produtoMaisLucrativo = $resultado->nome;
				$urlMaisLucrativo = $resultado->urlImagem;
			}

		}
	//fim da busca pelo lucro total

		//busca o funcionário que vendeu mais produtos
		$funcionarios = new Funcionario();
		$dadosFuncionario = $funcionarios
							->orderBy('produtosVendidos', 'desc')
							->limit(1)
							->select('nome', 'produtosVendidos')
							->first();

		$nomeFuncionario = $dadosFuncionario['nome'];
		$qtdeVendidaFuncionario = $dadosFuncionario['produtosVendidos'];

		return view('administrador.home')
				->with('nomeProduto', $nomeProduto)
				->with('urlMaisVendido', $urlMaisVendido)
				->with('nomeFuncionario', $nomeFuncionario)
				->with('qtdeVendidaFuncionario', $qtdeVendidaFuncionario)
				->with('lucroTotal', $lucroTotal)
				->with('produtoMaisLucrativo', $produtoMaisLucrativo)
				->with('urlMaisLucrativo', $urlMaisLucrativo)
				->with('lucroProdutoMaisLucrativo', $maiorLucro)
				->with('unidadesProdutoMaisVendido', $unidadesProdutoMaisVendido);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
