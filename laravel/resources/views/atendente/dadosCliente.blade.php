<div class="row">
	<h1>Dados do cliente</h1>
	
	
	<form action = "javascript:pesquisarCliente()">

		<div class="control-group">
		
		{!! Form::hidden('idCliente', '', array('id' => 'idCliente')) !!}

		{!! Form::label('telefone', 'Telefone: ', array('class' => 'control-label')) !!}
		<div class="input-append">
			{!! Form::text('telefone', '62', array('id'=>'telefone', 'class' => 'form-control', 'autofocus', 'style' => 'width: 250px', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57')) !!}
			{!! Form::submit('Busca rápida', array('class' => 'btn btn-primary', 'style' => 'margin-top: 10px; margin-bottom: 10px', 'type'=>'button')) !!}

			<button class = "btn btn-success" type = "button" onclick="abrirModalCadastrarClientes()">Cadastrar</button>
			<button class = "btn" type = "button" onclick="abrirModalListarClientes()">Listar Todos</button>
		</div>
		<br>

		{!! Form::label('nome', 'Nome: ') !!}
		{!! Form::text('nome', '', array('id'=>'nome', 'class' => 'form-control', 'style' => 'width: 1000px', 'readonly' => 'readonly')) !!}
		<br>

		{!! Form::label('cep', 'CEP: ') !!}
		{!! Form::text('cep', '', array('id'=>'cep', 'class' => 'form-control', 'style' => 'width: 300px', 'readonly' => 'readonly')) !!}
		<br>

		{!! Form::label('endereco', 'Endereço: ') !!}
		{!! Form::textarea('endereco', '', array('id'=>'endereco', 'class' => 'form-control', 'style' => 'width: 1000px; height: 100px', 'readonly' => 'readonly')) !!}

		<br>

		</div>

	</form>

</div>