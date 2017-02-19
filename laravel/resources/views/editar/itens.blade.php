@extends('comum')

@section('titulo')
{{'Editar Item'}}
@endsection

@section('corpo')

<script>
$(document).ready(
	function() {
		$('[name="nome"]').focus();
		$('[name="precoCompra"]').maskMoney({prefix: "R$ "});
		$('[name="precoVenda"]').maskMoney({prefix: "R$ "});
	}
);

//assim que submeter o formulario, devemos retirar a mascara de dinheiro do campo salario (para evitar que seja enviado R$ 1023123.1231,00 por exemplo)
$(function() {
	$('#formulario').submit(
		function() {
			$('[name="precoCompra"]').val($('[name="precoCompra"]').maskMoney('unmasked')[0]);
			$('[name="precoVenda"]').val($('[name="precoVenda"]').maskMoney('unmasked')[0]);
		}
	);
})
</script>

<div class="page-header">
	<h1>Bem-vindo, administrador!</h1>
</div>

<ol class="breadcrumb">
 	 <li><a href="/">Garçom</a></li>
  	<li class="active"><a href="/administrador">Administrador</a></li>
  	<li class="active"><a href = "/administrador/listarItens">Listar Itens</a></li>
  	<li class="active">Editar Itens</li>
</ol>


<div class = "container">
<h1>Editar item ({{$item->nome}})</h1>

@if(Session::has('mensagem')) 
	<div class = "alert alert-success" role = "alert"> {{Session::get('mensagem')}} </div>
@endif

@if($errors->any()) 
	<div class = "alert alert-danger" role = "alert"> {{$errors->first()}} </div>
@endif

{!! Form::model($item, array('id' => 'formulario', 'route' => array('updateItem', $item->id), 'method' => 'PUT', 'files' => true)) !!}
	{!! Form::label('Nome: ') !!}
	{!! Form::text('nome', null, array('class' => 'form-control', 'style' => 'width: 500px', 'maxlength' => '200')) !!}
	<br>
	{!! Form::label('Preço de Compra: ') !!}
	{!! Form::text('precoCompra', null, array('class' => 'form-control', 'style' => 'width: 150px', 'maxlength' => '15')) !!}
	<br>
	{!! Form::label('Preço de Venda: ') !!} <br>
	{!! Form::text('precoVenda', null, array('class' => 'form-control', 'style' => 'width: 150px', 'maxlength' => '15')) !!}
	<br>
	{!! Form::label('Imagem: ') !!} <br>
	<input type = "file" name = "urlImagem" accept="image/*"/>
	<br><br>
	<a href = "/administrador/listarItens" style = "margin-left: 300px; width: 100px" class = "btn btn-default">Cancelar</a>
	{!! Form::submit('Salvar', array('class' => 'btn btn-primary', 'style' => 'margin-left: 30px; width: 100px')) !!}
{!! Form::close()!!}
</div>
@endsection