<!-- div que irá aparecer assim que o garçom clicar em uma mesa que não tenha uma conta associada -->
<div id = "botoesGarcons">
	<h2 style = "color: red">Nenhuma conta aberta para esta mesa.</h2>
	<h3 style = "color: blue"> Selecione um garçom responsável para abrir uma nova conta para esta mesa. </h3>
	<br>
		@foreach($funcionarios as $funcionario)
			<button  id = "{{$funcionario->id}}" name = "adicionarConta" style = "width: 200px; height: 40px; margin-top: 20px; margin-right: 20px" class = "btn btn-primary">{{ $funcionario->nome }}</button>
		@endforeach
</div>