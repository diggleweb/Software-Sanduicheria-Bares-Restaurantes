@extends('comum')

@section('titulo')
{{ 'Listar Funcionários' }}
@endsection


@section('corpo')

	<div class="page-header">
		<h1>Bem-vindo, administrador!</h1>
	</div>
	
	<ol class="breadcrumb">
	 	<li><a href="/">Home</a></li>
	  	<li><a href="/administrador">Administrador</a></li>
	  	<li class="active">Listar Funcionários</li>
	  	<a style = "float: right" href = "/auth/logout">Logout</a>
	</ol>

	<div class = "container">
		<h1>Lista de Funcionários</h1>

		<br>

		<a href = "/administrador/listarFuncionarios/novoFuncionario" class = "btn btn-primary" style = "width: 200px;">Novo</a>

		<br><br>

		<table class = "table">
			<thead>
				<tr>
					<th>Nome</th>
					<th style = "text-align: center">Salário</th>
					<th style = "text-align: center">Cargo</th>
					<th style = "text-align: center">Núm. Produtos Vendidos</th>
					<th style = "text-align: center">Ação</th>
				</tr>
			</thead>

			<tbody>
				@foreach($garcons as $garcom)
				<tr>
					<td>{{$garcom->nome}}</td>
					<td style = "text-align: center">R$ {{$garcom->salario}}</td>
					<td style = "text-align: center">
						@if($garcom->cargo == 'garcom') 
								{{'Garçom'}}
							@else 
								{{'Gerente supervisor'}}
						@endif
					</td>
					<td style = "text-align: center">{{$garcom->produtosVendidos}}</td>
					<td style = "text-align: center">
						{!! link_to_route('editarFuncionario', 'Editar', array('id' => $garcom->id), array('class' => 'btn btn-primary')) !!}
						<button class = "btn btn-danger" id = "{{$garcom->id}}" name = "botaoExcluir" onclick = "excluirGarcom(this.id)">Excluir</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		
	</div>


	<!-- Modal para confirmacao de senha ao excluir um funcionário -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Excluir Funcionário</h4>
	      </div>

	      <div class="modal-body" style = "height: 155px">
	      
	      	<form action = "javascript:confirmarSenha()" id = "formulario">
	      		<label id = "mensagem" style = "color: red"></label>
	      		<label>Para excluir o funcionário desejado, por favor, digite a senha do administrador:</label>
		      	<input type = "password" id = "password" class = "form-control" autofocus>
		      	<br>
		      	<div style = "float: right">
		      		
		      		<input type = "submit" class = "btn btn-primary" value = "Confirmar">
		      	</div>
	      	</form>
	      </div>
	      
	    </div>
	  </div>


	<script>
	var idFuncionario;

		function excluirGarcom(id) {
			$("#myModal").modal('show');
			idFuncionario = id;
		}	

		function confirmarSenha() {
			var senha = $("#password").val();

			if (senha == "123123") {

			if (senha == "senhaBoleira") {
				$.get( "/excluirGarcom", {"id": idFuncionario} , function( data ) {
				  location.reload(true);
				});	
			} else {
				$("#mensagem").text("Senha incorreta! Funcionário não excluído!");
			}
		}
	</script>

@endsection