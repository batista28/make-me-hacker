@extends('../layouts')

@section('content')

<head>
    <title>Make me hacker! - Información</title>
</head>
<!-- Acordeones para facilitar la muestra de informacion y no sobre saturar -->
<div class="faq-container">
    <details>
        <summary>
            <span class="faq-title">
                ¿Cual es el objetivo de esta apliacion?
            </span>
            <img src="{{asset("images/information/plus.svg")}}" class="expand-icon" alt="Plus">
        </summary>
        <div class="faq-content">
            Crear un sistema intuitivo y sencillo, a la par de llamativo para que tanto los
            jóvenes pocos habilidosos como las personas mayores o con pocos reflejos puedan disfrutar de una buena experiencia de juego.
        </div>
    </details>
    <details>
        <summary>
            <span class="faq-title">
                ¿Como funciona la aplicacion?
            </span>
            <img src="{{asset("images/information/plus.svg")}}" class="expand-icon" alt="Plus">
        </summary>
        <div class="faq-content">
            El funcionamiento principal de la aplicacion sera clicar en el ordenador que aparece en la pagina principal para poder conseguir dinero creando lineas de codigo, con el cual podras contratar a programadores para que ellos trabajan por ti (o a la vez que tu) para conseguir mas dinero y asi poder crear una mejor empresa y convertirte en el rey de las empresas tecnologicas
        </div>
    </details>
    <details>
        <summary>
            <span class="faq-title">¿Para que sirven los desafios?</span>
            <img src="{{asset("images/information/plus.svg")}}" class="expand-icon" alt="Plus">
        </summary>
        <div class="faq-content">Los desafios te proporcionaran más dinero que de normal lo haria un contrato, o por tu propia cuenta pero estos tienen una limitación de tiempo la cual te hara perder todo el dinero que has generado mientras intentas completar el desafio en caso de que no consigas cumplirlo, los desafios se riguen por la regla de riesgo-recompensa</div>
    </details>

    <details>
        <summary>
            <span class="faq-title"><a href="{{route("about.us")}}">Sobre nosotros!! </a></span>
        </summary>
    </details>

    <details>
        <summary>
            <span class="faq-title"><a href="{{route("cookies")}}">Politicas de privacidad!!!! </a> </span>
        </summary>
    </details>
</div>
<script src="script.js"></script>

@endsection