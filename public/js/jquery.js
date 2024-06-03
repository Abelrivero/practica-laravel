$(function() {
    $('#selectMovies').select2({
        placeholder: "selecione una opcion",
        allowClear: false,
        tags: false,
        dropdownParent: $('#componenteModal')
    });
    $('#selectMovies').on("select2:select", function (e) {
        guardarMovie(e.params.data.element.id);
    });
});


let idActor;
/* let moviesActor = []; */
let movies = [];

function edit(id){
    let ruta = document.getElementById('url'+id).getAttribute('value');
    $.ajax({
        type: 'GET',
        url: ruta,
        data: 'data',
        success: function(response){
            $("#name").val(response[0].name);
            $("#dateBirth").val(response[0].dateBirth);
            $("#listaMovies").empty();  
            moviesActor = response[0].movies;
            idActor = response[0].id;
            $("#selectMovies").empty();
            $('#selectMovies').append('<option></option>')
            response[2].map(function(element){
                $('#selectMovies').append('<option id="'+element.id+'">'+element.title+'</option>')
            })
            $("#listaMovies").empty();
            moviesActor.map(function (element) {
                $("#listaMovies").append('<li>'+element.peliculas_actor.title+' '+'<a style="color:red;cursor:pointer" id="eliminar'+element.id+'">X</a>'+'</li>')
                $("#eliminar"+element.id).on('click', function(){
                    eliminarMovieActor(element.id);
                })
            });;
            
        }
    }).fail(function(res){
        alert('error ' + res.status);
    });
}

function guardar(){
    let ruta = document.getElementById('url'+ idActor).getAttribute('value');
    let nombre = $("#name").val();
    let dateBirth = $("#dateBirth").val();
    let csrf = $("#token").val();

    $.ajax({
        type: 'PUT',
        url: ruta,
        headers: {"X-CSRF-TOKEN": csrf,},
        data: {
            'name': nombre,
            'dateBirth': dateBirth
        },
        success: function(){
            alert('modificado');
            $(function() {
                location.reload();
            })
        },
        error: function (res) {
            $('#name').addClass('border border-danger');
            $('.errors').html('<p style="color:red;font-size:10px;">'+res.responseJSON.message+'</p>');
            console.log(res.responseJSON.message);   
        }
    });
    
}

function guardarMovie(movieID){
    let csrf = $('#tokenselect').val();
    let ruta ='/configuracion/actores/create/' + idActor + '/' + movieID
    $.ajax({
        type: 'POST',
        url: ruta,
        headers: {"X-CSRF-TOKEN": csrf},
        data: {
            'actor_id': idActor,
            'movie_id': movieID
        },
        success: function(){
            alert('Pelicula Agregada');              

        }
    }).fail(function (res) {
        alert('Error '+res.status)
    });
    edit(idActor)  
}

function eliminarMovieActor(id){
    let csrf = $("#token").val();
    $.ajax({
        type: 'DELETE',
        url: '/configuracion/actores/baja/movie/'+id,
        headers: {"X-CSRF-TOKEN": csrf},
        data: {'id': id},
        success: function(){
            alert('Pelicula Eliminada');
        }
    }).fail(function(res){
        alert('error '+res.status);
    });
    edit(idActor)
}

function reload(){
    $(function() {
        location.reload();
    });
}
