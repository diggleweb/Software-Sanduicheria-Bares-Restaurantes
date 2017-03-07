@extends('comum')

@section('titulo')
{{ 'Listar Itens' }}
@endsection

{{-- Controller associado: ItensController
Variaveis:
$itens
$filtrarPor
$filtro
--}}

@section('corpo')

	<div class="page-header">
		<h1>Bem-vindo, administrador!</h1>
	</div>
	
	<ol class="breadcrumb">
	 	 <li><a href="/">Garçom</a></li>
	  	<li class="active"><a href="/administrador">Administrador</a></li>
	  	<li class="active">Itens</li>
	  	<a style = "float: right" href = "/auth/logout">Logout</a>
	</ol>

	<div class = "container">
		<h1>Lista de Itens</h1>

		<br>

		<div class="row">
			{{-- Botão de adicionar novo item --}}
			<div class="col-md-6">
				<a href = "/administrador/listarItens/novoItem" class = "btn btn-primary" style = "width: 200px;">Novo</a>
			</div>

			<div class = "col-md-6">
				<?php
					if (!isset($filtro))
						$filtro = null;
					if (!isset($filtrarPor))
						$filtrarPor = null;
				?>

				{{-- Filtrar --}}
				{!! Form::open(array('method' => 'GET', 'route' => 'filtrarItem')) !!}
					{!! Form::select('filtrarPor', array('nome' => 'Nome'), null, array("class" => "form-control", "style" => "width: 115px; display: inline-block"), $filtrarPor) !!}
					{!! Form::text('filtro', $filtro, array("autofocus", "class" => "form-control", "style" => "width: 200px; display: inline-block; ")) !!}
					{!! Form::submit('Filtrar', array('class' => 'btn btn-primary', 'style' => 'width: 100px')) !!}
				{!! Form::close() !!}
			</div>
		</div>

		<br><br>

		<!--Tabela-->
		<table class = "table">
			<!-- cabecalho da tabela -->
			<thead>
				<tr>
					<th class = "tituloTabela">Imagem</th>
					<th class = "tituloTabela">Nome</th>
					<th class = "tituloTabela">Preço de Compra</th>
					<th class = "tituloTabela">Preço de Venda</th>
					<th class = "tituloTabela">Lucro</th>
					
				</tr>
			</thead>

			<!-- corpo da tabela -->
			<tbody>
				
				
				{{-- Lista de produtos referentes a uma determinada categoria --}}
				@foreach($itens as $item)
				
				<?php
					//calcula o lucro de cada iconv(in_charset, out_charset, str)tem
					$lucro = $item->precoVenda - $item->precoCompra;
					//passa para duas casas decimais
					$lucro = number_format($lucro, 2);

					//calcula a porcentagem deste lucro
					$porcentagemLucro = ($lucro * 100)/$item->precoCompra;
					//passa para duas casas decimais
					$porcentagemLucro = number_format($porcentagemLucro, 2);
				?>


					<tr>
						<td style = "text-align: center; font-weight: bold; font-size: 16px"><img src = "/{{$item->urlImagem}}" width = "70" height = "70" alt = "imagem nao encontrada"></td>
						<td style = "text-align: center; font-weight: bold">{{ucfirst($item->nome)}}</td>

						<td style = "text-align: center">R$ {{number_format($item->precoCompra, 2)}}</td>
						<td style = "text-align: center">R$ {{number_format($item->precoVenda, 2)}}</td>
						<td style = "text-align: center">R$ {{$lucro}} ({{$porcentagemLucro}} %)</td>
						<td style = "text-align: center">
							{!! link_to_route('editarItem', 'Editar', array('id' => $item->id), array('class' => 'btn btn-primary')) !!}

							<button class = "btn btn-danger" id = "{{$item->id}}" name = "botaoExcluir" onclick = "excluirItem(this.id)">Excluir</button>
						</td>
					</tr>
				@endforeach

			</tbody>		
		</table>

		<!-- Modal para confirmacao de senha ao excluir um produto -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Excluir Item</h4>
		      </div>

		      <div class="modal-body" style = "height: 155px">
		      
		      	<form action = "javascript:confirmarSenha()" id = "formulario">
		      		<label id = "mensagem" style = "color: red"></label>
		      		<label>Para excluir o item desejado, por favor, digite a senha do administrador:</label>
			      	<input type = "password" id = "password" class = "form-control" autofocus>
			      	<br>
			      	<div style = "float: right">
			      		
			      		<input type = "submit" class = "btn btn-primary" value = "Confirmar">
			      	</div>
		      	</form>
		      </div>
		      
		    </div>
		  </div>
		</div>


		<br><br>

		<style type="text/css">
		.tituloTabela {
			text-align: center;
			font-size: 17px;
		}
		</style>

			
		<script type="text/javascript">
			function excluirProduto(id) {
				idGlobal = id;
				//para evitar que toda vez que clicar em 'excluir' o modal volte com a senha preenchida e a mensagem de 'senha incorreta', precisamos zerar estes valores antes de abrir o modal
				$("#mensagem").text("");
				$("#password").val("");
				$("#myModal").modal('show');		//abre o modal. Dentro do modal, há um formulário que chama a função 'confirmarSenha', que irá confirmar a senha e eventualmente excluir o produto
				$('.modal').on('shown.bs.modal', function() {
				  $(this).find('[autofocus]').focus();
				});
			}

			//armazena o id do item a ser excluído
			var idItem;

			function excluirItem(id) {
				$("#myModal").modal('show');
				idItem = id;
			}

			//função chamada pelo formulário do modal que é liberado assim que o usuário clica em 'excluir'
			function confirmarSenha() {
	 			var val = $("#password").val();		//pega a senha que o usuário escreveu no input
				
				if (val == "123123") {		//caso a senha esteja correta, excluir o produto
					$.get( "/excluirItem", {"id": idItem} , function( data ) {
					  location.reload(true);
					});
				} else {		//caso a senha nao esteja correta, mensagem para o usuario
					$("#mensagem").text("Senha incorreta! Produto não excluído!");
				}

			}
		</script>
	
@endsection