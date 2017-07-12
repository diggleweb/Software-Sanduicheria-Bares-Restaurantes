<div class = "row">
<!-- Ítens -->		

	<div class="col-md-7 col-sm-7" id = "div1">
		@include('componentes.itens')
	</div>

	{{-- Número de mesas --}}
	<div class="col-md-5 col-sm-5" id = "div2">
		<div class="row">
			<h1>Mesas</h1>
			<!-- Adiciona todas as imagens dos números das mesas -->
			@for($i = 1 ; $i <= 8 ; $i++) 
				<div class = "numeros" id = "{{$i}}">
					<img src="imagens/numeros/{{$i}}.jpg" alt="{{$i}}" height = "60" width = "60">
				</div>
			@endfor
		</div>


	<!-- TABELA  -->
		@include('garcom.tabela')
	
		@include('garcom.escolhaGarcom')
		
	</div>
</div>

@include('componentes.modalDetalhesContas')

@include('componentes.modalDetalhesPedidos')
