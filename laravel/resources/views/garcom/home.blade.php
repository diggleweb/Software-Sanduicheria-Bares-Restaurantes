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

	<div class = "row">
	<!-- Ítens -->		


		<div class="col-md-7" id = "div1">

		{{-- Sanduíches --}}
			<h4 class = "tituloCategoria">Sanduíches</h4>
				<div>
					<!-- percorre cada sanduíche no array 'sanduiches' p/ preencher os valores -->
					@foreach($sanduiches as $sanduiche)
						<div class = "divCadaItem"  val = "{{$sanduiche->id}}" data-categoria = "sanduiche" data-clicked = "0">
							<img src="{{$sanduiche->urlImagem}}" class = "imagemItem">
							<h5 class = "nomeItem">{{$sanduiche->nome}}</h5>
							<h4 style = "color: red; text-align: center;">R$ {{number_format($sanduiche->precoVenda, 2, ".", "")}}</h4>
							<button name = "btnAbrirDetalhes" class = "btn btn-primary" onclick = "abrirModalSanduiches('{{$sanduiche->id}}', '{{$sanduiche->nome}}', {{$sanduiche->precoVenda}}, '{{$sanduiche->urlImagem}}')">Detalhes</button>
						</div>
					@endforeach
				</div>

			<hr>

		{{-- Bebidas --}}
			<h4 class = "tituloCategoria">Bebidas</h4>
				<div>
					@foreach($bebidas as $bebida) 
						<div class = "divCadaItem" val = "{{$bebida->id}}" data-clicked = "0">
							<img src="{{$bebida->urlImagem}}" class = "imagemItem">
							<h5 class = "nomeItem">{{$bebida->nome}}</h5>
							<h4 style = "color: red; text-align: center">R$ {{number_format($bebida->precoVenda, 2, ".", "")}}</h4>
							<button name = "btnAbrirDetalhes" data-toggle = "modal" data-target = "#modalDetalhesPedido" class = "btn btn-primary">Detalhes</button>
						</div>
					@endforeach
				</div>

			<hr>
			<br>

		{{-- Porções --}}
			<h4 class = "tituloCategoria">Porções</h4>
				<div>
					
					@foreach($porcoes as $porcao)
						<div class = "divCadaItem" val = "{{$porcao->id}}" data-clicked = "0">
							<img src="{{$porcao->urlImagem}}" class = "imagemItem">
							<h5 class = "nomeItem">{{$porcao->nome}}</h5>
							<h4 style = "color: red; text-align: center">R$ {{number_format($porcao->precoVenda, 2, ".", "")}}</h4>
							{{-- <button name="btnAbrirDetalhes" onclick = "abrirModalDetalhes({{$porcao->id}})" data-toggle = "modal" data-target = "#modalDetalhesPedido" class = "btn btn-primary">Detalhes</button> --}}
							<button name="btnAbrirDetalhes" data-toggle = "modal" data-target = "#modalDetalhesPedido" class = "btn btn-primary">Detalhes</button>
						</div>
					@endforeach
				</div>
			<hr>

		{{-- Pratos --}}
			<h4 class = "tituloCategoria">Pratos</h4>
				<div>
					@foreach($pratos as $prato)
						<div class = "divCadaItem" val = "{{$prato->id}}" data-clicked = "0">
							<img src="{{$prato->urlImagem}}" class = "imagemItem">
							<h5 class = "nomeItem">{{$prato->nome}}</h5>
							<h4 style = "color: red; text-align: center">R$ {{number_format($prato->precoVenda, 2, ".", "")}}</h4>
							<button name = "btnAbrirDetalhes" data-toggle = "modal" data-target = "#modalDetalhesPedido" class = "btn btn-primary">Detalhes</button>
						</div>
					@endforeach
				</div>
			<hr>
		</div>
	

	{{-- Número de mesas --}}
		<div class="col-md-5" id = "div2">
			<div class="row">
				<h1>Mesas</h1>
				<!-- Adiciona todas as imagens dos números das mesas -->
				@for($i = 1 ; $i <= 8 ; $i++) 
					<div class = "numeros" id = "{{$i}}">
						<img src="imagens/numeros/{{$i}}.jpg" alt="{{$i}}" height = "60" width = "60">
					</div>
				@endfor
			</div>


		<!-- TABELA  -->
			<div class="row" id = "dadosDaConta">
				<br><br>

				{{-- Contador de número de ítens selecionados --}}
					<div>
						<h4 style = "margin-left: 335px; display: inline-block" id = "contadorProdutosSelecionados"></h4>&nbsp;&nbsp;&nbsp;&nbsp;
						<!-- botão com ícone em 'x' para desselecionar todos os produtos selecionados -->
						<button onclick = "desselecionarProdutos()" id = "desselecionarProdutos" class = "glyphicon glyphicon-remove" style = "color: red; display: none"></button>
					</div>

					<br>

				{{-- Botão de adicionar produtos --}}
					<button style = "width: 400px; height: 80px; border: 1px solid black; margin-left: 250px; font-size: 20px" class = "btn btn-success" id = "btnAdicionar" onclick="adicionarProdutos()" >Adicionar Produtos</button>

					<br><br><br><br>
				
					<h4 id = "tituloConta" style = "font-weight: bold; float: left">Conta Aberta</h4> 
					
				{{-- Botao detalhes --}}
					<button class = "btn btn-primary" style = "float: left; margin-left: 15px" name = "btnDetalhes" data-toggle = "modal" data-target = "#myModal">Detalhes</button>

					<br><br>
				<style>
					tbody {
						font-family: Tahoma, Geneva, sans-serif;
						font-weight: bold;
					}
				</style>
				<table class = "table table-bordered table-striped" style = "width: 850px">
					<thead>
					{{-- CABEÇALHO DA TABELA --}}
						<tr>
							<th style = "text-align: center">Nome do Produto</th>
							<th style = "text-align: center">Preço por Unidade(R$)</th>
							<th style = "text-align: center">Quantidade</th>
							<th style = "text-align: center;">Total (R$)</th>
							<th width = "20%" style = "text-align: center">Ação</th>
						</tr>
					</thead>

					<tbody id = "tabela">
					{{-- o body é preenchido por uma função javascript (AtualizarTabela()) --}}
					</tbody>
						
				</table>
		

				<!-- Armazena sempre o ID da conta da última mesa que foi clicada -->
				<input type = "hidden" id = "idConta"> 

				<button style = "width: 300px; margin-left: 285px; height: 50px; font-size: 20px" class = "btn btn-danger" id = "btnEncerrar">Encerrar Conta</button>
		
			</div>
		<!-- FIM DA TABELA -->	

			<!-- div que irá aparecer assim que o garçom clicar em uma mesa que não tenha uma conta associada -->
			<div id = "botoesGarcons">
				<h2 style = "color: red">Nenhuma conta aberta para esta mesa.</h2>
				<h3 style = "color: blue"> Selecione um garçom responsável para abrir uma nova conta para esta mesa. </h3>
				<br>
					@foreach($funcionarios as $funcionario)
						<button  id = "{{$funcionario->id}}" name = "adicionarConta" style = "width: 200px; height: 40px; margin-top: 20px; margin-right: 20px" class = "btn btn-primary">{{ $funcionario->nome }}</button>
					@endforeach
			</div>

	</div>
</div>

<style>
	tr th {
		text-align: center;
	}
</style>


<!-- Modal (detalhes da conta) -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalhes da Conta</h4>
      </div>
      <div class="modal-body">
        <table class = "table table-bordered table-striped" id = "tabelaDetalhes">
        <thead>
            <tr>
                <th width="15%">Horário Pedido</th>
                <th width="45%">Nome do Produto</th>
                <th width="30%">Preço (R$)</th>
            </tr>

        </thead>

        <tbody id = "bodyTabelaDetalhes">

        </tbody>
    </table>

      </div>
    </div>
  </div>
</div>


{{-- Modal: detalhes do pedido (para sanduiches) --}}
<!-- Modal -->
<div class="modal fade" id="modalDetalhesPedidoSanduiches" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style = " width: 750px; margin: auto;">
    <div class="modal-content" style = "height: 1100px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" class="descricao" style = "font-weight: bold">Adicionar ou remover itens do pedido</h4>
      </div>
      <div class="modal-body" style = "height: 195px;">


      <div class="row">
      		<div class = "col-md-8">
      			{{-- Nome --}}
      			<h1 class = "nome" style = "text-align: left; float: left;">Nome</h1>
      		</div>
      		<div class = "col-md-4">
      			{{-- Preço --}}
      			<h2 class = "preco" style = "text-align: right; color: green; float: right; padding-top: 8px"></h2>
      			<br>
      			<div style = "float: right">(Preço Total)</div>
      		</div>
	  </div>
	  		<br>
	        	{{-- Imagem --}}
	      	<img class = "imagem" src = "#" height = "110" width = "200" style = "margin-left: 230px">
	      	<br>
	        
	        <br><br>
	        <h3>Deseja adicionar ou retirar alguns itens?</h3>
	        <div class="wrapper">
	    	  	@foreach($itens as $item)
			        {{-- Adicionar Item --}}
		        	<div class="row">
		        		<div class = "col-md-5">
					        <div style = "float: left">	
					       			<span name="ok" class = "glyphicon glyphicon-ok" style ="color: green; visibility: hidden" data-id={{$item->id}}></span>
					        		<span style = "font-weight: bold; font-size: 20px">&nbsp;{{ucfirst($item->nome)}}</span> &nbsp; 
						        	<br>
						        	<label class = "precoVendaItem" style = "margin-left: 30px">Preço por unidade: R$ {{number_format($item->precoVenda, 2)}}</label>
					        </div>
		        		</div>

		        		<div class = "containerBotoes" data-id = "{{$item->id}}" data-valor = "{{$item->precoVenda}}">
				    		{{-- Botoes +- --}}
			        		<div class = "col-md-4">
					    	  <div class="center"  style = "width: 150px;  padding-left: 0; margin: auto">
					    	    <div class="input-group">		
						          <span class="input-group-btn">
						          	  {{-- btn menos --}}
						              <button type="button" class="btn btn-danger btn-number" disabled="true" data-type="minus" data-field="{{$item->id}}">
						                <span class="glyphicon glyphicon-minus"></span>
						              </button>
						          </span>
						          {{-- quantidade --}}
						          <input type="text" name="{{$item->id}}" class="form-control input-number" value="0" min="0" max="10" style = "text-align: center">
						          <span class="input-group-btn">
						          	  {{-- btn mais --}}
						              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="{{$item->id}}">
						                  <span class="glyphicon glyphicon-plus"></span>
						              </button>
					          		</span>
					    	      </div>
					        	</div>
			        		</div>

		        		{{-- Preço total com os itens adicionados ou removidos --}}
		        		<div class = "col-md-3">
				    	    <div class="input-group precoTotal" style = "margin-left: 20px; float: left" >
				    	      <div id = "{{$item->id}}" class = "precoItem" style = "font-size: 20px; font-weight: bold; color: green">R$ {{number_format($item->precoVenda, 2)}}</div>
				        	</div>
		        		</div>
					</div>
				</div>
		        	
	    	  	@endforeach

	    	</div>

	    	  	<br><br>
		    	  	<button style = "margin-left: 250px; width: 200px; height: 50px; font-size: 20px; display:" class = "btn btn-primary btn-large" onclick = "adicionarItensAoPedido(this)">
		    	  		Concluir
		    	  	</button>
	    	  	
	   </div>
    </div>
  </div>
</div>
{{-- fim do modal --}}




	<script src = "{{ asset('js/garcom/garcom.js') }}" type="text/javascript"></script>


@endsection