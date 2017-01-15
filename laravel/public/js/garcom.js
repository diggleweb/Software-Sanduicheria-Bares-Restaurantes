
//clicar automaticamente na primeira mesa ao inicializar a página
$(document).ready(
	function() {
		$("#1").click();
	}
);

//caso o usuario aperte ESC, cancelar todos os produtos selecionados
$(document).keyup(function(e) {
	if (e.keyCode == 27) {
		desselecionarItens();
	}
});

//caso o usuario aperte ENTER, adicionar todos os produtos selecionados
$(document).keyup(function(e) {
	if (e.keyCode == 13 || e.keyCode == 32)
		adicionarItens();

});

/* adicionado em 13/1/2017
Este JS está relacionado apenas ao modal de adicionar detalhes aos pedidos (é apenas a funcionalidade de + e -)
Creditos: http://bootsnipp.com/snippets/featured/buttons-minus-and-plus-in-input
*/
 $('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});

$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});

$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});

$(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) || 
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
/* fim do js e fim dos créditos */


//Adicionado em: 26/01/2016
var numeroMesa = null;	//variável que armazenará a mesa selecionada (para adicionar um pedido)
var itens = [];		//array que armazenará os ids dos itens 
var idConta = null;	//variável que armazenará o número da conta relacionado ao número da mesa
var nomeFuncionario = null;	

	//função auxiliar que irá apagar as bordas de todos os números (para o usuário selecionar apenas
	//uma mesa)
	function apagarBordasNumeros() {
		$(".numeros").css("border", "0px solid black");
	}

	//apaga as bordas dos itens e zera o array de itens
	function apagarBordasItens() {
		$(".divCadaItem").css("border", "0px none rgb(51, 51, 51)");
		$(".divCadaItem").css("box-shadow", "0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)");
		itens = [];
	}

	//apenas clica novamente na mesma mesa, para atualizar a tabela
	function atualizar() {
		$("#" + numeroMesa).trigger('click');
	}

	
//utilizada em .numeros.click
	function atualizarTabela(data) { //data = vetor que vem do banco de dados, com todos os produtos relacionados a esta conta
		var totalConta = 0;	//contador para verificar quanto é o total da conta
		var contadorQuantidade = 0;	//conta quantos produtos existem no total

		//remove as linhas da tabela 
		$("#tabela tr").remove();		//evita que os produtos de uma mesa sejam colocados na mesma tabela que outra


		data.forEach(function(entry) {		//percorre cada produto

			var idConta = entry['conta_id'];
			var nomeProduto = entry['nome'];
			var preco = entry['precoVenda'];
			var quantidade = entry['quantidade'];
			contadorQuantidade += quantidade;
			var totalProduto = preco * quantidade;
			$("#tabela").append(					//adiciona uma linha na tabela para cada produto
				"<tr><td width = '40%' style = 'text-align: center'>" + nomeProduto + "</td><td width = '15%' style = 'text-align: center'>R$ " + preco.toFixed(2) + "</td><td width = '15%' style = 'text-align: center'>" + quantidade + "</td><td width = '20%' style = 'text-align: center; font-weight: bold;'> R$ " + totalProduto.toFixed(2) +"</td><td width = '30%' style = 'text-align: center'><button class = 'btn btn-danger' data-idConta = '" + idConta +"' id = '"+ nomeProduto +"' onclick = 'cancelarProduto(this.id, this.getAttribute(\"data-idConta\"))'>Cancelar</button></td></tr>"
			);

			totalConta += totalProduto;
		});


		//adiciona a linha 'total'
		$("#tabela").append("<tr><td style = 'text-align: center; font-weight: bold; font-size: 20px'>Total</td><td></td><td style = 'text-align: center; font-weight: bold;'>" + contadorQuantidade +"</td><td style = 'text-align: center; font-weight: bold; font-size: 20px'> R$ " + totalConta.toFixed(2) + "</td></tr>");

	}

	function atualizarTabelaComDetalhes(data) { 
	//data = vetor que vem do banco de dados, com 	todos os produtos relacionados a esta conta

		//remove as linhas da tabela 
		$("#tabelaDetalhes tbody tr").remove();		//evita que os produtos de uma mesa sejam colocados na mesma tabela que outra

		//contador para cada linha adicionada (para aumentar a propriedade HEIGHT do modal)
		var contador = 0;

		data.forEach(function(entry) {		//percorre cada produto
			var idConta = entry['conta_id'];
			var nomeProduto = entry['nome'];
			var preco = entry['precoVenda'];
			var horario = entry['created_at'];

			$("#bodyTabelaDetalhes").append(					//adiciona uma linha na tabela para cada produto
				"<tr><td width = '15%' style = 'text-align: center'>" + horario.substr(11, horario.length) + "</td><td width = '45%' style = 'text-align: center'>" + nomeProduto + "</td><td width = '30%' style = 'text-align: center'> R$ " + preco.toFixed(2) + "</td></tr>"
			);
			contador++;
		});

		//aumenta o tamanho da altura do modal
		var tamanhoInicial = 150;
		$(".modal-body").height(tamanhoInicial + contador*40);

	}

	//cancela um produto de uma determinada conta
	function cancelarProduto(nomeProduto, idConta) {
		var senha = prompt("Digite a sua senha para poder cancelar o pedido:");

			if (senha == "123123") {
				var json = {
					'nomeProduto': nomeProduto,
					'idConta': idConta
				};

				$.get('cancelarProduto', json, function() {
					atualizar();
				});

			} else if (senha != null) {
				alert("Pedido NÃO cancelado! Senha inválida!");
			}
		
			
		
	}

	/* Assim que clicar em um número, alterar a sua borda para demonstrar que este número foi selecionado
	Assim que clicar em um número já selecionado, alterar novamente a sua borda .
	Também atribui à variável 'numeroMesa' o número dessa mesa */
	$(".numeros").click(
		function() {
			
			apagarBordasNumeros();
			$(this).css("border", "3px solid red");

			//busca o número
			var id = $(this).attr("id");
			//preenche a variável global 'número' com o id do número da mesa desejado
			numeroMesa = id;		

			var json = {
				'numeroMesa': numeroMesa
			};

			//buscar o id da conta relacionada a este número de mesa
			$.get('/buscarContaRelacionada', json, function(data) {

				//se a mesa não tiver contas relacionadas, 
				if (data == -1) {
					$("#dadosDaConta").hide();	//esconder a tabela 
					$("#botoesGarcons").show();	//opção de abrir uma nova conta
					idConta = null;

				} else {	//se a mesa tiver contas relacionadas
					idConta = data.trim();

					$("#dadosDaConta").show();	//mostra a tabela 
					$("#botoesGarcons").hide();		//esconder opção de abrir uma nova conta
					//armazena em um campo oculto o id da conta na mesa
					$("#idConta").val(data.trim());
					
					var json = {
						'idConta': data.trim()
					};

					//busca os produtos relacionados à conta
					$.get('/buscarProdutos', json, function(data) {
						atualizarTabela(data);
					});

					$.get('/buscarProdutosComDetalhes', json, function(data) {
						atualizarTabelaComDetalhes(data);
					});

					//busca o nome do funcionário responsável pela conta
					$.get('/buscaFuncionario', json, function(data) {
						nomeFuncionario = data[0]['nome'];
						//adiciona ao título o nome do funcionário
						$("#tituloConta").text("Conta Aberta (Funcionário: " + nomeFuncionario + ")");

					});
				
				}
				
			});

			

		}
	);


	//adicionado em: 03/03/2016
	//irá encerrar uma determinada conta. Busca o ID da conta na div oculta 'idConta'
	$("#btnEncerrar").click(function() {
			//verifica se realmente deseja encerrar a conta
		if (confirm("Deseja realmente encerrar esta conta?") == true) {
			var idConta = $('#idConta').val();		//busca o id da conta
			
			//cria um objeto json para passar para a rota
			var json = {
				'id': idConta
			};


			//faz uma requisição para a rota alterar o valor de 'encerrada' para true
			$.get('encerrarConta', json, function(data) {
				alert('Conta encerrada!');
				atualizar();

			});
		}
	
	});

	var contadorProdutosSelecionados = 0;
//adicionado em: 28/01/2016
	//assim que clicar em um ítem, altera a sua borda e coloca em um array o id do item 
	$('.divCadaItem').click(
		function() {

			//busca qual é o estado da borda do item que foi clicado
			var borda = $(this).css("border");

			//busca o ID do ítem clicado
			var id = $(this).attr('val');

			//caso eu esteja selecionando um novo item (pintar a borda e colocar o id do item no array)
			if (borda == "0px none rgb(51, 51, 51)") {		
				$(this).css("border", "3px solid blue");	//adiciona a borda no ítem
				$(this).css("box-shadow", "0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22)");	//adiciona sombra
				
				itens.push(id);		//adiciona o ítem no array
				
				//adiciona um botão embaixo do item para adicionar detalhes sobre ele
				//$(this).after("<button name = 'btnDetalhes' class = 'btn btn-primary'>Detalhes</button>");
				$(this).find("[name='btnDetalhes']").css('display', 'block');

				//adicionado em: 27/7
				//contador de produtos selecionados
				// contadorProdutosSelecionados = $("#contadorProdutosSelecionados").html().split(" ")[0];
				contadorProdutosSelecionados++; 	//adiciona um produto do contador
				$("#contadorProdutosSelecionados").css("display", "initial");

				if (contadorProdutosSelecionados == 0)	{     //caso nenhum produto esteja selecionado
					$("#contadorProdutosSelecionados").html("");	//desaparecer com o texto
					$("#desselecionaritens").css("display", ""); //desaparecer com o ícone de desselecionar 
				}

				else if (contadorProdutosSelecionados == 1) {	//caso apenas um produto esteja selecionado
					$("#contadorProdutosSelecionados").html(
						contadorProdutosSelecionados + " produto selecionado" //atualizar o texto no singular
					);
					$("#desselecionaritens").css("display", "initial");	
				}
				else {					
					$("#contadorProdutosSelecionados").html(
						contadorProdutosSelecionados + " produtos selecionados" //atualizar o texto no plural
					);
					$("#desselecionaritens").css("display", "initial");
				} 
			

			//caso o item esteja sendo deselecionado
			} else {
				$(this).css("border", "0px none rgb(51, 51, 51)");	//retira a borda
				$(this).css("box-shadow", "0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)");	//retira a sombra

				var index = itens.indexOf(id);		//encontra o índice deste item no array
				
				//remove o botão de detalhes
				$(this).next("[name='btnDetalhes']").remove();

				//remove o ítem do array
				if (index > -1)
					itens.splice(index, 1);		
				
				//adicionado em: 27/7
				//contador de produtos selecionados
				contadorProdutosSelecionados--;		//retira um produto do contador
				if (contadorProdutosSelecionados == 0) {	//caso nenhum produto esteja selecionado
					$("#contadorProdutosSelecionados").html("");	//desaparecer com o texto
					$("#desselecionaritens").css("display", "none"); //desaparecer com o ícone de desselecionar 
				}
				else if (contadorProdutosSelecionados == 1)	{//caso apenas um produto esteja selecionado
					$("#contadorProdutosSelecionados").html(contadorProdutosSelecionados + " produto selecionado");	//atualizar o texto no singular
					$("#desselecionaritens").css("display", "initial");
				}
				else {				
					$("#contadorProdutosSelecionados").html(contadorProdutosSelecionados + " produtos selecionados"); //atualizar o texto no plural
					$("#desselecionaritens").css("display", "initial");
				}
			}
			
		}
	);


	function adicionarItens() {
		//verifica se pelo menos uma mesa foi escolhida
		
			//verifica se pelo menos um ítem foi escolhido
			if (itens.length == 0) {
				alert("Escolha pelo menos um ítem antes de adicionar um pedido!");
			} else {

				//caso positivo...

				//criar um objeto json com o id da conta e os ids dos itens 
				var json = {
					"idConta": idConta,
					"itens": itens 
				};

				//tudo certo, podemos adicionar os pedidos no banco
				//realiza uma requisição ajax para que a rota trate de adicionar os pedidos
				$.get('addPedido/', json, function(data) {
					atualizar();		//força o clique no número da mesa para atualizar a tabela
					//remove as bordas dos itens selecionados (é uma forma de confirmação que o produto foi adicionado)
					desselecionarItens();
				});

			}
	}

	//botão adicionar (dado um array de id de ítens ('itens') e uma mesa, adicionará um pedido no banco de dados)
	$("#btnAdicionar").click(
		function() {
			adicionarItens();
		}
	);


	//ao clicar no nome de um garçom, para adicionar uma nova conta à mesa
	$('[name="adicionarConta"]').click(
		function() {
			var idFuncionario = $(this).attr("id");		//busca o id do funcionario

			var json = {
				"idFuncionario": idFuncionario,
				"numeroMesa": numeroMesa
			};
			
			//faz uma requisição para a rota criar uma nova conta relacionada a este funcionário
			$.get('/criarNovaConta', json, function(data) {
				$("#" + numeroMesa).click();
			});

		}
	);

	//abre o modal de detalhes de uma determinada conta
	function abrirDetalhes() {
		//$("#myModal").modal('show');
	}

	//abre o modal relacionado aos detalhes do pedido
	function abrirModalDetalhes(id, categoria, nome, preco) {
		$("#modalDetalhesPedido").modal('show');
	}

	//desseleciona todos os itens (para facilitar para o usuário que selecionou vários itens e deseja cancelar a operação)
	function desselecionarItens() {
		//retira a borda de todos os itens selecionados e apaga o array de itens
		apagarBordasItens();
		
		$("#contadorProdutosSelecionados").css('display', 'none');
		$("#desselecionaritens").css('display', 'none');
		contadorProdutosSelecionados = 0;
		$("#contadorProdutosSelecionados").html(contadorProdutosSelecionados + " produtos selecionados");
		//remove todos os botões de 'Detalhes' que foram criados
		$("[name='btnDetalhes']").remove();
	}


	$('#modalDetalhesPedido').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			//populate the textbox

		    $(e.currentTarget).find('input[name="id"]').text(id);
	})

	//adicionbado em 12/1/2017
	/* abre o modal de detalhes para pedidos relacionados a sanduiches */
	function abrirModalSanduiches(nome, preco, urlImagem) {
		var modal = $("#modalDetalhesPedidoSanduiches");
		//altera a url da imagem, nome e preço
		modal.find('.imagem').attr('src', urlImagem);
		modal.find('.nome').text(nome);
		modal.find('.preco').text("R$" + preco.toFixed(2));
		//abre o modal
		modal.modal('toggle');
	}