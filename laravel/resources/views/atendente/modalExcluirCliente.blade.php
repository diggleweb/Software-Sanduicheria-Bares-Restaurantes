<div class="modal fade" id="modalExcluirCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="tituloModal">Excluir</h4>
      </div>

      <div class="modal-body" style = "height: 155px">
      
      	<form action = "javascript:confirmarSenha()" id = "formulario">
      		<label id = "mensagem" style = "color: red"></label>
      		<label id="frase">Para excluir o cliente desejado, por favor, digite a senha do administrador:</label>
	      	<input type = "password" id = "password" class = "form-control" autofocus>
	      	<br>
	      	<div style = "float: right">
	      		
	      		<input type = "submit" class = "btn btn-primary" value = "Confirmar">
	      	</div>
      	</form>
      </div>
      
    </div>
  </div>
</div>