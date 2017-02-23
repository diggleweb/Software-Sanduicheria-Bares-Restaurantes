@extends('comum')

@section('titulo')
{{ 'Listar Contas Encerradas' }}
@endsection


@section('corpo')

	<div class="page-header">
		<h1>Bem-vindo, administrador!</h1>
	</div>
	
	<ol class="breadcrumb">
	 	 <li><a href="/">Garçom</a></li>
	  	<li class="active"><a href="/administrador">Administrador</a></li>
	  	<li class="active">Contas Encerradas</li>
	  	<a style = "float: right" href = "/auth/logout">Logout</a>
	</ol>


		<div class = "container">
			<h1>Todas as contas encerradas</h1>
				<br>


	{{-- Por que utilizar esta variável? --}}
	{{-- Primeiro: ContasController retorna um array (chamado $produtos), em que cada posição deste array
	contém os nomes dos produtos, preços, etc, referentes a cada posição de outro array que vem do mesmo controller (chamado $contas).
	Para explicar melhor:
	em $produtos[0], temos um array de produtos referente à conta $contas[0]. 
	em $produtos[1], temos um array de produtos referente à conta $contas[1].
	E assim por diante 

	A variável $posicaoArray inicia-se com -1, pois na primeira iteração queremos o valor 0, e a cada iteração 
	queremos aumentar o seu valor, para percorrer o array $produtos e o array $contas com a mesma variável
	--}}
				<?php $posicaoArray = -1; ?>
					<div id = "accordion">

				       {{-- Precisamos percorrer o array de contas para preencher as tabelas. O array $contas possui o id da conta e o nome do funcionário responsável por esta conta --}}
						@foreach($contas as $conta)
							<?php $posicaoArray++; ?>	

							<h4>	<!-- titulo de cada conta encerrada (titulo tambem relacionhado a cada accordion) -->
								ID da Conta: <span style = "color: blue; margin-right: 180px">{{$conta->id}}</span> - 
								Funcionário Responsável: <span style = "color: blue ; margin-right: 130px">{{$conta->nome}}</span> 
								<span style = "color: blue; margin-right: 130px; float: right; margin-right: 25px">Encerrada em: {{$conta->updated_at}} </span>

							</h4>

							<div>	<!-- conteúdo de cada conta encerrada (conteúdo também de cada accordion) -->
								<table class = "table">
									<thead>
										<tr>
											<th width = "15%">Horário de registro</th>
											<th style = "text-align: center" width = "35%">Nome do produto</th>
											<th style = "text-align: center" width = "25%">Preço Venda</th>
										</tr>
									</thead>

									<tbody>
									{{-- aqui queremos os dados do produto relacionado a esta conta. Estes dados estão no array $produtos, portanto precisamos acessar estes dados utilizando a variável $posicaoArray --}}
										<?php $produtosDaConta = $produtos[$posicaoArray]; ?>
										{{-- Lembrando que $produtos[$posicaoArray] ainda é um VETOR! Este vetor contém os nomes dos produtos desejados, por isso temos que percorrer novamente, conforme o foreach abaixo --}}
											<?php $numeroItens = 0; 
												  $totalVenda = 0;
										    ?>
											@foreach($produtosDaConta as $produto)
											<tr>
												<td style = "text-align: center">{{$produto->created_at}}</td>
												<td style = "text-align: center">{{$produto->nome}}</td>
												<td style = "text-align: center">R$ {{number_format($produto->precoVenda, 2, '.', '')}}</td>
												<?php $totalVenda += $produto->precoVenda; ?>
											</tr>
											<?php $numeroItens++; ?>
											@endforeach
									</tbody>
								</table>
								<?php $totalVenda = number_format($totalVenda, 2, '.', ''); ?>		<!-- apenas força duas casas após a vírgula -->

								<div style = "float: left">Total: {{$numeroItens}} Itens</div> <div style = "float: right">Total: R$ {{$totalVenda}}</div>
								<br>
								<hr>

								<button onclick = "excluirConta({{$conta->id}})" style = "float: right; height: 30px; width: 60px; background-color: red; color: white">Excluir</button>
								<br>

							</div>
						@endforeach
					
					</div><!-- fim do accordion-->
				</div>

@endsection
