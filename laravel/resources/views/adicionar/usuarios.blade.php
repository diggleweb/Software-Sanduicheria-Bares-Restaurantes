@extends('comum')

@section('titulo')
Registrar novo usuário
@endsection

@section('corpo')
    <br>
    <h2>Novo usuário</h2>
    <br>

    {!! Breadcrumbs::render('novoUsuario') !!} 

   
    
        @if($errors->any())
            <div class="container">
                <div class="alert alert-danger">
                    <ul class="alert-box warning radius">
                        <li>{{$errors->first()}}</li>
                    </ul>
                </div>
            </div>
        @endif    


    <div class="container" style = "width: 600px">

    <br><br>

        {!! Form::open(array('route' => 'novoUsuarioPost', 'method' => 'POST')) !!}
        
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
            <div>
                <label>Login</label>
                <input type="text" name="login" autofocus value="{{ old('login') }}" class = "form-control">
            </div>
            <br>
            
            <div>
                Senha
                <input type="password" name="password" class = "form-control">
            </div>
            
            <br>
            
            <div>
                Confirmar senha
                <input type="password" name="password_confirmation" class = "form-control">
            </div>
            
            <br>

            <div>
                <button type="submit" class = "btn btn-primary" class = "btn btn-primary btn-lg" style = "float: right">Registrar</button>
                <a href = "/administrador/listarUsuarios" style = "margin-right: 20px; float: right; width: 100px" class = "btn btn-default">Cancelar</a>
            </div>

        {!! Form::close() !!}

    </div>
@endsection

