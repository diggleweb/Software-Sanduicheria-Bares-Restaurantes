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

	<link rel="stylesheet" type="text/css" href="css/atendente.css">

	<div class = "row">

	<!-- Ítens -->		
		<div class="col-md-7" id = "div1">
			@include('componentes.itens')
		</div>

		
		<div class="col-md-4" id = "div2">
			@include('atendente.dadosCliente')
		

		<!-- TABELA  -->
		<div class="row" id = "dadosDaConta">
			@include('atendente.tabela')
		</div>
		<!-- FIM DA TABELA -->	

	</div>


	@include('componentes.modalDetalhesContas')

	@include('atendente.modalListarClientes')

	@include('componentes.modalDetalhesPedidos')

	@include('atendente.modalEditarCliente')
	
	@include('atendente.modalNovoCliente')

	@include('atendente.modalExcluirCliente')

	
	<script src = "{{ asset('js/atendente/atendente.js') }}" type="text/javascript"></script>
@endsection