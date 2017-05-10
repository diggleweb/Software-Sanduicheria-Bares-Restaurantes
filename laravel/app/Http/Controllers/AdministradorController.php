<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ContasProdutos;
use App\Produto;
use App\Funcionario;
use DB;
use Input;

class AdministradorController extends Controller {



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		//Caso tenhamos que filtrar os dados por algum período
		$periodo = Input::get('filtrarPor');

		//busca no banco o nome do produto mais vendido
		$sqlProdutoMaisVendido = "SELECT nome, urlImagem
		FROM produtos
		WHERE id = (
			SELECT produto_id
			FROM conta_produtos
			GROUP BY produto_id
			ORDER BY count(*) DESC
			LIMIT 1
		);";

		//busca quantas unidades foram vendidas do produto que mais vendeu
		$sqlUnidadesProdutoMaisVendido = "SELECT count(*) AS vendidos
			 FROM conta_produtos
			 GROUP BY produto_id
			 ORDER BY count(*) DESC
			 LIMIT 1";

		//quantos produtos foram vendidos em um determinado perídoo
		$qtdeVendidos = "SELECT produto_id, count(*) AS quantidade
		 FROM conta_produtos
		 GROUP BY produto_id";



		switch($periodo) {
			//'total' significa que pegaremos desde a data de criação do banco de dados até hoje
			case 'total':
				//portanto usaremos as querys nativas (sem clausula where)
				
			break;

			//pegaremos apenas dados dos últimos 30 dias
			case 'ultimoMes':
				//precisamos adicionar a cláusula where em cada um dos SQL acima
				//o que podemos fazer é concatenar a string e colocar essa cláusula where para não repetirmos código
				//portanto, primeiro encontramos 'FROM conta_produtos' e concatenamos após isso

			break;
		}

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
				->with('lucroProdutoMaisLucrativo', number_format($maiorLucro, 2))
				->with('unidadesProdutoMaisVendido', $unidadesProdutoMaisVendido);
	}
// WHERE updated_at BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND CURRENT_TIMESTAMP

	/* filtra e retorna o SQL referente a um determinado período */
	public function filtrar() {
		$periodo = Input::get('filtrarPor');
		
		switch($periodo) {
			
			case 'total':
				return redirect('administrador');
			break;

			case 'ultimoMes':
				//busca no banco o nome do produto mais vendido dentro dos últimos 30 dias
				$produtoMaisVendido = DB::select(
					"SELECT nome, urlImagem
					FROM produtos
					WHERE id = (
						SELECT produto_id
						FROM conta_produtos
						WHERE updated_at BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND CURRENT_TIMESTAMP
						GROUP BY produto_id
						ORDER BY count(*) DESC
						LIMIT 1
					);"
				);

				$nomeProduto = $produtoMaisVendido[0]->nome; //faz apenas uma pequena conversão porque vem do banco como um array
				$urlMaisVendido = $produtoMaisVendido[0]->urlImagem;

				//busca quantas unidades foram vendidas do produto que mais vendeu
				$unidadesProdutoMaisVendido = DB::select(
					'SELECT count(*) AS vendidos
					 FROM conta_produtos
					 WHERE updated_at BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND CURRENT_TIMESTAMP
					 GROUP BY produto_id
					 ORDER BY count(*) DESC
					 LIMIT 1');
				//faz apenas uma pequena conversão
				$unidadesProdutoMaisVendido = $unidadesProdutoMaisVendido[0]->vendidos;


				//busca o lucro total (baseado em todos os produtos que foram vendidos)
				$produtosVendidos = DB::select(
				'SELECT produto_id, count(*) AS quantidade
				 FROM conta_produtos
				 WHERE updated_at BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND CURRENT_TIMESTAMP
				 GROUP BY produto_id');		//retorna duas colunas: a primeira com ids dos produtos vendidos
									//a segunda com a quantidade de cada produto vendido		

				$produtos = new Produto();
				$lucroTotal = 0;	//variável que irá incrementar a cada iteração de produtos vendidos e trará no final o valor de lucro total	
				$maiorLucro = 0;	//variávle que irá verificar qual é o produto mais lucrativo
				$produtoMaisLucrativo = '';
				$urlMaisLucrativo = '';



			break;



			case 'Janeiro':

			break;

			
		}
		
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
