$(document).ready(
	function() {
		//condições iniciais
		$('[name="nome"]').focus();
		$('[name="precoCompra"]').maskMoney({prefix: "R$ "});
		$('[name="precoVenda"]').maskMoney({prefix: "R$ "});
		$("#divPrecos").css('display', 'none');

		//assim que submeter o formulario, devemos retirar a mascara de dinheiro do campo salario (para evitar que seja enviado R$ 1023123.1231,00 por exemplo)
		$('#formulario').submit(
			function() {
				$('[name="precoCompra"]').val($('[name="precoCompra"]').maskMoney('unmasked')[0]);
				$('[name="precoVenda"]').val($('[name="precoVenda"]').maskMoney('unmasked')[0]);
			}
		);
	}
);

	var itens = [];
	var nomesItens = [];
	var totalPrecoVenda = 0.0;	/* a quanto vai ser vendido o sanduíche? Valor baseado em quantos itens estão sendo adicionados e o preço de cada item */
	var totalPrecoCompra = 0.0;	/* quanto este sanduíche vai custar para o dono do estabelecimento? */


	//assim que o usuário escolher uma categoria, verificar qual é esta categoria
	//e tomar medidas necessárias	
	function verificar(item) {
		//verifica se a categoria é sanduíche
		//caso não seja, apagar o botão 'adicionar ítens ao sanduíche'
		if (item.value != 1) {	//não é sanduíche
			$("#itensSelecionados").hide();		//sumir com o parágrafo que mostra os ítens selecionados
			$("#tituloItensSelecionados").hide();
			$("#btnAdicionarItens").hide();		//sumir com o botão para mostrar os ítens selecionados

			//caso não seja sanduíche, devemos pedir um preço de venda e de compra para o usuário
			$("#divPrecos").css('display', 'initial');
			$("#paragrafoExplicativo").css('display', 'none');

		} else {	//é sanduíche

			$("#itensSelecionados").show();
			$("#tituloItensSelecionados").show();
			$("#btnAdicionarItens").show();

			//se for sanduiche, o preço de compra e o preço de venda são determinados pelos valores de cada item individual, portanto podemos eliminar esses campos
			$("#divPrecos").css('display', 'none');
			$("#paragrafoExplicativo").css('display', 'initial');
		}
	}


	$('.divCadaItem').click(
		function() {
			//o item foi ou não clicado? 0 = não foi clicado; 1 = foi clicado
			var clicked = $(this).attr("data-clicked");
			
			//busca qual é o estado da borda do item que foi clicado
			var borda = $(this).css("border");

			//busca o ID do ítem clicado
			var id = $(this).attr('val');

			var nome = $(this).attr('data-nome');

			var precoVenda = parseFloat($(this).attr('data-precoVenda'));

			var precoCusto = parseFloat($(this).attr('data-precoCompra'));

			//caso eu esteja selecionando um novo item (pintar a borda e colocar o id do item no array)
			if (clicked == 0) {		
				$(this).css("border", "3px solid blue");	//adiciona a borda no ítem
				$(this).css("box-shadow", "0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22)");	//adiciona sombra
				//altera para o estado 'clicado' com valor true
				$(this).attr("data-clicked", 1);
				
				totalPrecoVenda += precoVenda;
				totalPrecoCompra += precoCusto;

				itens.push(id);		//adiciona o ítem no array
				nomesItens.push(nome);

			//caso o item esteja sendo deselecionado
			} else if (clicked == 1) {
				$(this).css("border", "0px none rgb(51, 51, 51)");	//retira a borda
				$(this).css("box-shadow", "0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)");	//retira a sombra

				var index = itens.indexOf(id);		//encontra o índice deste item no array
				
				//altera para o estado 'clicado' com valor false
				$(this).attr("data-clicked", 0);
				
				//remove o botão de detalhes
				$(this).next("[name='btnDetalhes']").remove();

				totalPrecoVenda -= precoVenda;
				totalPrecoCompra -= precoCusto;

				//remove o ítem do array
				if (index > -1) {
					itens.splice(index, 1);	
					nomesItens.splice(index, 1);
				}

			}

			$("#textoTotalVenda").text("Preço de venda do sanduíche: R$ " + totalPrecoVenda.toFixed(2));
			$("#textoTotalCompra").text("Custo do sanduíche: R$ " + totalPrecoCompra.toFixed(2));

		}
	);

	//função que irá retirar todas as bordas, zerar os arrays de itens e nomes de itens, e forçar data-clicked = 0
	function desselecionarItens() {
		$(".divCadaItem").css("border", "0px none rgb(51, 51, 51)");
		$(".divCadaItem").css("box-shadow", "0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)");
		
		$(".divCadaItem").each(
			function() {
				$(this).attr('data-clicked', 0);
			}
		);

		//zera os arrays
		itens = [];
		nomesItens = [];

		totalPrecoVenda = 0;
		totalPrecoCompra = 0;

		$("#textoTotalVenda").text("Preço de venda do sanduíche: R$ 0.00");
		$("#textoTotalCompra").text("Custo do sanduíche: R$ 0.00");
	}

	//ao clicar no botão 'concluir' do modal de itens
	function salvarItens() {
		var length = nomesItens.length;
		var text = "";
		//concatenando 
		for (i = 0; i < length; i++) {
			text = text.concat(nomesItens[i]) + ", ";
		}
		//remove a vírgula e o espaço final
		text = text.substring(0, text.length-2);

		//alterando o texto
		$("#itensSelecionados").text(text);
		$("#itensSelecionados").show();
		$("#tituloItensSelecionados").show();
		//temos que forçar o close do modal
		$("#closebutton").trigger("click");
		$('[name=itens]').val(itens.toString());

		//busca o preço de custo e o preço de venda
		var precoCompra = $("#textoTotalCompra").text().replace(/^\D+/g, '');		//retira a parte não numérica
		var precoVenda = $("#textoTotalVenda").text().replace(/^\D+/g, '');


		//volta a aparecer os campos 
		$("#divPrecos").css('display', 'initial');

		//força um foco em cada um dos campos para que o cifrão apareça
		$("[name='precoCompra']").trigger("click");
		$("[name='precoVenda']").trigger("click");

		//coloca esses valores em seus respectivos campos
		$("[name='precoCompra']").val(precoCompra);
		$("[name='precoVenda']").val(precoVenda);


	}

	