@extends('../layouts')

@section('content')

<head>
    <meta charset="UTF-8">
    <title>Make me hacker - Sobre nosotros!!</title>

    <!-- Libreria importada para las alertas -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif

        <!-- Pequeña descripcion sobre nosotros -->
        <div style="display: flex; flex-direction: column; margin-top: 200px; max-width: 800px; margin-left: auto; margin-right: auto; justify-content: center; align-items: center; background-color: rgba(255, 255, 255, 0.1); border-radius: 10px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5); padding: 20px;">
            <div style="font-size: 24px; font-weight: bold; color: white;">Sobre nosotros</div>
            <div style="width: 100%; color: white;">
                <p>Bienvenido a Make me hacker!!. Somos una compañia de creacion de paginas webs basadas en el ocio y los videojuegos, Cualquier duda puedes contactarnos mediante este formulario!</p>
            </div>

            <!-- Incluimos el formulario de contacto -->
            <div style="width: 100%;">
                @include('information.contact-form')
            </div>
        </div>
    </div>
</div>
@endsection