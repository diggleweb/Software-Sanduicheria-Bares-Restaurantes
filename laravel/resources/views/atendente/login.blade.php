@extends('comum')

@section('titulo')
Login
@endsection

@section('corpo')

@endsection
  


    <div class="container" style='width: 500px; margin-top: 200px'>

    	{!! Form::open(array('method' => 'POST', 'url' => 'atendente/postLogin', 'class' => 'form-signin')) !!}

    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        <h2>Área restrita para usuários autenticados</h2>
	        <br>
	        {!! HTML::ul($errors->all(), array('class'=>'alert alert-danger errors', 'width: 300px')) !!}
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

    	{!! Form::close() !!}

    </div> 
