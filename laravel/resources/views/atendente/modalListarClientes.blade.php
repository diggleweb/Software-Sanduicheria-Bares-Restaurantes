<!-- Modal (listar clientes) -->
	<!-- Modal -->
	<div class="modal fade" id="modalListarClientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
	  <div class="modal-dialog" role="document" style = " width: 1600px; margin: auto; margin-top: 50px">
	    <div class="modal-content" >
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel2">Listar Clientes</h4>
	      </div>
	      <div class="modal-body">

	      <div class="form-inline">

	      	  <div class="form-group">
	      	    <label for = "selectFiltrar" style = "font-size: 18px">Filtrar por: </label>
	      	    <select class = "form-control" style = "width: 300px" id = "selectFiltrar">
			      	<option value = "telefone">Telefone</option>
			      	<option value = "nome">Nome</option>
			      	<option value = "cep">CEP</option>
			      	<option value = "endereco">Endereço</option>
		     	 </select>
	      	  </div>

	      	  &nbsp;&nbsp;&nbsp;

	      	  <div class="form-group">
	      	     <label for="txtFiltrar" style = "font-size: 18px" value="">Filtro: </label>
		      	{{-- <input type="text" class = "form-control" id="txtFiltrar" autofocus onchange="filtrarCliente()" style = "width: 300px" value = "(62"> --}}
		      	{!! Form::text('filtrartel', '', array('id'=>'txtFiltrar', 'class' => 'form-control', 'autofocus', 'style' => 'width: 300px')) !!}
		      	<button type = "button" id="btnFiltrarCliente" onclick="filtrarCliente()" class = "btn btn-primary" style = "width: 100px">Filtrar</button>
	      	  </div>
		      	 
	      </div>

	      <br>

	        <table class = "table table-bordered table-striped" id = "tabelaClientes">
	        <thead>
	            <tr>
	                <th width="25%">Nome</th>
	                <th width="10%">Telefone</th>
	                <th width="10%">CEP</th>
	                <th width = "35%">Endereço</th>
	                <th width = "10%">Edit/Excluir</th>
	                <th width = "15%">Selecionar</th>
	            </tr>

	        </thead>

	        <tbody id = "bodyTabelaClientes">
	        	
	        </tbody>
	    </table>

	      </div>
	    </div>
	  </div>
	</div>
