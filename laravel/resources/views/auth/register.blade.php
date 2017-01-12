<form method="POST" action="/auth/register">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class = "form-control">
    </div>

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}" class = "form-control">
    </div>

    <div>
        Password
        <input type="password" name="password" class = "form-control">
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation" class = "form-control">
    </div>

    <div>
        <button type="submit" class = "btn btn-primary">Register</button>
    </div>
</form>