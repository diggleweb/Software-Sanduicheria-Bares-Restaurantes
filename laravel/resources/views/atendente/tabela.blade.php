<hr>

<br>
<br>

<div id = "ContasAbertas" style = "display: none">

	<h3 style = "margin-left: 200px">Escolha entre os itens ao lado e adicione ao pedido</h3>
	{{-- Contador de número de ítens selecionados --}}
	<div>
		<h4 style = "margin-left: 335px; display: inline-block" id = "contadorProdutosSelecionados"></h4>&nbsp;&nbsp;&nbsp;&nbsp;
		<!-- botão com ícone em 'x' para desselecionar todos os produtos selecionados -->
		<button onclick = "desselecionarProdutos()" id = "desselecionarProdutos" class = "glyphicon glyphicon-remove" style = "color: red; display: none"></button>
	</div>
	<br>
	{{-- Botão de adicionar produtos --}}
	<button style = "width: 400px; height: 80px; border: 1px solid black; margin-left: 250px; font-size: 20px" class = "btn btn-success" id = "btnAdicionar" onclick="adicionarProdutos()" ><span class = "glyphicon glyphicon-arrow-down"></span>&nbsp;&nbsp;Adicionar Produtos</button>

	<br><br><br><br>

	<h4 id = "tituloConta" style = "font-weight: bold; float: left">Conta Aberta</h4> 
	
	{{-- Botao detalhes --}}
	{{-- <button class = "btn btn-primary" style = "float: left; margin-left: 15px" name = "btnDetalhes" data-toggle = "modal" data-target = "#myModal">Detalhes</button> --}}

	<br><br>

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