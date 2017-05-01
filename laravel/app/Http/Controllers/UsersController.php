<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Input;
use DB;
use App\Role;
use App\Role_User;

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

		$role_names = [];
		
		//para cada usuario encontrado
		foreach($usuarios as $usuario) {
			//na mesma posicao do array, devemos encontrar o nome do papel
			$role_id = DB::table('role_user')->where('user_id', '=', $usuario->id)->first()->role_id;
			$role_name = DB::table('roles')->where('id', '=', $role_id)->first()->display_name;
			array_push($role_names, $role_name);
		}
		
		return view('listar.usuarios')->with('usuarios', $usuarios)->with('role_names', $role_names);
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

		//busca o ID do papel deste usuário
		$role_user = DB::table('role_user')->select('role_id')->where('user_id', '=', $id)->first();
		$role_id = $role_user->role_id;

		//busca o nome do papel deste usu[ario
		$role = DB::table('roles')->where('id', '=', $role_id)->first();
		$role_name = $role->name;

		return view('editar.usuarios')->with('usuario', $usuario)->with('roleName', $role_name);		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function Update($id)
	{
		if (Input::has('login')) {	//verifica se os campos 'nome' e 'salario' foram preenchidos
			$input = Input::all();	//busca os dados

			//nome do papel que este usuário possui no sistema
			$role_name = $input['role']; 
			//nome do login
			$login = $input['login'];

			$role_id = DB::table('roles')->where('name', '=', $role_name)->first()->id;

			//cria um novo funcionario e preenche os dados
			$usuarios = new User();
			//busca o ID do usuário
			$usuario = $usuarios->where('login', '=', $login)->first();
			$usuario_id = $usuario->id;

			/* realiza o update */
			DB::table('role_user')->where('user_id', '=', $usuario_id)->update(['role_id' => $role_id]);
			
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
	public function destroy()
	{
		$id = Input::get('id');
		$user = new User();
		$user->destroy($id);
		return Redirect()->back();
	}

}
