<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('titulo')
	</title>


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


			@yield('corpo')

			</div>
		</div>
	</div>