@extends('auth.comum')

@section('titulo')
Registrar novo usuário
@endsection

@section('corpo')
    <br>
    <h2>cadastre-se</h2>
    <br>

    <form method="POST" action="/auth/register">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
        <div>
            <label>Login</label>
            <input type="text" name="login" value="{{ old('login') }}" class = "form-control">
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

        <select>
            <option>Atendente</option>
            <option>Garçom</option>
            <option></option>
        </select>

        <div>
            <button type="submit" class = "btn btn-primary" class = "btn btn-primary btn-lg" style = "float: right">Registrar</button>
        </div>

    </form>
@endsection

