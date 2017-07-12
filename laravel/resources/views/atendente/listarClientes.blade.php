<br><br>
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
      
      <button type = "button" id = "btnNovoCliente" onclick = "abrirModalCadastrarClientes()" class = "btn btn-success" style = "width: 200px; float: right"><span class = "glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Novo</button>	 
  </div>

  <br>

    <table class = "table table-bordered table-striped" id = "tabelaClientes">
    <thead>
        <tr>
            <th width="25%">Nome</th>
            <th width="10%">Telefone</th>
            <th width="10%">CEP</th>
            <th width = "35%">Endereço</th>
            <th width = "10%">Editar/Excluir</th>
            <th width = "15%">Selecionar</th>
        </tr>

    </thead>

    <tbody id = "bodyTabelaClientes">
    	
    </tbody>
</table>

	    