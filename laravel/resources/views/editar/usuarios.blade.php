@extends('comum')

@section('titulo')
{{'Editar Usuário'}}
@endsection

@section('corpo')

<div class="page-header">
	<h1>Bem-vindo, administrador!</h1>
</div>

<ol class="breadcrumb">
 	 <li><a href="/">Garçom</a></li>
  	<li class="active"><a href="/administrador">Administrador</a></li>
  	<li class="active"><a href = "/administrador/listarUsuario">Listar Usuário</a></li>
  	<li class="active">Editar Usuário</li>
</ol>

<div class = "container">
<h1>Editar Usuário ({{ $usuario->login }})</h1>

@if($errors->any()) 
	<div class = "alert alert-danger" role = "alert"> {{$errors->first()}} </div>
@endif


{!! Form::model($usuario, array('id' => 'formulario','route' => array('updateUsuario', $usuario->id), 'method' => 'PUT')) !!}
	{!! Form::label('Nome: ') !!}
	{!! Form::text('login', null, array('class' => 'form-control', 'style' => 'width: 500px', 'maxlength' => '200')) !!}
	<br>
	{!! Form:: !!}

	<a href = "/administrador/listarUsuario" style = "margin-left: 300px; width: 100px" class = "btn btn-default">Cancelar</a>
	{!! Form::submit('Salvar', array('class' => 'btn btn-primary', 'style' => 'margin-left: 30px; width: 100px')) !!}
{!! Form::close()!!}
</div>
@endsection