$(document).ready(
	function() {

		$('#formulario').each(function() {
		    $(this).find('input').keypress(function(e) {
		        // Enter pressed?
		        if(e.which == 10 || e.which == 13) {
		            this.form.submit();
		        }
		    });
		});

		//separacao da lista de produtos em categorias
		$( "#accordion" ).accordion({
		  collapsible: true,
		  heightStyle: "content"
		});

	}
);

	
	var idGlobal;	//foi criada porque 'excluirProduto' recebe um id, mas este id deve ser usado pela função 'confirmarSenha'.
					//logo, deve haver uma maneira de se transferir este 'id' de uma função para a outra. Como a função 'excluirProduto' não chama
					//diretamente a função 'confirmarSenha', uma forma de transferir este id foi criando esta variável global.

    function excluirProduto(id) {
    	idGlobal = id;
    	//para evitar que toda vez que clicar em 'excluir' o modal volte com a senha preenchida e a mensagem de 'senha incorreta', precisamos zerar estes valores antes de abrir o modal
    	$("#mensagem").text("");
    	$("#password").val("");
    	$("#myModal").modal('show');		//abre o modal. Dentro do modal, há um formulário que chama a função 'confirmarSenha', que irá confirmar a senha e eventualmente excluir o produto
    	$('.modal').on('shown.bs.modal', function() {
    	  $(this).find('[autofocus]').focus();
    	});
    }

    //função chamada pelo formulário do modal que é liberado assim que o usuário clica em 'excluir'
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