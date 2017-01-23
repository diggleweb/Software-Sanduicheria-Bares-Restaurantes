<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Http\Request;
use Input;
use File;
use Session;
use DB;


class ItensController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$item = new Item();
		$itens = $item->orderBy('nome', 'asc')->where('ativo', '=', 1)->get();
		return view('listar.itens')->with('itens', $itens);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('adicionar.item');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
			
			//verifica se o nome foi preenchido
			if (Input::has('nome') && Input::has('precoCompra') && input::has('precoVenda')) {
				//verifica se a imagem foi adicionada
				if (Input::hasFile('urlImagem')) {
					$input = Input::all();
					//verifica se o arquivo de upload realmente eh uma imagem
					if(substr($input['urlImagem']->getMimeType(), 0, 5) == 'image') {
			   			//cria uma nova instancia de item, coloca os dados, insere no banco
			   			$item = new Item();
						$item->nome = $input['nome'];
						$item->precoCompra = $input['precoCompra'];
						$item->precoVenda = $input['precoVenda'];
						$item->ativo = 1;

						//monta o destino do arquivo, a partir da categoria, nome, e da extensao do produto
						$destinationPath = "imagens/itens/";
						$fileName = $input['nome'] . "." . $input['urlImagem']->getClientOriginalExtension();

						//move a imagem para o local correto
						$input['urlImagem']->move($destinationPath, $fileName);

						$item->urlImagem = $destinationPath . "/" . $fileName;
						
						//salva no banco
						$item->save();

						Session::flash('mensagem', 'Produto inserido com sucesso!');
						return Redirect()->back();

					} else {	//caso nao seja apenas uma imagem
						return Redirect()->back()->withErrors('O arquivo adicionado deve ser uma imagem!');
					}
				} else {
					return Redirect()->back()->withErrors("Por favor, insira uma imagem para o produto!");
				}	
			} else {
				return Redirect()->back()->withErrors('Por favor, preencha todos os campos corretamente!');
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

	public function filtrar(Request $request) {
		//esta instância só é criada por causa da linha debaixo
		$itens = new Item();
		
		//recebo os parâmetros que vêm da view
		$filtrarPor = $request->input('filtrarPor');
		$filtro = $request->input('filtro');

		$itens = $itens
			->where('nome', 'like', '%'.$filtro.'%')
			->where('ativo', '=', 1)
			->orderBy('nome', 'asc')
			->get();

		
		//retorno das variáveis para a view
		return view('listar.itens')->with('itens', $itens)->with('filtrarPor', $filtrarPor)->with('filtro', $filtro);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = new Item();
		$item = $item->find($id);
		return view('editar.itens')->with('item', $item);	
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
	public function destroy()
	{
		$id = Input::get('id');
		$item = new Item();
		$item = $item->where('id', '=', $id)->first();
		$item->ativo = 0;
		$item->update();
		return Redirect()->back();
	}

}
