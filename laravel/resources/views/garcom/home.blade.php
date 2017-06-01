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

{{-- Controller: homecontroller.php --}}



<!-- Título -->
@section('titulo')
	Tela do Garçom
@endsection


@section('corpo')

	<link rel="stylesheet" type="text/css" href="css/garcom.css">

	{{-- Versão mobile --}}
@if ($agent->isMobile())
	@include('garcom.mobile')	
	{{-- Versão desktop --}}
@elseif ($agent->isDesktop())
	@include('garcom.desktop')	
@endif

	<script src = "{{ asset('js/garcom/garcom.js') }}" type="text/javascript"></script>
@endsection