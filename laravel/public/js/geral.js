function confirmarSenha() {
	var val = $("#password").val();		//pega a senha que o usuário escreveu no input
	if (val == "123123") {		//caso a senha esteja correta, excluir o produto
		$.get( "/excluirProduto", {"id": idGlobal} , function( data ) {
		  location.reload(true);
		});
	} else {		//caso a senha nao esteja correta, mensagem para o usuario
		$("#mensagem").text("Senha incorreta! Produto não excluído!");
	}
}