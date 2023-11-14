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
        <div class="input-group mt-auto" id="input">
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
<section>
        <!-- Aquí se incluye el archivo miarchivo.blade.php -->
        @include('js')
</section>
</html>
