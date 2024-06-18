@extends('login.layouts')

@section('content')

<div class="container">
    <h2>Iniciar Sesion</h2>

    <!-- Formulario de Login -->
    <form action="{{route("login.iniciar")}}" method="POST">
        @CSRF
        <div style="margin: 10px;" class="form-group">
            <label for="username">Correo:</label>
            <input type="text" class="form-control" id="username" placeholder="email" name="email" required minlength="5">
        </div>

        <div style="margin: 10px;" class="form-group">
            <label for="pwd">Contraseña:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Password" name="password" required minlength="8">
        </div>
        <button style="margin: 10px;" type="submit" class="btn btn-primary">Iniciar Sesion</button>
    </form>

    <form style="margin: 10px" action="{{ route('login.create') }}">
        <label for="">¿No tienes cuenta? Registrate!!</label>
        <br>
        <button class="btn btn-danger">Registrarse</button>
    </form>
</div>

@endsection