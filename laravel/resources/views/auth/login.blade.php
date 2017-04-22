<!DOCTYPE html>
<html>
<head>
	<title></title>


	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('js/jquery-ui-1.12.0.custom/jquery-ui.min.css')}}">

</head>
<body>

</body>
</html>

	<div class="container">
		<div class="row">
			<div class = "col-md-6">


				<form method="POST" action="/auth/login">
				    <input type="hidden" name="_token" value="{{ csrf_token() }}">

				    <div>
				    	<h2>Área Restrita: Realize o login para entrar nesta sessão</h2>
				    	<br>
						{!! HTML::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
						<br>
					    <div>
					        {!!Form::label('login')!!}
					        <input class = "form-control" autofocus autofocus name="login" value="{{ old('login') }}">
					    </div>

					    <br>

					    <div>
					        Senha
					        <input type="password" class = "form-control" name="password" id="password">
					    </div>

					    <div class = "checkbox">
					        <label><input type="checkbox" name="remember"> Lembrar </label>
					    </div>

					    <div>
					        <button type="submit" class = "btn btn-primary btn-lg" style = "float: right">Login</button>
					    </div>
				    </div>
				</form>
			</div>
		</div>
	</div>