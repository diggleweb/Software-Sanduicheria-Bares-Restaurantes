@extends('comum')

@section('titulo')
	Tela do Gerente
@endsection	
{{-- AdministradorController utiliza este layout --}}
{{-- Variáveis que vêm do controller: 
'urlMaisVendido', 'nomeGarcom', 'lucroTotal', 'produtoMaisLucrativo', $produtoMaisLucrativo, 'urlMaisLucrativo','lucroProdutoMaisLucrativo', 'unidadesProdutoMaisVendido', 'qtdeVendidaFuncionario' --}}

@section('corpo')
	<div class="page-header">
		<h1>Bem-vindo, administrador!</h1>
	</div>
	
	{{-- Barra de navegações --}}
	<ol class="breadcrumb">
	 	<li><a href="/">Garçom</a></li>
	  	<li class="active">Administrador</li>
	  	<a style = "float: right" href = "/auth/logout">Logout</a>
	</ol>

	<div class = "container">

	{{-- Produto mais vendido --}}
		<div class = "opcoes" style = "background-color: #519251">
			<h2 class = "tituloDasOpcoes" >Produto mais vendido</h2>
			<img style = "margin-left: 120px" src = "{{$urlMaisVendido}}" height = "100" width = "100">
			<p class = "valorOpcoes">{{$nomeProduto}}</p>
			<p class = "valorOpcoes">Vendidos: {{$unidadesProdutoMaisVendido}}</p>
		</div>


	{{-- Produto mais lucrativo --}}
		<div class = "opcoes" style = "background-color: #2c4985">
			<h2 class = "tituloDasOpcoes">Produto mais lucrativo</h2>
			<img style = "margin-left: 120px" src = "{{$urlMaisLucrativo}}" height = "100" width = "100">
			<p class = "valorOpcoes">{{$produtoMaisLucrativo}}</p>
			<p class = "valorOpcoes">Lucrou: R$ {{$lucroProdutoMaisLucrativo}}</p>
		</div>


	{{-- Garçom que mais atendeu --}}
		<div class = "opcoes" style = "background-color: purple">
			<h2 class = "tituloDasOpcoes">Funcionário que vendeu mais produtos</h2>
			<br>
			<p class = "valorOpcoes" style = "font-size: 30px">{{$nomeFuncionario}}</p>
			<br>
			<p class = "valorOpcoes">Produtos vendidos: {{$qtdeVendidaFuncionario}}</p>
		</div>


	{{-- Lucro Total --}}
		<div class = "opcoes" style = "background-color: #FF7800">
			<h2 class = "tituloDasOpcoes">Lucro Total</h2>
			<br>
			<p class = "valorOpcoes" style = "font-size: 40px">R$ {{$lucroTotal}}</p>
		</div>


	{{-- Contas encerradas --}}
		<div class = "opcoes reduzido" onclick = "location.href = '/administrador/contasEncerradas';"  style = "cursor: pointer; background-color: black">
			<h2 class = "tituloOpcoesPequeno">Contas Encerradas</h2>
		</div>


	{{-- Funcionários --}}
		<div class = "opcoes reduzido" onclick = "location.href = '/administrador/listarFuncionarios';"  style = "cursor: pointer; background-color: #8D0000">
			<h2 class = "tituloOpcoesPequeno">Funcionários</h2>
		</div>


	{{-- Produtos --}}
		<div class = "opcoes reduzido" onclick = "location.href = '/administrador/listarProdutos';"  style = "cursor: pointer; background-color: #A19F00">
			<h2 class = "tituloOpcoesPequeno">Produtos</h2>
		</div>

	{{-- Itens --}}
		<div class = "opcoes reduzido" onclick = "location.href = '/administrador/listarItens';"  style = "cursor: pointer; background-color: #33A08A">
			<h2 class = "tituloOpcoesPequeno">Itens</h2>
		</div>
	</div>

@endsection