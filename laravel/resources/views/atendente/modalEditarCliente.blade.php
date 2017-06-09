<!-- Modal (cadastro de editar cliente) -->
<!-- Modal -->
<div class="modal fade" id="modalEditarClientes" tabindex="-1" role="dialog" aria-labelledby="titulo">
  <div class="modal-dialog" role="document"  style = " width: 1050px; margin: auto; margin-top: 100px">
    <div class="modal-content" style = "height: 650px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titulo">Editar cliente</h4>
      </div>
      <div class="modal-body">
        
	      <form action = "javascript:editarCliente()">

	      		<div class="control-group">
	      		
	      		{!! Form::hidden('idClienteEdit', '', array('id' => 'idClienteEdit')) !!}

	      		{!! Form::label('telefone', 'Telefone: ', array('class' => 'control-label')) !!}
	      		<div class="input-append">
	      			{!! Form::text('telefone', '(62)', array('id'=>'telefoneEdit', 'class' => 'form-control', 'autofocus', 'style' => 'width: 250px', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57')) !!}
	      		</div>
	      		
	      		<br>

	      		{!! Form::label('nome', 'Nome: ') !!}
	      		{!! Form::text('nome', '', array('id'=>'nomeEdit', 'class' => 'form-control', 'style' => 'width: 1000px')) !!}
	      		
	      		<br>

	      		{!! Form::label('cep', 'CEP: ') !!}
	      		{!! Form::text('cep', '', array('id'=>'cepEdit', 'class' => 'form-control', 'style' => 'width: 300px', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57')) !!}
	      		
	      		<br>

	      		{!! Form::label('endereco', 'Endereço: ') !!}
	      		{!! Form::textarea('endereco', '', array('id'=>'enderecoEdit', 'class' => 'form-control', 'style' => 'width: 1000px')) !!}

	      		<br>

	      		{!! Form::submit('Editar', array('class' => 'btn btn-success', 'style' => 'margin-top: 10px; margin-bottom: 10px; float: right; margin-right: 30px; width: 100px', 'type'=>'button')) !!}
	      		<br>

	      		</div>

	      	</form>


      </div>
    </div>
  </div>
</div>