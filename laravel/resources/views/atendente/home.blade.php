@extends('comum')		<!-- Todo o conteúdo de 'comum' estará presente nesta página -->

<!-- Criação:
Gabriel Augusto De Vito
gabriel.dvt@hotmail.com
Início: 20/01/2016
-->

<!--
OBS:
Variáveis que vêm da 'HomeController' e que podem ser acessadas
pela view:
'bebidas', 'porcoes', 'pratos', 'sanduiches'
-->

{{-- Controller: atendentecontroller.php --}}


<!-- Título -->
@section('titulo')
	Tela do Garçom
@endsection


@section('corpo')

	<style type="text/css">
		body {
			background-color: #EEE;
		}

		.titulo {
			text-align: center;
		}

		.container {
			margin: auto;

		}

		.container2 {
			margin-left: 100px;
			margin-right: 100px;
		}
	</style>

	<link rel="stylesheet" type="text/css" href=" {{ asset('css/atendente.css') }}">

	<div class="container">
		<div class = "titulo">
		<br>
			<h1>Entrega de Pedidos</h1>
			
			<h3>Etapa 1/4</h3>
			
			<h2>SELECIONE UM CLIENTE</h2>
		</div>
	</div>

	<div class="container2">
		@include('atendente.listarClientes')
	</div>

		@include('atendente.modalNovoCliente');
		@include('atendente.modalEditarCliente');
		@include('atendente.modalExcluirCliente');

	<script src = "{{ asset('js/atendente/atendente.js') }}" type="text/javascript"></script>
@endsection