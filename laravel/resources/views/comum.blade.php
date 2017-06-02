<!DOCTYPE html>
<!-- Feito por: Gabriel Augusto De Vito - 20/01/2016 -->
<!-- Esta página será um modelo para a maioria das outras páginas -->

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="mobile-web-app-capable" content="yes">
	
	<title> @yield('titulo') </title>
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('js/jquery-ui-1.12.0.custom/jquery-ui.min.css')}}">
	
</head>

<body>
	

	<!-- jQuery -->
	<script src = "{{ asset('js/jquery/jquery-2.2.0.min.js') }}"></script>


	@yield('corpo')
	
	<script src="{{ asset('js/geral.js') }}"></script>
	<script src="{{ asset('js/jquery-ui-1.12.0.custom/jquery-ui.min.js') }}"></script>
	<script src = "{{ asset('js/maskmoney/maskmoney.min.js') }}"></script>
	<script src = "{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src = "{{ asset('js/jquery.mask.min.js') }}"></script>
</body>


</html>