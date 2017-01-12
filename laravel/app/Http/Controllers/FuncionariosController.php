<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Funcionario;
use Input;

class FuncionariosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$garcons = new Funcionario();
		$garcons = $garcons->where('ativo', '=', true)->get();
		return view('listar.funcionarios')->with('garcons', $garcons);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('adicionar.funcionarios');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		if (Input::has('nome') && Input::has('salario')) {	//verifica se os campos 'nome' e 'salario' foram preenchidos
			$input = Input::all();	//busca os dados

			//cria um novo funcionario e preenche os dados
			$funcionario = new Funcionario();
			$funcionario->nome = $input['nome'];
			$funcionario->salario = $input['salario'];
			$funcionario->produtosVendidos = 0;
			$funcionario->ativo = true;

			if ($input['cargo'] == 'garcom') {
				$funcionario->cargo = 'garcom';
				$funcionario->gerente = 0;
			} else {
				$funcionario->cargo = 'gerente';
				$funcionario->gerente = 1;
			}

			//salva
			$funcionario->save();
			//redireciona
			return Redirect()->to('/administrador/listarFuncionarios');

		} else {
			return Redirect()->to('administrador/listarFuncionarios/novoFuncionario')->withErrors(['Os campos \'Nome\' e \'Salário\' devem ser preenchidos!']);
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
		$funcionario = new Funcionario();
		$funcionario = $funcionario->find($id);
		return view('editar.funcionarios')->with('funcionario', $funcionario);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (Input::has('nome') && Input::has('salario')) {	//verifica se os campos 'nome' e 'salario' foram preenchidos
			$input = Input::all();	//busca os dados

			//cria um novo funcionario e preenche os dados
			$funcionario = new Funcionario();
			$funcionario = $funcionario->find($id);
			
			$funcionario->nome = $input['nome'];
			$funcionario->salario = $input['salario'];
			
			if ($input['cargo'] == 'garcom') {
				$funcionario->cargo = 'garcom';
				$funcionario->gerente = 0;
			} else {
				$funcionario->cargo = 'gerente';
				$funcionario->gerente = 1;
			}

			//salva
			$funcionario->save();
			//redireciona
			return Redirect()->to('/administrador/listarFuncionarios');

		} else {
			return Redirect()->back()->withErrors(['Os campos \'Nome\' e \'Salário\' devem ser preenchidos!']);
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
		$funcionarios = new Funcionario();
		$funcionario = $funcionarios->where('id', '=', $id)->first();
		$funcionario->ativo = false;
		$funcionario->update();
		return Redirect()->back();
	}

}
