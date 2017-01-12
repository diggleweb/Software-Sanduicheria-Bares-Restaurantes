<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('principal') }}">
       Home
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <li><a href="{{ route('cidades.index') }}"> <span class="glyphicon glyphicon-stats"></span>&nbsp; Cidades</a></li>
           <li><a href="{{ route('bairros.index') }}"> <span class="glyphicon glyphicon-road"></span>&nbsp; Bairros</a></li>
           <li><a href="{{ route('estados.index') }}"> <span class="glyphicon glyphicon-globe"></span>&nbsp; Estados</a></li>
          <li><a href="{{ route('clientes.index') }}"><span class="glyphicon glyphicon-user"></span>&nbsp;Clientes</a></li>
        </li>
      </ul>


      @if (Auth::user())
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }}
                <span class="caret"></span>
              </a>
            <ul class="dropdown-menu" role="menu">
               <li><a href="#">Perfil</a></li>
               <li><a href="/auth/logout">Logout</a></li>
            </ul>
          </li>
      </ul>

      @else
        <ul class="nav navbar-nav navbar-right">
           <li><a href="/auth/login">Logar</a></li>
           <li><a href="/auth/register">Registrar</a></li>
        </ul>

      @endif

      


    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>