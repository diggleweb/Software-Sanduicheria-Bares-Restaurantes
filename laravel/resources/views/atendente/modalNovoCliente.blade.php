<!-- Modal (cadastro de novo cliente) -->

<!-- Modal -->
<div class="modal fade" id="modalNovoCliente" tabindex="-1" role="dialog" aria-labelledby="titulo">
  <div class="modal-dialog" role="document"  style = " width: 2000px; margin: auto; margin-top: 100px">
    <div class="modal-content" style = "height: 1000px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titulo">Cadastrar novo cliente</h4>
      </div>
      <div class="modal-body">
        
			<form action = "javascript:cadastrarNovoCliente()">

	      		<div class="control-group">
	      		
	      		{!! Form::label('telefone', 'Telefone: ', array('class' => 'control-label')) !!}
	      		<div class="input-append">
	      			{!! Form::text('telefone', '(62)', array('id'=>'novoTelefone', 'class' => 'form-control', 'autofocus', 'style' => 'width: 250px', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57')) !!}
	      		</div>
	      		
	      		<br>

	      		{!! Form::label('nome', 'Nome: ') !!}
	      		{!! Form::text('nome', '', array('id'=>'novoNome', 'class' => 'form-control', 'style' => 'width: 1000px')) !!}
	      		
	      		<br>

	      		<a href="atendente/googlemaps" target = "_blank"> Abrir Google Maps </a>
		      		
	      		<br>

	      		{!! Form::submit('Cadastrar', array('class' => 'btn btn-success', 'style' => 'margin-top: 10px; margin-bottom: 10px; float: right; margin-right: 30px, width: 100px', 'type'=>'button')) !!}
	      		<br>

	      		</div>

	      	</form>
      </div>
    </div>
  </div>
</div>

