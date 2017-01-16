<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Produto;
use App\Categoria;
use App\Item;
use Illuminate\Http\Request;
use Input;
use File;
use Session;
use DB;

class ProdutosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$produtos = new Produto();
		$categorias = new Categoria();

		//pega todas as categorias 
		$categorias = $categorias->get();
		
		//pega todos os produtos
		$produtosAtivos = $produtos->where('ativo', '=', true)->get();

		
		//array contendo o numero de produtos referente a cada categoria
		$arrayNumeroProdutosPorCategoria = array();

		//para cada categoria , precisamos do numero de produtos referentes a estas categorias 
		$posicaoArray = 0;
		foreach($categorias as $categoria) {
			$numero = $produtos->where('idCategoria', '=', $categoria->id)->where('ativo', '=', true)->count();
			$arrayNumeroProdutosPorCategoria[$posicaoArray] = $numero;
			$posicaoArray++;
		}


		return view('listar.produtos')->with('produtos', $produtosAtivos)->with('categorias', $categorias)->with('arrayNumeroProdutosPorCategoria', $arrayNumeroProdutosPorCategoria);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$itens = new Item();
		$itens = $itens->orderBy('nome', 'asc')->get();
		return view('adicionar.produtos')->with('itens', $itens);
	}

	public function filtrar(Request $request) {
		//esta instância só é criada por causa da linha debaixo
		$produtos = new Produto();
		$categorias = new Categoria();

		$categorias = $categorias->get();	

		//array contendo o numero de produtos referente a cada categoria
		$arrayNumeroProdutosPorCategoria = array();

		//contador do array $arrayNumeroProdutosPorCategoria
		$posicaoArray = 0;

		//recebo os parâmetros que vêm da view
		$filtrarPor = $request->input('filtrarPor');
		$filtro = $request->input('filtro');

		//caso esteja filtrando por categoria
		if ($filtrarPor == 'categoria') {

			//este laço serve apenas para preencher o número de produtos encontrados referente a cada categoria encontrada na busca
			foreach($categorias as $categoria) {
				$numero = $produtos->where('idCategoria', '=', $categoria->id)->where('ativo', '=', true)->where('categoria', 'like', '%'.$filtro.'%')->count();
				$arrayNumeroProdutosPorCategoria[$posicaoArray] = $numero;
				$posicaoArray++;
			}

			$produtosFiltrados = $produtos
				->where('categoria', 'like', '%'.$filtro.'%')
				->where('ativo', '=', 1)
				->get();

		//caso esteja buscando por 'nome'
		} else {	

			//este laço serve apenas para preencher o número de produtos encontrados referente a cada categoria encontrada na busca
			$produtosFiltrados = $produtos
				->where('nome', 'like', '%'. $filtro . '%')
				->where('ativo', '=', 1)
				->get();	//busco produtos cujo nome se pareça com o valor filtrado

			foreach($categorias as $categoria) {
				$numero = $produtos->where('idCategoria', '=', $categoria->id)->where('ativo', '=', true)->where('nome', 'like', '%'.$filtro.'%')->count();
				$arrayNumeroProdutosPorCategoria[$posicaoArray] = $numero;
				$posicaoArray++;
			}

		}
		
		//retorno das variáveis para a view
		return view('listar.produtos')->with('produtos', $produtosFiltrados)->with('filtrarPor', $filtrarPor)->with('filtro', $filtro)->with('categorias', $categorias)->with('arrayNumeroProdutosPorCategoria', $arrayNumeroProdutosPorCategoria);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		//primeira coisa eh verificar se existe ou nao uma imagem armazenada...
		if (Input::hasFile('urlImagem')) {
			$input = Input::all();
			//verifica se o arquivo de upload realmente eh uma imagem
			if(substr($input['urlImagem']->getMimeType(), 0, 5) == 'image') {
	   			//cria uma nova instancia de Produto, coloca os dados, insere no banco
	   			$produto = new Produto();
				$produto->nome = $input['nome'];
				$produto->precoCompra = $input['precoCompra'];
				$produto->precoVenda = $input['precoVenda'];
				$produto->idCategoria = $input['categoria'];

				//monta o destino do arquivo, a partir da categoria, nome, e da extensao do produto
				$destinationPath = "imagens/produtos/" . $input['categoria'];
				$fileName = $input['nome'] . "." . $input['urlImagem']->getClientOriginalExtension();

				//move a imagem para o local correto
				$input['urlImagem']->move($destinationPath, $fileName);

				$produto->urlImagem = $destinationPath . "/" . $fileName;
				$produto->ativo = true;

				$produto->save();

				Session::flash('mensagem', 'Produto inserido com sucesso!');
				return Redirect()->back();

			} else {	//caso nao seja apenas uma imagem
				return Redirect()->back()->withErrors('O arquivo adicionado deve ser uma imagem!');
			}
		} else {
			return Redirect()->back()->withErrors("Por favor, insira uma imagem para o produto!");
		}

		
		
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
		$produtos = new Produto();
		$produto = $produtos->find($id);
		return view('editar.produtos')->with('produto', $produto);
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
			//primeira coisa eh verificar se existe ou nao uma imagem armazenada...
			if (Input::hasFile('urlImagem')) {
				$input = Input::all();
				//verifica se o arquivo de upload realmente eh uma imagem
				if(substr($input['urlImagem']->getMimeType(), 0, 5) == 'image') {
		   			//cria uma nova instancia de Produto, coloca os dados, insere no banco
		   			$produto = new Produto();
		   			$produto = $produto->find($id);
					$produto->nome = $input['nome'];
					$produto->precoCompra = $input['precoCompra'];
					$produto->precoVenda = $input['precoVenda'];
					$produto->idCategoria = $input['categoria'];

					//monta o destino do arquivo, a partir da categoria, nome, e da extensao do produto
					$destinationPath = "imagens/produtos/" . $input['categoria'];
					$fileName = $input['nome'] . "." . $input['urlImagem']->getClientOriginalExtension();

					//move a imagem para o local correto
					$input['urlImagem']->move($destinationPath, $fileName);

					$produto->urlImagem = $destinationPath . "/" . $fileName;
					$produto->ativo = true;

					$produto->save();

					return Redirect()->to('/administrador/listarProdutos');

				} else {	//caso nao seja apenas uma imagem
					return Redirect()->back()->withErrors('O arquivo adicionado deve ser uma imagem!');
				}
			} else {
				//se não tiver imagem, gravar  com a imagem antiga
				$input = Input::all();
	   			$produto = new Produto();
	   			$produto = $produto->find($id);
	   			$produto->nome = $input['nome'];
				$produto->precoCompra = $input['precoCompra'];
				$produto->precoVenda = $input['precoVenda'];
				$produto->idCategoria = $input['categoria'];
				$produto->ativo = true;
				$produto->save();
				return Redirect()->to('/administrador/listarProdutos');
			}
			
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{	
		$id = Input::get('id');

		//excluir um produto
		$produtos = new Produto();
		//busca o produto cujo id seja igual ao id fornecido pela view
		$produto = $produtos->find($id);
		$produto->ativo = false;

		$produto->update();

		return Redirect()->back();
	}

}
