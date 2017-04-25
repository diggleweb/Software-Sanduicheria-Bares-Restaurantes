<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Signin Template for Bootstrap</title>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('js/jquery-ui-1.12.0.custom/jquery-ui.min.css')}}">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method = "POST" action = "/auth/login"> 
      	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <h2>Área restrita para usuários autenticados</h2>
        <br>
        {!! HTML::ul($errors->all(), array('class'=>'alert alert-danger errors')) !!}
        <br>
        <label for="inputLogin" class="sr-only">Login</label>
        <div class="input-group">
		    <span class = "input-group-addon glyphicon glyphicon-user"></span>
		    <input id = "inputLogin" class = "form-control" autofocus name="login" value="{{ old('login') }}" placeholder = "Login">
        </div>
      	
      	<br>

	    <label for="inputPassword" class="sr-only">Senha</label>
      	<div class="input-group">
	        <span class = "input-group-addon glyphicon glyphicon-lock"></span>
	        <input type="password" name = "password" id="inputPassword" class="form-control" placeholder="Senha" required>
      	</div>

        <div class="checkbox">
          <label>
            <input type="checkbox" name = "remember" value="remember-me"> Lembrar
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Autenticar</button>
      </form>

    </div> <!-- /container -->

  </body>
</html>

{{-- 

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
	</div> --}}