<div class="row" id = "dadosCliente">
	<h1>Dados do cliente</h1>
	
	<form action = "javascript:pesquisarCliente()">

		<div class="control-group">
		
			{!! Form::hidden('idCliente', '', array('id' => 'idCliente')) !!}

			{!! Form::label('telefone', 'Telefone: ', array('class' => 'control-label')) !!}
			<div class="input-append">
				{!! Form::text('telefone', '62', array('id'=>'telefone', 'class' => 'form-control', 'autofocus', 'style' => 'width: 250px', 'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57')) !!}
	
				<button type = "submit" class = "btn btn-primary" style = 'margin-top: 10px; margin-bottom: 10px'><span class = "glyphicon glyphicon-search"></span>&nbsp;&nbsp;Busca rápida</button>

				<button class = "btn" type = "button" onclick="abrirModalListarClientes()"><span class = "glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Listar Todos</button>
				<button class = "btn btn-success" type = "button" onclick="abrirModalCadastrarClientes()"><span class = "glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Novo Cliente</button>
			</div>

			<div id="dadosClientePesquisado">
				<br>

				{!! Form::label('nome', 'Nome: ') !!}
				{!! Form::text('nome', '', array('id'=>'nome', 'class' => 'form-control', 'style' => 'width: 500px', 'readonly' => 'readonly')) !!}
				<br>

				{!! Form::label('cep', 'CEP: ') !!}
				{!! Form::text('cep', '', array('id'=>'cep', 'class' => 'form-control', 'style' => 'width: 300px', 'readonly' => 'readonly')) !!}
				<br>

				{!! Form::label('endereco', 'Endereço: ') !!}
				{!! Form::textarea('endereco', '', array('id'=>'endereco', 'class' => 'form-control', 'style' => 'width: 500px; height: 100px', 'readonly' => 'readonly')) !!}

				<br>
			</div>

		</div>
	</form>
</div>


<br><br>
{{-- Quando já selecionamos um cliente --}}
<div id = "dadosClienteSelecionado" style = "display: none;">
	<h4>Cliente Selecionado</h4>
	<h5 id = "idClienteSelecionado" style = "display: none"></h5>
	<h5 id = "nomeClienteSelecionado" style = "display: inline-block"></h5> 
	&nbsp;&nbsp;&nbsp;
	<h5 id = "telClienteSelecionado" style = "display: inline-block"></h5> 
	<br>
	<button class = "btn btn-primary" style = "width: 100px; height: 30px; display: inline-block" onclick="escolherOutroCliente()"><span class = "glyphicon glyphicon-chevron-left">&nbsp;Alterar&nbsp;</button>
</div>

{{-- Botão de adicionar produtos --}}
<button style = "width: 400px; height: 80px; border: 1px solid black; margin-left: 50px; font-size: 20px" class = "btn btn-success" id = "btnAdicionarCliente" onclick="abrirConta()" ><span class = "glyphicon glyphicon-thumbs-up"></span>&nbsp;&nbsp;Escolher Cliente</button>