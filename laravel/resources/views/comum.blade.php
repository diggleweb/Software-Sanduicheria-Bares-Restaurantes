<!DOCTYPE html>
<!-- Feito por: Gabriel Augusto De Vito - 20/01/2016 -->
<!-- Esta página será um modelo para a maioria das outras páginas -->

<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> @yield('titulo') </title>
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('js/jquery-ui-1.12.0.custom/jquery-ui.min.css')}}">
	
	<!-- jQuery -->
	<script src = "{{ asset('js/jquery/jquery-2.2.0.min.js') }}"></script>
	<script src="{{ asset('js/jquery-ui-1.12.0.custom/jquery-ui.min.js') }}"></script>
	<script src = "{{ asset('js/maskmoney/maskmoney.min.js') }}"></script>
	<script src = "{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

</head>

<body>
	
	<!-- navbar  --> 
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header">
	          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                <ul class="nav navbar-nav">
	                  <li class="active"><a id = "tabGarcom" href="/">Garçom <span class="sr-only">(current)</span></a></li>
	                  <li><a id = "tabAdministrador" href="/administrador">Administrador</a></li>
	                </ul>
	          </div><!-- /.navbar-collapse -->
	  </div>
	</nav>

	@yield('corpo')

</body>

</html>