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
<div class="container mt-4" id="chat-container">
    <!-- Barra lateral izquierda (menú) -->
    <div class="d-none d-md-block" style="float: left; width: 20%; background-color: #343a40; color: #fff; height: 400px; padding: 20px;">
        <h5>Menú</h5>
        <!-- Agrega aquí tus elementos de menú -->
        <ul>
                        
        </ul>
    </div>

    <!-- Zona de chat -->
    <div style="float: right; width: 80%;">
        <!-- Historial de mensajes -->
        <div id="chat-messages">
        
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
                    // Puedes manejar la respuesta del servidor aquí
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
</script>


</html>
