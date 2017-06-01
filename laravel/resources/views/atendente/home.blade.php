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
		tr th {
			text-align: center;
		}

		tbody {
			font-family: Tahoma, Geneva, sans-serif;
			font-weight: bold;
		}
	</style>


		<div class = "row">
		<!-- Ítens -->		
			<div class="col-md-7" id = "div1">
				@include('atendente.itens')
		

			
			<div class="col-md-5" id = "div2">
				@include('atendente.dadosCliente')


			<!-- TABELA  -->
				<div class="row" id = "dadosDaConta">
					@include('atendente.tabela')
				</div>
			<!-- FIM DA TABELA -->	

		</div>
	

	@include('componentes.modalDetalhesContas')

	@include('atendente.modalListarClientes')

	@include('atendente.modalDetalhesPedidos')

	@include('atendente.modalNovoCliente')


	
	<script src = "{{ asset('js/atendente/atendente.js') }}" type="text/javascript"></script>
@endsection