@extends('comum')

@section('titulo')
{{'Novo Produto'}}
@endsection

@section('corpo')

<script>
$(document).ready(
	function() {
		$('[name="nome"]').focus();
		$('[name="precoCompra"]').maskMoney({prefix: "R$ "});
		$('[name="precoVenda"]').maskMoney({prefix: "R$ "});
	}
);

//assim que submeter o formulario, devemos retirar a mascara de dinheiro do campo salario (para evitar que seja enviado R$ 1023123.1231,00 por exemplo)
$(function() {
	$('#formulario').submit(
		function() {
			$('[name="precoCompra"]').val($('[name="precoCompra"]').maskMoney('unmasked')[0]);
			$('[name="precoVenda"]').val($('[name="precoVenda"]').maskMoney('unmasked')[0]);
		}
	);
})
</script>

<div class="page-header">
	<h1>Bem-vindo, administrador!</h1>
</div>

<ol class="breadcrumb">
 	 <li><a href="/">Garçom</a></li>
  	<li class="active"><a href="/administrador">Administrador</a></li>
  	<li class="active"><a href = "/administrador/listarProdutos">Listar Produtos</a></li>
  	<li class="active">Novo Produto</li>
</ol>


<div class = "container">
<h1>Adicionar um novo Produto</h1>

@if(Session::has('mensagem')) 
	<div class = "alert alert-success" role = "alert"> {{Session::get('mensagem')}} </div>
@endif

@if($errors->any()) 
	<div class = "alert alert-danger" role = "alert"> {{$errors->first()}} </div>
@endif

{!! Form::open(array('id' => 'formulario', 'url' => '/salvarProduto', 'method' => 'POST', 'onSubmit' => 'action(this)', 'files' => true)) !!}
	{!! Form::label('Nome: ') !!}
	{!! Form::text('nome', '', array('class' => 'form-control', 'style' => 'width: 500px', 'maxlength' => '200')) !!}
	<br>
	{!! Form::label('Preço de Compra: ') !!}
	{!! Form::text('precoCompra', '', array('class' => 'form-control', 'style' => 'width: 150px', 'maxlength' => '15')) !!}
	<br>
	{!! Form::label('Preço de Venda: ') !!} <br>
	{!! Form::text('precoVenda', '', array('class' => 'form-control', 'style' => 'width: 150px', 'maxlength' => '15')) !!}
	<br>
	{!! Form::label('Categoria: ') !!} <br>
	{!! Form::select('categoria', array('1' => 'Sanduíches', '2' => 'Bebidas', '3' => 'Porções', '4' => 'Pratos'), null, array("onKeyDown" => "verificar(this)", "onKeyUp" => "verificar(this)", "onChange" => "verificar(this)", "class" => "form-control", "style" => "width: 300px; float: left")) !!}


	<!-- botão que irá abrir o modal para adicionar ítens ao sanduíche (só funciona para sanduíche) -->
	<button type="button" id = "btnAdicionarItens" style = "margin-left: 30px; float: left" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-keyboard="false">
	  Adicionar Itens ao sanduíche
	</button>

	<!-- Modal para adicionar ítens ao sanduíche -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Adicionar itens ao sanduíche</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p style = "font-weight: bold; font-size: 30px">Este sanduíche é composto por quais itens?</p>
	        <br>
	        <div>
		        @foreach($itens as $item)
		        	<div class = "divCadaItem"  val = "{{$item->id}}" data-clicked = "0">
		        		<img src="/{{$item->urlImagem}}" class = "imagemItem">
		        		<h5 class = "nomeItem">{{$item->nome}}</h5>
		        	</div>
		        @endforeach
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" onclick = "salvarItens()">Concluir</button>
	      </div>
	    </div>
	  </div>
	</div>

	<br><br><br>

	{!! Form::label('Imagem: ') !!} <br>
	<input type = "file" name = "urlImagem" accept="image/*"/>
	<br><br>
	<a href = "/administrador/listarProdutos" style = "margin-left: 300px; width: 100px" class = "btn btn-default">Cancelar</a>
	{!! Form::submit('Salvar', array('class' => 'btn btn-primary', 'style' => 'margin-left: 30px; width: 100px')) !!}
{!! Form::close()!!}
</div>

<script type="text/javascript">

	$(document).keyup(
		function(e) {
			e.preventDefault();
			if (e.keyCode == 27)
				desselecionarItens();
		}
	);


	//assim que o usuário escolher uma categoria, verificar qual é esta categoria
	//e tomar medidas necessárias	
	function verificar(item) {
		//verifica se a categoria é sanduíche
		//caso não seja, apagar o botão 'adicionar ítens ao sanduíche'
		if (item.value != 1)
			$("#btnAdicionarItens").hide();
		else
			$("#btnAdicionarItens").show();
	}

	var itens = [];

	$('.divCadaItem').click(
		function() {
			//o item foi ou não clicado? 0 = não foi clicado; 1 = foi clicado
			var clicked = $(this).attr("data-clicked");
			
			//busca qual é o estado da borda do item que foi clicado
			var borda = $(this).css("border");

			//busca o ID do ítem clicado
			var id = $(this).attr('val');

			//caso eu esteja selecionando um novo item (pintar a borda e colocar o id do item no array)
			if (clicked == 0) {		
				$(this).css("border", "3px solid blue");	//adiciona a borda no ítem
				$(this).css("box-shadow", "0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22)");	//adiciona sombra
				//altera para o estado 'clicado' com valor true
				$(this).attr("data-clicked", 1);
				itens.push(id);		//adiciona o ítem no array
				

			//caso o item esteja sendo deselecionado
			} else {
				$(this).css("border", "0px none rgb(51, 51, 51)");	//retira a borda
				$(this).css("box-shadow", "0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)");	//retira a sombra

				var index = itens.indexOf(id);		//encontra o índice deste item no array
				
				//altera para o estado 'clicado' com valor false
				$(this).attr("data-clicked", 0);

				//remove o botão de detalhes
				$(this).next("[name='btnDetalhes']").remove();

				//remove o ítem do array
				if (index > -1)
					itens.splice(index, 1);		
			}
		}
	);

	function desselecionarItens() {
		$(".divCadaItem").css("border", "0px none rgb(51, 51, 51)");
		$(".divCadaItem").css("box-shadow", "0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)");
		itens = [];
	}

	function salvarItens() {
		
	}

</script>

@endsection

