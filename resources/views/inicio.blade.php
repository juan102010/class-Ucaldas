<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Chat Ucaldas IA</title>
    <!-- Agrega enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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

        #user-input {
            padding: 10px;
            background-color: #fff;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    
<h1>Datos Obtenidos post:</h1>
    @if(isset($datapost))
        <pre>{{ var_dump($datapost) }}</pre>
    @else
        <p>No hay datos</p>
    @endif

    <h1>Datos Obtenidos get:</h1>
    @if(isset($dataget))
        <pre>{{ var_dump($dataget) }}</pre>
    @else
        <p>No hay datos</p>
    @endif
<!-- Contenedor principal del chat -->
<div class="container mt-4" id="chat-container">
    <!-- Barra lateral izquierda (menú) -->
    <div class="d-none d-md-block" style="float: left; width: 20%; background-color: #343a40; color: #fff; height: 400px; padding: 20px;">
        <h5>Menú</h5>
        <!-- Agrega aquí tus elementos de menú -->
        <ul>
        <li class="nav-item"><a class="nav-link" href="/">Ubicacion UCaldas</a></li>
                
                    <li class="nav-item"><a class="nav-link" href="/">Carreras Ofrecidas</a></li>
                
                    <li class="nav-item"><a class="nav-link" href="/">Horarios de atencion</a></li>
                
                    <li class="nav-item"><a class="nav-link" href="/">Contacto</a></li>
                
                    <li class="nav-item"><a class="nav-link" href="/">Acerca de</a></li>
                
                    <li class="nav-item"><a class="nav-link" href="/">Como recibir mas informacion?</a></li>
                    
        </ul>
    </div>

    <!-- Zona de chat -->
    <div style="float: right; width: 80%;">
        <!-- Historial de mensajes -->
        <div id="chat-messages">
            <!-- Mensajes se agregarán aquí dinámicamente -->
        </div>

        <!-- Barra de entrada de usuario -->
        <div id="user-input">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Escribe un mensaje...">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Agrega enlaces a los archivos JavaScript de Bootstrap y jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
