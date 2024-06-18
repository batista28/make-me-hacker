@extends('login.layouts')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="background"></div>
    <div style="display: flex; flex-direction: column;" class="centering">
        <!-- Formulario de Login -->
        <form class="my-form" action="{{ route('authenticate') }}" method="POST">
            @CSRF
            <div class="login-welcome-row">
                <h1>Inicia sesion!!</h1>
            </div>
            <div class="text-field">
                <label for="email">Correo electronico:</label>
                <input aria-label="Email" type="email" id="email" name="email" placeholder="correo@gmail.com" required>
                <img src="{{ asset('images/login/email.svg') }}" alt="Avatar">
            </div>
            <div class="text-field">
                <label for="password">Contraseña:</label>
                <input id="password" type="password" aria-label="Password" name="password" placeholder="Contraseña" title="Al menos 6 caracteres, una letra y un numero" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" required>
                <img src="{{ asset('images/login/password.svg') }}" alt="Avatar">
            </div>
            <button type="submit" class="my-form__button">Iniciar Sesion</button>
        </form>

        <form style="margin-top: 2rem; display: flex; flex-direction: column;" class="my-form" action="{{ route('registro') }}">
            <div class="text-field">
                <label for="">¿No tienes cuenta? Registrate!!</label>
                <button class="my-form__button">Registrarse</button>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>

</html>



@endsection