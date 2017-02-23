@extends('comum')

<style type="text/css">
	.wrapper {
		position: relative;
		margin-top: 150px;
		margin-left: 650px;
		width: 30%;
	}
</style>

<form method="POST" action="/auth/login">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="wrapper">
    	<h2>Área Restrita: Realize o login para entrar nesta sessão</h2>
    	<br>
	    <div>
	        {!!Form::label('Email')!!}
	        <input class = "form-control" autofocus type="email" name="email" value="{{ old('email') }}">
	    </div>

	    <div>
	        Password
	        <input type="password" class = "form-control" name="password" id="password">
	    </div>

	    <div>
	        <input type="checkbox" name="remember"> Remember Me
	    </div>

	    <div>
	        <button type="submit" class = "btn btn-primary" style = "float: right">Login</button>
	    </div>
    </div>
</form>