@extends('../layouts')

@section('content')

<head>
  <meta charset="UTF-8">
  <title>Make me hacker - Desafios!!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/desafios.css') }}">
  <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Libreria importada para las alertas -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
  <div class="cards">
    <!-- Hacemos un foreach de desafios para mostrar cada desafio -->
    @foreach ($desafios as $desafio)
    <article class="card" data-desafio-id="{{ $desafio->id }}">
      <div class="card__preview">

        <!-- Dependiendo del nombre le asignamos una imagen -->
        @if ($desafio->nombre == "css")
        <img src="{{ asset('images/desafios/css.png') }}" alt="CSS Desafio">
        @elseif($desafio->nombre == "java")
        <img src="{{ asset('images/desafios/java.png') }}" alt="Java Desafio">
        @elseif($desafio->nombre == "js")
        <img src="{{ asset('images/desafios/js.png') }}" alt="JS Desafio">
        @elseif($desafio->nombre == "php")
        <img src="{{ asset('images/desafios/php.png') }}" alt="PHP Desafio">
        @else
        <img src="{{ asset('images/desafios/python.png') }}" alt="Python Desafio">
        @endif
        <div class="card__price">
          {{$desafio->dificultad}}
        </div>
      </div>
      <div class="card__content">
        <h2 class="card__title">Desafio normal ({{ strtoupper($desafio->nombre) }})</h2>
        <p class="card__address">
          {{$desafio->descripcion}}
        </p>
        <p class="card__description">
          Escoge este desafio y aumentaras tu dinero en {{$desafio->recompensa}}!
        </p>
      </div>
    </article>
    @endforeach
  </div>

  <script>
    // Script para que cuando clickemos al formulario se añada a la base de datos
    $(document).ready(function() {

      // Cuando clickamos en una carta
      $('.card').on('click', function() {

        // Obtenemos el id del desafio al que clickamos
        var desafioId = $(this).data('desafio-id');

        // Hacemos una funcion ajax para mandarnos a la ruta en cuestion con la informacion necesaria
        $.ajax({
          url: "{{ route('click.store') }}",
          method: 'POST',
          data: {
            _token: "{{ csrf_token() }}",
            desafio_id: desafioId,
            active: 1,
            complete: 0
          },

          // En caso de que funcione mostrarmos un mensaje de confirmacion
          success: function(response) {
            if (response.success) {
              Swal.fire({
                title: 'Desafio aceptado!',
                text: 'Has aceptado el desafio correctamente! vuelve a la pestaña de inicio y completalo!!.',
                icon: 'success',
                confirmButtonText: 'OK'
              });
            }
          },

          // En caso de que no funcione mostrarmos un mensaje de error
          error: function(xhr) {
            var errorMessage = 'Ha ocurrido un error: ' + xhr.status + ' ' + xhr.statusText;
            if (xhr.responseJSON && xhr.responseJSON.message) {
              errorMessage = xhr.responseJSON.message;
            }

            // En caso de que tengamos el desafio ya activado
            Swal.fire({
              title: 'Ya tienes el desafio!',
              text: errorMessage,
              icon: 'error',
              confirmButtonText: 'OK'
            });
          }
        });
      });
    });
  </script>
</body>

@endsection