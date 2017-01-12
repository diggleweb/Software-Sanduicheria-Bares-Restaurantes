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

			<h4 class = "tituloCategoria">Sanduíches</h4>
				<div>
					<!-- percorre cada sanduíche no array 'sanduiches' p/ preencher os valores -->
					@foreach($sanduiches as $sanduiche)
						<div class = "divCadaItem"  val = "{{$sanduiche->id}}" data-categoria = "sanduiche">
							<img src="{{$sanduiche->urlImagem}}" class = "imagemItem">
							<h5 class = "nomeItem">{{$sanduiche->nome}}</h5>
							<h4 style = "color: red; text-align: center;">R$ {{number_format($sanduiche->precoVenda, 2, ".", "")}}</h4>
							<button name = "btnAbrirDetalhes" class = "btn btn-primary" onclick = "abrirModalSanduiches('{{$sanduiche->nome}}', {{$sanduiche->precoVenda}}, '{{$sanduiche->urlImagem}}')">Detalhes</button>
						</div>
					@endforeach
				</div>

			<hr>

			<h4 class = "tituloCategoria">Bebidas</h4>
				<div>
					@foreach($bebidas as $bebida) 
						<div class = "divCadaItem" val = "{{$bebida->id}}">
							<img src="{{$bebida->urlImagem}}" class = "imagemItem">
							<h5 class = "nomeItem">{{$bebida->nome}}</h5>
							<h4 style = "color: red; text-align: center">R$ {{number_format($bebida->precoVenda, 2, ".", "")}}</h4>
							<button name = "btnAbrirDetalhes" data-toggle = "modal" data-target = "#modalDetalhesPedido" class = "btn btn-primary">Detalhes</button>
						</div>
					@endforeach
					
				</div>

			<hr>

			<br>

			<h4 class = "tituloCategoria">Porções</h4>
				<div>
					
					@foreach($porcoes as $porcao)
						<div class = "divCadaItem" val = "{{$porcao->id}}">
							<img src="{{$porcao->urlImagem}}" class = "imagemItem">
							<h5 class = "nomeItem">{{$porcao->nome}}</h5>
							<h4 style = "color: red; text-align: center">R$ {{number_format($porcao->precoVenda, 2, ".", "")}}</h4>
							{{-- <button name="btnAbrirDetalhes" onclick = "abrirModalDetalhes({{$porcao->id}})" data-toggle = "modal" data-target = "#modalDetalhesPedido" class = "btn btn-primary">Detalhes</button> --}}
							<button name="btnAbrirDetalhes" data-toggle = "modal" data-target = "#modalDetalhesPedido" class = "btn btn-primary">Detalhes</button>
						</div>
					@endforeach
					
				</div>
			<hr>

			<h4 class = "tituloCategoria">Pratos</h4>
				<div>

					@foreach($pratos as $prato)
						<div class = "divCadaItem" val = "{{$prato->id}}">
							<img src="{{$prato->urlImagem}}" class = "imagemItem">
							<h5 class = "nomeItem">{{$prato->nome}}</h5>
							<h4 style = "color: red; text-align: center">R$ {{number_format($prato->precoVenda, 2, ".", "")}}</h4>
							<button name = "btnAbrirDetalhes" data-toggle = "modal" data-target = "#modalDetalhesPedido" class = "btn btn-primary">Detalhes</button>
						</div>
					@endforeach
					
				</div>
			<hr>
		
		</div>
	

	<!-- Números das mesas -->
		<div class="col-md-5" id = "div2">
			<div class="row">
				<h1>Mesas</h1>
				<!-- Adiciona todas as imagens dos números das mesas -->
				@for($i = 1 ; $i <= 8 ; $i++) 
					<div class = "numeros" id = "{{$i}}">
						<img src="imagens/numeros/{{$i}}.jpg" alt="{{$i}}" height = "90" width = "90">
					</div>
				@endfor
				
			</div>




		<!-- TABELA  -->
			<div class="row" id = "dadosDaConta">
				<br><br><br><br>
					
					<div>
						<!-- contador de número de ítens selecionados -->
						<h4 style = "margin-left: 335px; display: inline-block" id = "contadorProdutosSelecionados"></h4>&nbsp;&nbsp;&nbsp;&nbsp;
						<!-- botão com ícone em 'x' para desselecionar todos os produtos selecionados -->
						<button onclick = "desselecionarItens()" id = "desselecionaritens" class = "glyphicon glyphicon-remove" style = "color: red; display: none"></button>
					</div>

					<br>

					<button style = "width: 400px; margin-left: 250px; height: 50px; font-size: 20px" class = "btn btn-success" id = "btnAdicionar" >Adicionar Produtos</button>

					<br><br><br><br>
				
					<h4 id = "tituloConta" style = "font-weight: bold; float: left">Conta Aberta</h4> 
					
					{{-- Botao detalhes --}}
					<button class = "btn btn-primary" style = "float: left; margin-left: 15px" name = "btnDetalhes" data-toggle = "modal" data-target = "#myModal">Detalhes</button>
				
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
  <div class="modal-dialog" role="document">
    <div class="modal-content" style = "height: 900px">
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
      			<h2 class = "preco" style = "text-align: right; float: right; padding-top: 8px"></h2>
      		</div>
	  </div>

	        {{-- Imagem --}}
	      	<img class = "imagem" src = "#" height = "110" width = "110">
	      	<br>
	        
	        <br><br>
	        <h3>Deseja adicionar ou retirar alguns itens?</h3>
	        {{-- Itens --}}
	        <input type = "checkbox" name = "" value = "bacon"><span>&nbsp;Bacon</span><br>
	        <input type = "checkbox" name = "" value = "bacon">Mussarela<br>
	        <input type = "checkbox" name = "" value = "bacon">Tomate<br>
	        <input type = "checkbox" name = "" value = "bacon">Alface<br>
	        <input type = "checkbox" name = "" value = "bacon">Salsicha<br>
	        <input type = "checkbox" name = "" value = "bacon">Presunto<br>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalDetalhesPedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style = "height: 900px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" class = "titulo" style = "font-weight: bold">Detalhes do Pedido (Nome do pedido)</h4>
      </div>
      <div class="modal-body" style = "height: 195px;">
        <h1 class = "nome">Nome</h1>
        <h2>Preco: <div class = 'preco'>R$ 20,00</div></h2>

        <input type = "checkbox" name = "" value = "bacon"><span>&nbsp;Bacon</span><br>
        <input type = "checkbox" name = "" value = "bacon">Mussarela<br>
        <input type = "checkbox" name = "" value = "bacon">Tomate<br>
        <input type = "checkbox" name = "" value = "bacon">Alface<br>
        <input type = "checkbox" name = "" value = "bacon">Salsicha<br>
        <input type = "checkbox" name = "" value = "bacon">Presunto<br>

      </div>
    </div>
  </div>
</div>



<script type="text/javascript" src = "js/garcom.js"></script>


@endsection