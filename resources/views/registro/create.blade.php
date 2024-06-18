@extends('registro.layouts')

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

        <!-- Formulario de registro con comprobaciones en el front -->
        <form class="my-form" action="{{ route('store') }}" method="POST">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger text-center">
                {{ implode('', $errors->all(':message')) }}
            </div>
            @endif
            <div class="text-field">
                <label for="name">Nombre de usuario:</label>
                <input aria-label="Name" type="text" id="name" name="name" placeholder="Nombre de usuario" value="{{ old('name') }}" class="@error('name') is-invalid @enderror" required>
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="text-field">
                <label for="email">Correo electrónico:</label>
                <input aria-label="Email" type="email" id="email" name="email" placeholder="correo@gmail.com" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required>
                <img src="{{ asset('images/login/email.svg') }}" alt="Avatar">
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="text-field">
                <label for="password">Contraseña:</label>
                <input id="password" type="password" aria-label="Password" name="password" placeholder="Contraseña" title="Al menos 6 caracteres, una letra y un número" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" class="@error('password') is-invalid @enderror" required>
                <img src="{{ asset('images/login/password.svg') }}" alt="Avatar">
                @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="text-field">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input id="password_confirmation" type="password" aria-label="Confirm Password" name="password_confirmation" placeholder="Confirmar Contraseña" required>
            </div>
            <button type="submit" class="my-form__button">Registrarse</button>
        </form>
    </div>
</body>

</html>

@endsection