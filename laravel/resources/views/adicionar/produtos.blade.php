@extends('comum')

@section('titulo')
{{'Novo Produto'}}
@endsection

@section('corpo')

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
		
		{!! Form::label('Categoria: ') !!} <br>
		{!! Form::select('categoria', array('1' => 'Sanduíches', '2' => 'Bebidas', '3' => 'Porções', '4' => 'Pratos'), null, array("onKeyDown" => "verificar(this)", "onKeyUp" => "verificar(this)", "onChange" => "verificar(this)", "class" => "form-control", "style" => "width: 300px; float: left")) !!}

		<!-- botão que irá abrir o modal para adicionar ítens ao sanduíche (só funciona para sanduíche) -->
		<button type="button" id = "btnAdicionarItens" style = "margin-left: 30px; float: left" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-keyboard="false">
		  Adicionar Itens ao sanduíche
		</button>

			<br><br><br>

			<p id = "paragrafoExplicativo">OBS: O preço de compra e o preço de venda deste sanduíche será determinado pelos preços de compra e de venda dos itens adicionados a este sanduíche.</p>

			<!-- Irá aparecer os nomes dos ítens selecionados aqui -->
			<div id = "tituloItensSelecionados" style = "text-size: 30px; font-weight: bold; color: black">Ítens que compõem o sanduíche: </div>
			<div id = "itensSelecionados" style = "text-size: 20px; font-weight: bold; color: green"></div>

		<div id = "divPrecos">
			<br>
			{!! Form::label('labelPrecoCompra', 'Preço de Compra: ') !!}
			{!! Form::text('precoCompra', '', array('class' => 'form-control', 'style' => 'width: 150px', 'maxlength' => '15')) !!}
			<br>
			{!! Form::label('labelPrecoVenda', 'Preço de Venda: ') !!} <br>
			{!! Form::text('precoVenda', '', array('class' => 'form-control', 'style' => 'width: 150px', 'maxlength' => '15')) !!}
			<br>
		</div>

		
		{!! Form::hidden('itens', '') !!}
		
		<!-- Modal para adicionar ítens ao sanduíche -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Adicionar itens ao sanduíche</h5>
		        <button type="button" id = "closebutton" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p style = "font-weight: bold; font-size: 30px">Este sanduíche é composto por quais itens?</p>
		        <br>
		        <div>
			        @foreach($itens as $item)
			        	<div class = "divCadaItem"  data-nome = "{{ucfirst($item->nome)}}" val = "{{$item->id}}" data-clicked = "0" data-precoVenda = "{{$item->precoVenda}}" data-precoCompra = "{{$item->precoCompra}}">
			        		<img src="/{{$item->urlImagem}}" class = "imagemItem">
			        		<h5 class = "nomeItem">{{ucfirst($item->nome)}}</h5>
			        		<h4 style="color: #132DCE; text-align: center; text-weight: bold">R$ {{number_format($item->precoVenda, 2)}}</h4>
			        	</div>
			        @endforeach
		        </div>
		        <br>
		        <h5 id = "textoTotalCompra" style = "float: right; color: red; font-size: 16px">Custo do sanduíche: R$ 0.00</h5>
		        <br>
		        <br>
		        <h5 id = "textoTotalVenda" style = "float: right; color: blue; font-size: 20px">Preço de venda do sanduíche: R$ 0.00</h5>
		        <br>
		        <br>
		        <br>
		       
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary" onclick = "salvarItens()">Concluir</button>
		      </div>
		    </div>
		  </div>
		</div>

		<br><br>

		{!! Form::label('Imagem: ') !!} <br>
		<input type = "file" name = "urlImagem" accept="image/*"/>
		<br><br>
		<a href = "/administrador/listarProdutos" style = "margin-left: 300px; width: 100px" class = "btn btn-default">Cancelar</a>
		{!! Form::submit('Salvar', array('class' => 'btn btn-primary', 'style' => 'margin-left: 30px; width: 100px')) !!}
	{!! Form::close()!!}
	</div>

	<script src = "{{ asset('js/produtos/adicionarProdutos.js') }}" type="text/javascript"></script>

@endsection

