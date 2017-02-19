@extends('comum')

@section('titulo')
{{'Novo Funcionário'}}
@endsection

@section('corpo')

<div class="page-header">
	<h1>Bem-vindo, administrador!</h1>
</div>

<ol class="breadcrumb">
 	 <li><a href="/">Garçom</a></li>
  	<li class="active"><a href="/administrador">Administrador</a></li>
  	<li class="active"><a href = "/administrador/listarFuncionarios">Listar Funcionários</a></li>
  	<li class="active">Novo Funcionário</li>
</ol>

<script>
$(document).ready(
	function() {
		$('[name="nome"]').focus();
		$('[name="salario"]').maskMoney({prefix: "R$ "});
	}
);

//assim que submeter o formulario, devemos retirar a mascara de dinheiro do campo salario (para evitar que seja enviado R$ 1023123.1231,00 por exemplo)
$(function() {
	$('#formulario').submit(
		function() {
			$('[name="salario"]').val($('[name="salario"]').maskMoney('unmasked')[0]);
		}
	);
})

</script>
<div class = "container">
<h1>Adicionar um novo Funcionário</h1>

@if($errors->any()) 
	<div class = "alert alert-danger" role = "alert"> {{$errors->first()}} </div>
@endif

{!! Form::open(array('id' => 'formulario', 'url' => '/salvarFuncionario', 'method' => 'POST', 'onSubmit' => 'action(this)')) !!}
	{!! Form::label('Nome: ') !!}
	{!! Form::text('nome', '', array('class' => 'form-control', 'style' => 'width: 500px', 'maxlength' => '200')) !!}
	<br>
	{!! Form::label('Salário: ') !!}
	{!! Form::text('salario', '', array('class' => 'form-control', 'style' => 'width: 150px', 'maxlength' => '15')) !!}
	<br>
	{!! Form::label('Cargo: ') !!} <br>
	{!! Form::radio('cargo', 'garcom', 'true', ['class' => 'field', 'style' => 'width: 20px; height: 20px']) !!}
	{!! Form::label('Garçom') !!} &nbsp;&nbsp;&nbsp;&nbsp;
	{!! Form::radio('cargo', 'gerente', '', ['class' => 'field', 'style' => 'width: 20px; height: 20px']) !!}
	{!! Form::label('Gerente') !!}
	<br>

	<a href = "/administrador/listarFuncionarios" style = "margin-left: 300px; width: 100px" class = "btn btn-default">Cancelar</a>
	{!! Form::submit('Salvar', array('class' => 'btn btn-primary', 'style' => 'margin-left: 30px; width: 100px')) !!}
{!! Form::close()!!}
</div>
@endsection