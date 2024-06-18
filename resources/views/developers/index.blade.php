@extends('../layouts')

@section('content')

<head>
    <meta charset="UTF-8">
    <title>Developers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/desafios.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="cards">
        @foreach ($developers as $developer)
        <article class="card" data-developer-id="{{ $developer->id }}">
            <div class="card__preview">
                <img src="{{ asset('/images/developers/' . strtolower($developer->especialidad) . '.jpg') }}" alt="{{ $developer->especialidad }} Developer">
                <div class="card__price">
                    ${{ $developer->precio }}
                </div>
            </div>
            <div class="card__content">
                <h2 class="card__title">{{ $developer->nombre }}</h2>
                <p class="card__address">
                    Te da una mejora de {{ $developer->mejora }} por click!
                </p>
                <p class="card__description">
                    Programador especializado en el lenguaje de: {{ $developer->especialidad }}
                </p>
            </div>
        </article>
        @endforeach
    </div>

    <script>
        $(document).ready(function() {
            $('.card').on('click', function() {
                var developerId = $(this).data('developer-id');
                $.ajax({
                    url: "{{ route('user-developers.store') }}",
                    method: 'POST',
                    data: {
                        developer_id: developerId,
                        active: 1,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Has contratado al desarrollador!',
                                text: 'Desarrollador contratado correctamente, ya puedes disfrutar de sus mejoras!!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                            $('#display-score').text(response.new_score + '$');
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = 'Failed to add developer.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            title: 'No puedes contratarlo T.T',
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