<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Conta;
use App\ContasProdutos;
use Illuminate\Http\Request;
use DB;
use Input;

class ContasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contas = new Conta();
		$contas = $contas
					->join('funcionarios', 'contas.funcionario_id', '=', 'funcionarios.id')
					->select('contas.id', 'funcionarios.nome', 'contas.updated_at')
					->where('encerrada', '=', true)
					->orderBy('contas.updated_at', 'desc')
					->get();
		
  		$produtos = [];
  		$posicao = 0;

		foreach($contas as $conta) {
			$cp = DB::select("SELECT p.nome, p.precoVenda, ap.created_at as created_at
								FROM produtos p JOIN
			    					 conta_produtos ap
		   						ON ap.produto_id = p.id
								WHERE ap.conta_id = ?", [$conta->id]);

			$produtos[$posicao] = $cp;
			$posicao++;
		}

		return view('listar.contasEncerradas')->with('contas', $contas)->with('produtos', $produtos);
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
	public function destroy()
	{
		$id = Input::get('id');
		$contas = new Conta();
		$contas = $contas->where('id', '=', $id)->first()->delete();

		return "Excluído com sucesso!";
	}

}
