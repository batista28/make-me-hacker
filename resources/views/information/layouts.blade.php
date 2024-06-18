<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/information.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <div class="background">
        <div class="menu__wrapper">
            <div class="menu__bar">
                <a href="/" title="Logo">
                    <img style="max-width: 60px; max-height: 60px; margin-left: 20px;" src="{{asset('images/menu/Logo.svg')}}" alt="">
                </a>
                <img class="menu-icon" src="{{ asset('images/menu/burger-menu.svg') }}" title='Burger Menu' alt='Burger Menu' onclick="toggleMenu(this)">
                <ul class="navigation">

                    <li>
                        <a href="/" title="Inicio">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="/perfil" title="Perfil">
                            Perfil
                        </a>
                    </li>
                    <li>
                        <a href="/desafios" title="Desafios">
                            Desafios
                        </a>
                    </li>
                    <li>
                        <a href="/programadores" title="Programadores">
                            Programadores
                        </a>
                    </li>
                    <li>
                        <a href="/clasificacion" title="Clasificación">
                            Clasificación
                        </a>
                    </li>
                    <li>
                        <a href="/information" title="Información">
                            Información
                        </a>
                    </li>

                    <li>
                        @auth
                        <form action="/logout" method="POST">
                            @CSRF

                            <button class="btn btn-danger" type="submit">
                                Cerrar Sesion
                            </button>
                        </form>
                        @endauth
                    </li>
                </ul>
            </div>

        </div>
        @yield('content')
    </div>

    <script src="{{ asset('js/menu.js') }}"></script>
</body>

</html>