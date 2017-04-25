<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Bem-vindo</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('js/jquery-ui-1.12.0.custom/jquery-ui.min.css')}}">
	<script src = "{{ asset('js/jquery/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui-1.12.0.custom/jquery-ui.min.js') }}"></script>
    <script src = "{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/album.css') }}" rel="stylesheet">
  </head>

  <body>


    <div class="collapse bg-inverse" id="navbarHeader">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 py-4">
            <h4 class="text-white">Sobre</h4>
            <p class="text-muted">Informações do desenvolvedor...</p>
          </div>
          <div class="col-sm-4 py-4">
            <h4 class="text-white">Contato</h4>
            <ul class="list-unstyled">
              <li><a href="https://www.facebook.com/Gabriel.Dvt" class="text-white">Facebook</a></li>
              <li><a href="gabriel.dvt@hotmail.com" class="text-white">Email</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar navbar-inverse bg-inverse">
      <div class="container d-flex justify-content-between">
        <a href="#" class="navbar-brand">Sobre</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>

    <section class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading">Bem-vindo</h1>
        <p class="lead text-muted">Escolha o módulo que deseja entrar...</p>
      </div>
    </section>

    <div class="album text-muted">
      <div class="container">

        <div class="row">
        {{-- ir para: Administrador --}}
          <div class="card" onclick="location.href='/administrador';">
            <img class = "img-circle" src="/imagens/icones/administrador.jpg" alt="Card image cap">
            <p class="card-text">Administrador</p>
          </div>
          {{-- Ir para: Garçom --}}
          <div class="card" onclick="location.href='/garcom';">
            <img class = "img-circle" src="/imagens/icones/garcom.jpg" alt="Card image cap">
            <p class="card-text">Garçom</p>
          </div>
          {{-- Ir para: atendente --}}
          <div class="card" onclick="location.href='/atendente';">
            <img class = "img-circle" src="/imagens/icones/atendente.jpg" alt="Card image cap">
            <p class="card-text">Atendente</p>
          </div>
          {{-- Ir para: cozinha --}}
          <div class="card" onclick="location.href='/cozinha';">
            <img class = "img-circle" src="/imagens/icones/cozinha.jpg" alt="Card image cap">
            <p class="card-text">Cozinha</p>
          </div>
          
        </div>

      </div>
    </div>

    <footer class="text-muted">
      <div class="container">
        <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
        <p>New to Bootstrap? <a href="../../">Visit the homepage</a> or read our <a href="../../getting-started/">getting started guide</a>.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{asset('js/vendor/holder.min.js')}}"></script>
    <script>
      $(function () {
        Holder.addTheme("thumb", { background: "#55595c", foreground: "#eceeef", text: "Thumbnail" });
      });
    </script>

    <script src="{{asset('js/ie10-viewport-bug-workaround.js')}}"></script>

  </body>
</html>
