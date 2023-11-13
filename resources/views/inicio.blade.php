<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Chat Ucaldas IA</title>
        <!-- Agrega enlaces a los archivos CSS de Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="{{ asset('/chat.css')}}">
</head>
<body>

<header>
        <h1></h1>
        <nav>
            <ul>
            <li><h6>Chat Universidad de caldas</h6></li>            
            <li style="float:right"><a class="active" href="https://www.ucaldas.edu.co/portal/">About</a></li>
            </ul>
        </nav>
    </header>
<main>
<!-- Contenedor principal del chat -->

    

    <!-- Barra lateral izquierda (menú) -->
    <div class="d-none d-md-block text-white p-5" >
        <h5>Asistente Virtual</h5>
        <!-- Agrega aquí tus elementos de menú -->
        <div id="listChat">
        
        </div>
            <button class="btn btn-primary" type="button" onClick="idSeccion()">nuevo</button>
    </div>

    <!-- Zona de chat -->
    <div class="p-4" style="">
        <!-- Historial de mensajes -->
        <div id="result" class="result container bg-light p-3 rounded mb-3" style="height: 60vh;">
            <!-- Los mensajes se agregarán dinámicamente aquí -->
            
        </div>

        <p id="alert">

        </p>

        <!-- Barra de entrada de usuario -->
        <div class="input-group mt-auto">
            <input id="pregunta" type="text" class="form-control" placeholder="Escribe un mensaje..." id="user-message">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onClick="postChat()">Enviar</button>
            </div>
        </div>
    </div>

</main>


<br>    
    <footer id="footer">
        
        <p>&copy; 2023 Universidad de caldas chatAI</p>
    </footer>
<!-- Agrega enlaces a los archivos JavaScript de Bootstrap y jQuery -->

</body>
<script>
    var id_seccion="12";
    function idSeccion() {
        
        var prueba=id_seccion;
        prueba=prueba+1;
        id_seccion=prueba;
        
        console.log(id_seccion);
    }
    function postChat(){
        var pregunta = $("#pregunta").val();
        var headers = {
                'ApiKey': 'b5435493-0e0e-4d06-89a0-bb0e99ae2afb'
            };
        var datos = {
                    "SeccionId": id_seccion,
                    "Question": {
                        "Messages": [
                            {
                                "role": "user",
                                "content": pregunta
                            }
                        ]
                    },
                    "IncludeHistory": true
            };
        if (!pregunta) {
            $("#alert").html("Por favor ingresar su pregunta");
        }else{
            $.ajax({
                type: 'POST',
                url: 'https://ucaldaschatia-production.up.railway.app/api/v1/completion',
                data: JSON.stringify(datos), // Convertir a JSON
                contentType: 'application/json', // Tipo de contenido
                headers: headers,
                success: function(response) {
                    console.log('Solicitud exitosa:', response);
                    
                    // Se utiliza la función para mostrar la información
                    mostrarInformacion(response);
                },
                error: function(error) {
                    console.error('Error en la solicitud:', error);
                    // Puedes manejar el error aquí
                }
            });
        }
        
    }

    function getChat(seccionid){
        var apiKey = 'b5435493-0e0e-4d06-89a0-bb0e99ae2afb';
    var seccionId = seccionid;
    var fromDate = '2023-11-11T04:05:30.892Z';

    // Construye la URL con los parámetros de consulta
    var url = 'https://ucaldaschatia-production.up.railway.app/api/v1/completion';
    url += '?SeccionId=' + encodeURIComponent(seccionId);
    url += '&FromDate=' + encodeURIComponent(fromDate);

    $.ajax({
        type: 'GET',
        url: url,
        contentType: 'application/json',
        headers: {
            'ApiKey': apiKey
        },
        success: function (response) {
            console.log('Solicitud exitosa:', response);
            // Puedes manejar la respuesta del servidor aquí
            mostrarInformacionInicio(response)
        },
        error: function (error) {
            console.error('Error en la solicitud:', error);
            // Puedes manejar el error aquí
        }
    });
    }

    function mostrarInformacion(data) {

        var resultadoElement = document.getElementById('result');

        // Limpia el contenido previo del div
        resultadoElement.innerHTML = '';


        const questions = data.Result.Data.AnswerResult.Questions;
        const answers = data.Result.Data.AnswerResult.Answers;

        // Recorre las preguntas e imprime las preguntas y respuestas correspondientes
        for (let i = 0; i < questions.length; i++) {
            const question = questions[i];
            const answer = answers.find(a => a.TransactId === question.TransactId);

            if (answer) {

                $("#result").append('<div class="msg1">' +
                question.Messages[0].Content + '</div>');

                $("#result").append('<div class="msg2">' +
                answer.Messages[0].Content + '</div>');

                
            }
        }
}


function mostrarInformacionInicio(data) {

var resultadoElement = document.getElementById('result');

// Limpia el contenido previo del div
resultadoElement.innerHTML = '';


const questions = data.Result.Data.AnswerResult.Questions;
const answers = data.Result.Data.AnswerResult.Answers;

// Recorre las preguntas e imprime las preguntas y respuestas correspondientes
for (let i = 0; i < questions.length; i++) {
    const question = questions[i];
    const answer = answers.find(a => a.TransactId === question.TransactId);

    if (answer) {

        $("#result").append('<div class="msg1">' +
        question.Messages[0].Content + '</div>');

        $("#result").append('<div class="msg2">' +
        answer.Messages[0].Content + '</div>');

        
    }
}
}

function listarChats(){
    chats.forEach(function(chat) {
                            
    $("#listChat").append('<p class="list" onclick="getChat(' + chat.id+ ', this)" >Chat: ' + chat.message + '</p>');

    });
}
var chats = [
    { id: 12, message: "Hola, ¿cómo estás?" },
    { id: 121, message: "¡Bien, gracias! ¿Y tú?" },
    { id: 1211, message: "Muy bien, ¿en qué puedo ayudarte?" },
    { id: 12, message: "Hola, ¿cómo estás?" },
    { id: 121, message: "¡Bien, gracias! ¿Y tú?" },
    { id: 1211, message: "Muy bien, ¿en qué puedo ayudarte?" },
    { id: 12, message: "Hola, ¿cómo estás?" },
    { id: 121, message: "¡Bien, gracias! ¿Y tú?" },
    { id: 1211, message: "Muy bien, ¿en qué puedo ayudarte?" },
    { id: 12, message: "Hola, ¿cómo estás?" },
    { id: 121, message: "¡Bien, gracias! ¿Y tú?" },
    { id: 1211, message: "Muy bien, ¿en qué puedo ayudarte?" },
    { id: 12, message: "Hola, ¿cómo estás?" },
    { id: 121, message: "¡Bien, gracias! ¿Y tú?" },
    { id: 1211, message: "Muy bien, ¿en qué puedo ayudarte?" }
    // Agrega más objetos de chat según sea necesario
  ];
$(document).ready(function() {
    getChat(12);
    listarChats();
});
</script>

    

</html>
