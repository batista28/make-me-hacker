@extends('../layouts')

@section('content')

<head>
    <title>Make me hacker! - Inicio</title>
    <style>
        @keyframes shake {
            0% {
                transform: translate(0, 0);
            }

            25% {
                transform: translate(-5px, -5px);
            }

            50% {
                transform: translate(5px, 5px);
            }

            75% {
                transform: translate(-5px, -5px);
            }

            100% {
                transform: translate(0, 0);
            }
        }

        .shake {
            animation: shake 0.5s;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 150px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
            padding: 20px;
        }

        .score-display {
            display: flex;
            flex-direction: row;
            gap: 10px;
            justify-content: center;
            font-size: 2rem;
            color: goldenrod;
            font-weight: bold;
        }

        .save-button {
            background-color: rgb(49, 39, 138);
            border: none;
            border-radius: 5px;
            min-height: 50px;
            min-width: 500px;
            font-size: 3rem;
            color: white;
            text-align: center;
            margin-top: 20px;
        }

        .hidden-input {
            display: none;
        }

        .main-container {
            display: flex;
            flex-direction: row;
            max-height: 100%;
        }

        @media (max-width: 1450px) {
            .main-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        @if ($userDevelopers)
        <div class="container" style="display:flex; justify-content: flex-start; gap:10px; color: white; min-width:340px">
            <p>Desarolladores activados: </p>
            @foreach ($userDevelopers as $userDeveloper)
            <div style="background:rgba(0, 0, 0, 0.3); border-radius:10px; padding:10px; min-width:300px; max-width:300px">
                <p>Desarollador: <strong>{{$userDeveloper->developer->nombre}}</strong></p>
                <p>Proporciona una mejora de {{$userDeveloper->developer->mejora}}</p>
            </div>
            @endforeach
        </div>
        @endif

        <div class="container" style="min-height:730px">
            <div class="score-display">
                Dinero: <div id="display-score"></div>
            </div>
            <div style="color:red; font-size:32px" id="countdown-timer"></div>
            <img id="pc" src="{{ asset('images/menu/Logo.svg') }}" alt="Logo" onclick="getScore()">

            <form action="{{ route('save-score') }}" method="post" id="save-score-form">
                @csrf
                <div class="hidden-input">
                    <input type="text" class="form-control @error('score') is-invalid @enderror" id="input-score" name="score" value="">
                </div>
                <input type="submit" class="save-button" value="Guardar progreso">
            </form>
        </div>

        @if ($userDesafios)
        <div class="container" style="display:flex; justify-content: flex-start; gap:10px; color: white; min-width:340px">
            <p>Desafios activados: </p>
            @foreach ($userDesafios as $userDesafio)
            <div style="background:rgba(0, 0, 0, 0.3); border-radius:10px; padding:10px; min-width:300px; max-width:300px">
                <p>Desafio de {{$userDesafio->desafio->nombre}}</p>
                <p>Tienes que conseguir {{$userDesafio->desafio->dificultad}}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <script>
        //Inicializacion de las variables
        var score = parseInt("{{ $user->score }}");
        var actualScore = score;
        var userDesafios = @json($userDesafios);
        var userDevelopers = @json($userDevelopers);
        var completedDesafios = {};
        var timer;

        //Calculamos el total de las mejoras
        var totalMejora = userDevelopers.reduce((sum, userDeveloper) => {
            return sum + parseInt(userDeveloper.developer.mejora);
        }, 0);

        //Cogemos el score en html para cambiarlo al correspondiente segun la base de datos
        document.getElementById("display-score").innerHTML = score + "$";
        document.getElementById("input-score").value = score;

        //Hacemos una funcion para cada vez que clickemos sumar el score
        const getScore = () => {

            //Le añadimos el 1 del click mas las mejoras de los programadores
            score += 1 + totalMejora;
            document.getElementById("display-score").innerHTML = score + "$";
            document.getElementById("input-score").value = score;

            //Le añadimos la clase para ponerle una animacion con time out
            let displayScoreDiv = document.getElementById("pc");
            displayScoreDiv.classList.add("shake");

            //Hacemos que la animacion acabe
            setTimeout(() => {
                displayScoreDiv.classList.remove("shake");
            }, 500);

            //Llamamos a la funcion para comprobar si se ha cumplido los desafios
            checkDesafios();
        };

        //Funcion para comprobar los desafios
        const checkDesafios = () => {

            //Hacemos un for each a los desafios, para sacar cada desafio independiente y poder comprobarlo
            userDesafios.forEach(desafio => {

                //Comprobamos que el score sea adecuado al desafio
                if (!completedDesafios[desafio.desafio.id] && score > actualScore + parseInt(desafio.desafio.dificultad)) {

                    //Aumentamos el score con la recompensa
                    score += parseInt(desafio.desafio.recompensa);
                    document.getElementById("display-score").innerHTML = score + "$";
                    document.getElementById("input-score").value = score;

                    //Si lo completamos, lo ponemos en true
                    completedDesafios[desafio.desafio.id] = true;

                    //Paramos el contador y guardamos los datos
                    stopTimerAndSaveScore();
                }
            });
        };

        //Funcion para penalizar el fallar un desafio
        const penalizeUncompletedDesafios = () => {

            //Hacemos un for each a los desafios, para sacar cada desafio independiente y poder comprobarlo
            userDesafios.forEach(desafio => {

                //Si no esta completado 
                if (!completedDesafios[desafio.desafio.id]) {

                    //Bajamos el score, pero nunca haciendo que este por debajo de 0
                    score -= desafio.desafio.dificultad * 2;
                    if (score < 0) {
                        score = 0;
                    }
                    document.getElementById("display-score").innerHTML = score + "$";
                    document.getElementById("input-score").value = score;
                }
            });

            //Paramos el contador y guardamos los datos
            stopTimerAndSaveScore();
        };

        //Paramos el contador y guardamos los datos
        const stopTimerAndSaveScore = () => {

            //Limpiamos el contador
            clearInterval(timer);

            //Activamos el formulario para guardar los datos
            document.getElementById("save-score-form").submit();
        };

        //Iniciamos el contador
        const startCountdown = () => {

            //Lo iniciamos con un tiempo de 3 minutos, lo cual es util
            var timeLeft = 180;
            const timerDisplay = document.getElementById("countdown-timer");

            //Hacemos el contador
            timer = setInterval(() => {

                //Vamos restando 1 al tiempo cada segundo que pasa
                timeLeft--;

                //Formateamos el valor para que lo de en minutos y segundos
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerDisplay.innerHTML = `Tiempo restante: ${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

                //Comprobamos si ha llegado a 0
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    timerDisplay.innerHTML = "Se acabo el tiempo!";

                    //Penalizamos al jugador, ya que si hubiera cumplido el desafio, el timer se hubiera parado antes
                    penalizeUncompletedDesafios();
                }
            }, 1000);
        };

        //Comprobamos que tenga desafios para poner el timer
        if (userDesafios.length > 0) {
            startCountdown();
        }
    </script>
</body>
@endsection