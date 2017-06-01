
	<link rel="stylesheet" type="text/css" href="garcomMobile.css">
	
	<div class="container">
		{{-- Mesas --}}
		<div class="row">
			<h5>Mesas</h5>
			<!-- Adiciona todas as imagens dos números das mesas -->
			@for($i = 1 ; $i <= 8 ; $i++) 
				<div class = "numeros" id = "{{$i}}">
					<img src="imagens/numeros/{{$i}}.jpg" alt="{{$i}}" height = "35" width = "35">
				</div>
			@endfor
		</div>


		{{-- Sanduíches --}}
		<div class="row">
				<h4 class = "tituloCategoria">Sanduíches</h4>
					<div>
						<!-- percorre cada sanduíche no array 'sanduiches' p/ preencher os valores -->
						@foreach($sanduiches as $sanduiche)
							<div class = "divCadaItem"  val = "{{$sanduiche->id}}" data-categoria = "sanduiche" data-clicked = "0">
								<img src="{{$sanduiche->urlImagem}}" class = "imagemItem">
								<h5 class = "nomeItem">{{$sanduiche->nome}}</h5>
								<h4 style = "color: red; text-align: center;">R$ {{number_format($sanduiche->precoVenda, 2, ".", "")}}</h4>
								<button name = "btnAbrirDetalhes" class = "btn btn-primary" onclick = "abrirModalSanduiches('{{$sanduiche->id}}', '{{$sanduiche->nome}}', {{$sanduiche->precoVenda}}, '{{$sanduiche->urlImagem}}'); event.stopPropagation();">Detalhes</button>
							</div>
						@endforeach
					</div>
				<hr>
		</div>

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



		{{-- Modal detalhes dos pedidos --}}
		{{-- Modal: detalhes do pedido (para sanduiches) --}}
		<!-- Modal -->
		<div class="modal fade" id="modalDetalhesPedidoSanduiches" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document" style = " width: 700px; margin: auto;">
		    <div class="modal-content" style = "height: 1150px">
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
				        		<div class = "col-sm-5">
							        <div style = "float: left">	
							       			<span name="ok" class = "glyphicon glyphicon-ok" style ="color: green; visibility: hidden" data-id={{$item->id}}></span>
							        		<span style = "font-weight: bold; font-size: 20px">&nbsp;{{ucfirst($item->nome)}}</span> &nbsp; 
								        	<br>
								        	<label class = "precoVendaItem" style = "margin-left: 30px">Preço por unidade: R$ {{number_format($item->precoVenda, 2)}}</label>
							        </div>
				        		</div>

				        		<div class = "containerBotoes" data-id = "{{$item->id}}" data-valor = "{{$item->precoVenda}}">
						    		{{-- Botoes +- --}}
					        		<div class = "col-sm-3">
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
					        		<div class = "col-sm-4">
							    	    <div class="input-group precoTotal" style = "margin-left: 15px; float: left" >
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

	{{-- Fim do container --}}
	</div>	