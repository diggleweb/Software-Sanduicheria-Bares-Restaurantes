@extends('comum')

@section('titulo')
{{ 'Listar Funcionários' }}
@endsection


@section('corpo')

	<div class="page-header">
		<h1>Bem-vindo, administrador!</h1>
	</div>
	
	{{-- <ol class="breadcrumb">
	 	 <li><a href="/">Home</a></li>
	  	<li class="active"><a href="/administrador">Administrador</a></li>
	  	<li class="active">Listar Usuários</li>
	  	<a style = "float: right" href = "/auth/logout">Logout</a>
	</ol>
 --}}
 	{!! Breadcrumbs::render('listarUsuarios') !!}

	<div class = "container">
		<h1>Lista de Usuários</h1>

		<br>

		<br>

		{{-- Avisos --}}
		<div class="alert alert-danger" role = "alert">
			<?php 
				$j = 0;
			 	$arrayUsuariosSemAcesso = [];		//armazena os nomes dos usuários que não possuem acesso
			 ?>


			 Atenção: Os seguintes usuários não possuem nenhum tipo de acesso:

			@foreach ($role_names as $roleName)
				<?php
					if ($roleName == "Nenhum") {
						array_push($arrayUsuariosSemAcesso, $usuarios[$j]->login);
					}
					$j++;
				?>
			@endforeach

			<ul>
				@foreach($arrayUsuariosSemAcesso as $login)
					<li>{{$login}}</li>
				@endforeach
			</ul>
			
			<br>
			Clique em "Editar Acesso" para lhe conceder um.
		</div>

		<br>

		<table class = "table">
			<thead>
				<tr>
					<th style = "text-align: center"></th>
					<th style = "text-align: center">id</th>
					<th style = "text-align: center">Login</th>
					<th style = "text-align: center">Tipo de acesso</th>
				</tr>
			</thead>

			<tbody>
				<?php
					$i = 0;
				?>

				@foreach($usuarios as $usuario)
					<tr>
						<td style = "text-align: center"><?=($role_names[$i] == "Nenhum") ? "*" : ""?></td> {{--verifica que algum dos usuários está sem nenhum tipo de acesso e avisa ao usuário --}}
						<td style = "text-align: center">{{$usuario->id}}</td>
						<td style = "text-align: center">{{$usuario->login}}</td>
						<td style = "text-align: center">{{$role_names[$i]}}</td>

						<td style = "text-align: center">
							{!! link_to_route('editarUsuario', 'Editar Acesso', array('id' => $usuario->id), array('class' => 'btn btn-primary')) !!}
							<button class = "btn btn-danger" id = "{{$usuario->id}}" name = "botaoExcluir" onclick = "excluirUsuario(this.id)">Excluir</button>
						</td>
					</tr>

					<?php
						$i++;
					?>
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
	        <h4 class="modal-title" id="myModalLabel">Excluir Usuário</h4>
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

		function excluirUsuario(id) {
			$("#myModal").modal('show');
			idUsuario = id;
		}	

		function confirmarSenha() {
			var senha = $("#password").val();
			if (senha == "123123") {
				$.get( "/excluirUsuario", {"id": idUsuario} , function( data ) {
				  location.reload(true);
				});	
			} else {
				$("#mensagem").text("Senha incorreta! Usuário não excluído!");
			}
		}
	</script>

@endsection