@extends('usuarios.layouts')

@section('content')

<head>
    <meta charset="UTF-8">
    <title>Make me hacker - Ranking!</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/information.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body>

    <div style="display: flex; flex-direction: column; margin-top: 200px; max-width: 800px; margin-left: auto; margin-right: auto; justify-content: center; align-items: center; background-color: rgba(255, 255, 255, 0.1); border-radius: 10px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5); padding: 20px;">
        <div style="font-size: 24px; font-weight: bold; color: white; text-align: center;">Ranking de Usuarios</div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th scope="col" style="border-bottom: 2px solid #4db8ff; padding: 10px; color: #ffffff; text-align: left;">Usuario</th>
                    <th scope="col" style="border-bottom: 2px solid #4db8ff; padding: 10px; color: #ffffff; text-align: left;">Score</th>
                    <th scope="col" style="border-bottom: 2px solid #4db8ff; padding: 10px; color: #ffffff; text-align: left;">Ranking</th>
                </tr>
            </thead>
            <tbody>

                <!-- Creamos un contador para poner a los 3 primeros de distintos colores (respectivos a sus medallas (Oro, Plata, Bronce)) -->
                <?php $counter = 0 ?>
                @foreach ($users as $user)
                <?php $counter++ ?>
                @if ($toppers==3)
                <tr>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: goldenrod">{{ $user->name }}</td>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: goldenrod">{{ $user->score }}</td>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: goldenrod">{{ $counter }}</td>
                </tr>
                <?php $toppers-- ?>
                @elseif($toppers==2)
                <tr>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: silver">{{ $user->name }}</td>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: silver">{{ $user->score }}</td>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: silver">{{ $counter }}</td>
                </tr>
                <?php $toppers-- ?>
                @elseif($toppers==1)
                <tr>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: #cd7f32">{{ $user->name }}</td>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: #cd7f32">{{ $user->score }}</td>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: #cd7f32">{{ $counter }}</td>
                </tr>
                <?php $toppers-- ?>
                @else
                <tr>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: #ffffff;">{{ $user->name }}</td>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: #ffffff;">{{ $user->score }}</td>
                    <td style="border-bottom: 1px solid #4db8ff; padding: 10px; color: #ffffff;">{{ $counter }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

</body>

@endsection