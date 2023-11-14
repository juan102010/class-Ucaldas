import './bootstrap';


var chats = [];
var id_seccion="1272";
function idSeccion() {
    
    var prueba=id_seccion;
    var numeroAleatorio =Math.floor(Math.random() * 99) + 1;
    prueba=prueba+numeroAleatorio.toString();
    id_seccion=prueba;
    console.log(id_seccion);
    postChatQ();
    setTimeout(function() {
        cargarListaChats();
}, 10000);
}

function cargarListaChats() {
// Limpia el contenido actual de #listChat
$("#listChat").empty();

//Obetner la lista de chats y cargarla nuevamente
var chats = getSeccionID();
listarChats(chats);
}

function postChat(){
    var pregunta = $("#pregunta").val();
    $("#pregunta").val('');
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
        $("#alert")
        .css("color", "red")
        .html("Por favor ingresar su pregunta")
        .fadeIn()
        .delay(2000)
        .fadeOut();
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
function postChatQ(){
   
    var headers = {
            'ApiKey': 'b5435493-0e0e-4d06-89a0-bb0e99ae2afb'
        };
    var datos = {
                "SeccionId": id_seccion,
                "Question": {
                    "Messages": [
                        {
                            "role": "user",
                            "content": "hola"
                        }
                    ]
                },
                "IncludeHistory": true
        };
 
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
        id_seccion=seccionid.toString();
        console.log(id_seccion);
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

function listarChats(chats){



for (let i = 0; i < chats.length; i++) {
    var textoConversacion = "Conversación " + (i + 1);
    $("#listChat").append('<p class="list" onclick="getChat(' + chats[i]+ ', this)" >' + textoConversacion + '</p>');
}

}

function getSeccionID(){
    var apiKey = 'b5435493-0e0e-4d06-89a0-bb0e99ae2afb';


// Construye la URL con los parámetros de consulta
var url = 'https://ucaldaschatia-production.up.railway.app/api/v1/completion/getids';


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
        chats=response.Result.Data.CompletionIds
        console.log('Solicitud exitosa:', chats);
        listarChats(chats);
    },
    error: function (error) {
        console.error('Error en la solicitud:', error);
        // Puedes manejar el error aquí
    }
});
}
$(document).ready(function() {
getSeccionID();
getChat(id_seccion);

});