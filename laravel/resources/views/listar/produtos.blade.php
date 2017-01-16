
@extends('comum')

@section('titulo')
{{ 'Listar Produtos' }}
@endsection

{{-- Controller associado: ProdutosController
Variaveis:
$categorias
$produtos
$arrayNumeroProdutosPorCategoria -> cada posicao refencia o numero de produtos por categoria
--}}

@section('corpo')

	<div class="page-header">
		<h1>Bem-vindo, administrador!</h1>
	</div>
	
	<ol class="breadcrumb">
	 	 <li><a href="/">Garçom</a></li>
	  	<li class="active"><a href="/administrador">Administrador</a></li>
	  	<li class="active">Listar Produtos</li>
	  	<a style = "float: right" href = "/auth/logout">Logout</a>
	</ol>

	<div class = "container">
		<h1>Lista de Produtos</h1>

		<br>

		<div class="row">
			{{-- Botão de adicionar novo produto --}}
			<div class="col-md-6">
				<a href = "/administrador/listarProdutos/novoProduto" class = "btn btn-primary" style = "width: 200px;">Novo</a>
			</div>

			<div class = "col-md-6">
				<?php
					if (!isset($filtro))
						$filtro = null;
					if (!isset($filtrarPor))
						$filtrarPor = null;
				?>

				{{-- Filtrar --}}
				{!! Form::open(array('method' => 'GET', 'route' => 'filtrar')) !!}
					{!! Form::select('filtrarPor', array('nome' => 'Nome', 'categoria' => 'Categoria'), null, array("class" => "form-control", "style" => "width: 115px; display: inline-block"), $filtrarPor) !!}
					{!! Form::text('filtro', $filtro, array("autofocus", "class" => "form-control", "style" => "width: 200px; display: inline-block; ")) !!}
					{!! Form::submit('Filtrar', array('class' => 'btn btn-primary', 'style' => 'width: 100px')) !!}
				{!! Form::close() !!}
			</div>
		</div>

		<br><br>

		<style type="text/css">
		.tituloTabela {
			text-align: center;
			font-size: 17px;
		}
		</style>

			<?php
				//esta linha existe porque categorias vem do banco de dados como um json, precisamos decodificar
				$categorias = json_decode($categorias);
			?>


			<div id = "accordion">

			<?php
		 $i = 0; 	//variavel referente ao array $arrayNumeroProdutosPorCategoria 
			?>
				@foreach($categorias as $categoria)
				
					<!-- titulo da categoria-->
					<h4>{{$categoria->nome}} ({{$arrayNumeroProdutosPorCategoria[$i]}})</h4>
					
					<?php
						$i++;
					?>
					
					<!-- conteudo dentro de cada accordion -->
					<div>
						<!--Tabela-->
						<table class = "table">
							<!-- cabecalho da tabela -->
							<thead>
								<tr>
									<th class = "tituloTabela">Nome</th>
									<th class = "tituloTabela">Categoria</th>
									<th class = "tituloTabela">Preço de Compra</th>
									<th class = "tituloTabela">Preço de Venda</th>
									<th class = "tituloTabela">Lucro</th>
									<th class = "tituloTabela">Imagem</th>
								</tr>
							</thead>

							<!-- corpo da tabela -->
							<tbody>
								

								{{-- Lista de produtos referentes a uma determinada categoria --}}
								@foreach($produtos as $produto)
									
									@if ($produto->idCategoria == $categoria->id)		<!-- verifica se a categoria do produto eh igual a categoria atual (da aba) -->
									
									<tr>
										<td style = "text-align: center; font-weight: bold; font-size: 16px">{{$produto->nome}}</td>
										<td style = "text-align: center">{{$categoria->nome}}</td>
										<td style = "text-align: center">R$ {{number_format($produto->precoCompra, 2, '.', '')}}</td>
										<td style = "text-align: center">R$ {{number_format($produto->precoVenda, 2, '.', '')}}</td>
										<td style = "text-align: center">R$ {{number_format($produto->precoVenda - $produto->precoCompra, 2, '.', '')}}</td>
										<td style = "text-align: center"><img src = "/{{$produto->urlImagem}}" width = "70" height = "70" alt = "imagem nao encontrada"></td>
										<td style = "text-align: center">

											{!! link_to_route('editarProduto', 'Editar', array('id' => $produto->id), array('class' => 'btn btn-primary')) !!}

											<button class = "btn btn-danger" id = "{{$produto->id}}" name = "botaoExcluir" onclick = "excluirProduto(this.id)">Excluir</button>
										</td>
									</tr>
									@endif
								@endforeach


							</tbody>		
						</table>

					</div>

				@endforeach

			</div> <!-- fim do accordion -->

		

	
	<!-- Modal para confirmacao de senha ao excluir um produto -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Excluir Produto</h4>
	      </div>

	      <div class="modal-body" style = "height: 155px">
	      
	      	<form action = "javascript:confirmarSenha()" id = "formulario">
	      		<label id = "mensagem" style = "color: red"></label>
	      		<label>Para excluir o produto desejado, por favor, digite a senha do administrador:</label>
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


	<script>

		var idGlobal;	//foi criada porque 'excluirProduto' recebe um id, mas este id deve ser usado pela função 'confirmarSenha'.
				//logo, deve haver uma maneira de se transferir este 'id' de uma função para a outra. Como a função 'excluirProduto' não chama
				//diretamente a função 'confirmarSenha', uma forma de transferir este id foi criando esta variável global.



		$(function() {
		    $('#formulario').each(function() {
		        $(this).find('input').keypress(function(e) {
		            // Enter pressed?
		            if(e.which == 10 || e.which == 13) {
		                this.form.submit();
		            }
		        });
		    });

		    //separacao da lista de produtos em categorias
		    $( "#accordion" ).accordion({
		      collapsible: true,
		      heightStyle: "content"
		    });

		});

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

		//função chamada pelo formulário do modal que é liberado assim que o usuário clica em 'excluir'
		function confirmarSenha() {
 			var val = $("#password").val();		//pega a senha que o usuário escreveu no input
			
			if (val == "123123") {		//caso a senha esteja correta, excluir o produto
				$.get( "/excluirProduto", {"id": idGlobal} , function( data ) {
				  location.reload(true);
				});
			} else {		//caso a senha nao esteja correta, mensagem para o usuario
				$("#mensagem").text("Senha incorreta! Produto não excluído!");
			}

		}

	</script>

@endsection