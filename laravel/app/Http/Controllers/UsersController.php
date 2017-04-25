<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$usuarios = new User();
		$usuarios = $usuarios->get();
		return view('listar.usuarios')->with('usuarios', $usuarios);
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
		$usuario = new User();
		$usuario = $usuario->find($id);
		return view('editar.usuarios')->with('usuario', $usuario);		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (Input::has('login')) {	//verifica se os campos 'nome' e 'salario' foram preenchidos
			$input = Input::all();	//busca os dados

			//cria um novo funcionario e preenche os dados
			$usuario = new User();
			
			//salva
			$usuario->save();
			//redireciona
			return Redirect()->to('/administrador/listarUsuarios');

		} else {
			return Redirect()->back()->withErrors(['Campos incorretos!']);
		}
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
