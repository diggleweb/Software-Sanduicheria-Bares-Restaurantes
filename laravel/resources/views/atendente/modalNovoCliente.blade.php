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

	      		<div>
		      		{!! Form::label('cep', 'CEP: ') !!}
		      		
	      			{!! Form::text('CEP', '', array('id'=>'novoCEP', 'class' => 'form-control', 'style' => 'width: 350px; margin-right: 0', 'maxlength' => '8', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57')) !!}
		      		<button class = "btn btn-primary" style = "margin: 0" onclick="pesquisarCEP()">Pesquisar</button>
      			</div>


	      		<br>

	      		{!! Form::label('bairro', 'Bairro: ') !!}
	      		
      			{!! Form::text('bairro', '', array('id'=>'bairro', 'class' => 'form-control', 'style' => 'width: 350px; margin: 0')) !!}


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

<script type="text/javascript">
	function pesquisarCEP() {
		var cep = $("#novoCEP").val();
		
		if (cep) {
			$.get('https://viacep.com.br/ws/' + cep + '/json/', {}, function(data) {
				console.log(data);
			});	
		} else {
			alert('Digite um CEP para buscar o endereço.');
		}
		
	}

</script>

