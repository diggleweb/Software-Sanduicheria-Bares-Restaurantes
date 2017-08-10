<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Produto;
use App\ProdutosItens;
use App\Funcionario;
use App\Item;
use Input;
use App\Cliente;
use App\User;
use DB;
use Auth;


class AtendenteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Faz uma busca por todos os produtos cadastrados antes de entrar na página
		$produto = new Produto();

		//pega todos os produtos cuja categoria seja 'sanduiche'
		$sanduiches = $produto->where('idCategoria', '=', 1)->where('ativo', '=', true)->get();

		//pega todos os produtos cuja categoria seja 'porção'
		$porcoes = $produto->where('idCategoria', '=', 3)->where('ativo', '=', true)->get();

		//pega todos os produtos cuja categoria seja 'bebidas'
		$bebidas = $produto->where('idCategoria', '=', 2)->where('ativo', '=', true)->get();

		//pega todos os produtos cuja categoria seja 'pratos'
		$pratos = $produto->where('idCategoria', '=', 4)->where('ativo', '=', true)->get();

		$funcionarios = new Funcionario();
		$funcionarios = $funcionarios->where('ativo', '=', true)->get();

		$itens = new Item();
		$itens = $itens->where('ativo', '=', '1')->orderBy('nome', 'asc')->get();

		return view('atendente.home')->
		with('sanduiches', $sanduiches)->
		with('porcoes', $porcoes)->
		with('funcionarios', $funcionarios)->
		with('bebidas', $bebidas)->
		with('itens', $itens)->
		with('pratos', $pratos);
		
	}

	public function maps() {
	    $input = Input::only('id', 'cep');
	    $cep = $input['cep'];
	    $id = $input['id'];
		return view('atendente.deleting-markers')->with('cep', $cep)->with('id', $id);
	}

	public function login() {
		return view('atendente.login');
	}

	public function postLogin() {
		$input = Input::only('login', 'password');
		
		$login = $input['login'];
		$senhaDigitada = $input['password'];

		$usuarios = new User();
		$usuario = $usuarios->where('login', '=', $login)->first();
		
		if (empty($usuario)) {
			return Redirect()->back()->withErrors(['Login inexistente.']);
		} else {
			$senhaBanco = $usuario->password;

			if (crypt($senhaDigitada, $senhaBanco) === $senhaBanco) {

				//verificar se o usuário possui 'papel' = 'atendente' ou 'administrador'
				$id_role = DB::table('role_user')->where('user_id', '=', $usuario->id)->first()->role_id;
				$name_role = DB::table('roles')->where('id', '=', $id_role)->first()->name;

				if ($name_role == "atendente" || $name_role == "administrador") {
					return Redirect()->to('atendente/home');
				} else {
					return Redirect()->back()->withErrors(['Você não possui permissão de atendente ou superior.']);
				}
			} else {
				return Redirect()->back()->withErrors(['Login ou senha incorretos!']);
			}
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
