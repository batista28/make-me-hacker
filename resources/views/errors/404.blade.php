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
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <div class="background" style="z-index: -1;">
        <div style="display: flex; flex-direction: column;" class="centering">
            <div class="verification-message" style="background-color: transparent;">
                <h1 style="background-color: transparent;">404 Error - Pagina no encontrada </h1>
                @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
                @endif
                <p style="background-color: transparent;">Esta pagina no existe, revise la ruta o compruebe que tenga los permisos necesarios</p>
                <form style="background-color: transparent;" class="d-inline" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline"><strong style="background-color: transparent;"><a style="background-color: transparent;" href="/">Haz click aqui para volver a la pagina principal</a></strong></button>.
                </form>
            </div>
        </div>
    </div>
</body>

</html>

@endsection