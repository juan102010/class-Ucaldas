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

    <style>
        /* Estilos adicionales para la interfaz de chat */
        body {
            background-color: #f8f9fa;
        }

        #chat-container {
            max-width: 1250px;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        #chat-messages {
            height: 350px;
            overflow-y: scroll;
            padding: 10px;
            background-color: #fff;
        }
        #alert{
            color:red;
        }
        #user-input {
            padding: 10px;
            background-color: #fff;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    
<!-- Contenedor principal del chat -->
<div class="container mt-5">
    <!-- Barra lateral izquierda (menú) -->
    <div class="d-none d-md-block bg-dark text-white p-4" style="float: left; width: 20%; height: calc(100vh - 90px);">
        <h5>Asistente Virtual</h5>
        <!-- Agrega aquí tus elementos de menú -->
        <ul class="list-unstyled">
            <!-- Elementos de menú -->
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Materias</a></li>
            <li><a href="#">Calificaciones</a></li>
        </ul>
    </div>

    <!-- Zona de chat -->
    <div class="p-4" style="float: right; width: 80%; height: 570px; overflow-y: auto; border: 1px solid #ccc; border-radius: 8px;">
        <!-- Historial de mensajes -->
        <div id="result" class="bg-light p-3 rounded mb-3 container mt-4" style="max-height: 70%; overflow-y: auto;">
            <!-- Los mensajes se agregarán dinámicamente aquí -->
        </div>

        <!-- Barra de entrada de usuario -->

        <p id="alert">

        </p>
        <div id="user-input">
            <div class="input-group">
                <input id="pregunta" type="text" class="form-control" placeholder="Escribe un mensaje...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onClick="postChat()">Enviar</button>
                    <button class="btn btn-primary" type="button" onClick="idSeccion()">nuevo</button>
                </div>

            </div>
        </div>
    </div>
</div>

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
            $("#alert").html("mk no se olvideo el hp textoooo");
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

    function getChat(){
        var apiKey = 'b5435493-0e0e-4d06-89a0-bb0e99ae2afb';
    var seccionId = '81d5d581-5160-4569-a114-54dfa8aeaeee';
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
        },
        error: function (error) {
            console.error('Error en la solicitud:', error);
            // Puedes manejar el error aquí
        }
    });
    }

    function mostrarInformacion(data) {
    // Supongamos que tienes un elemento con el ID 'resultado' en tu HTML
    var resultadoElement = document.getElementById('result');

    // Limpia el contenido previo del div
    resultadoElement.innerHTML = '';

    // Verifica si la respuesta tiene la propiedad 'Result' y 'Data'
    if (data.Result && data.Result.Data && data.Result.Data.AnswerResult) {
        // Obtiene la lista de preguntas
        var preguntas = data.Result.Data.AnswerResult.Questions;

        // Itera sobre cada pregunta y muestra el contenido de los mensajes
        preguntas.forEach(function (pregunta) {
            var mensajes = pregunta.Messages;

            mensajes.forEach(function (mensaje) {
                // Crea un nuevo elemento de párrafo para mostrar cada mensaje
                var mensajeElement = document.createElement('p');
                mensajeElement.textContent = mensaje.Content;
            // Agrega el nuevo elemento al resultadoElement
            resultadoElement.appendChild(mensajeElement);
            });
        });
    } else {
        resultadoElement.innerHTML = 'La estructura de la respuesta no es la esperada.';
    }
}
</script>


</html>
