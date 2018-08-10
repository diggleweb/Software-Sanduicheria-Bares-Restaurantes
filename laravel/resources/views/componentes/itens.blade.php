
<div id = "mensagemAlerta" class = "alert alert-info" role = "alert" >
	<h1 style = "font-color: red">Você deve escolher um cliente para poder adicionar os itens <span style = "float: right" class = "glyphicon glyphicon-arrow-right"></span></h1>
</div>

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
					{{-- <button name = "btnAbrirDetalhes" data-toggle = "modal" data-target = "#modalDetalhesPedido" class = "btn btn-primary">Detalhes</button> --}}
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
					{{-- <button name = "btnAbrirDetalhes" data-toggle = "modal" data-target = "#modalDetalhesPedido" class = "btn btn-primary">Detalhes</button> --}}
				</div>
			@endforeach
		</div>
	<hr>

