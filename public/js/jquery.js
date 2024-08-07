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

    /* let rutaindex = $(location).attr('href');
    $.ajax({
        type: 'GET',
        url: rutaindex,
        data: 'data',
        success: function(response){
            let links = response[0].links;
            links.map(function(item){
                if(item.url == null){
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="'+rutaindex+'">'+item.label+'</a></li>');
                }else{
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="'+item.url+'">'+item.label+'</a></li>');
                }
            })
        },
        error: function (res){
            console.log('Error '+res.status);
        }
    }); */
});


let idActor;
let movies = [];
let listMoviesActor = [];

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
            listMovies(idActor);
        }
    }).fail(function(res){
        alert('error ' + res.status);
    });
}

function listMovies(id){
    let ruta = document.getElementById('url'+id).getAttribute('value');
    $.ajax({
        type: 'GET',
        url: ruta,
        data: 'data',
        success: function(response){  
            moviesActor = response[0].movies;
            $("#listaMovies").empty();
            moviesActor.map(function (element) {
                $("#listaMovies").append('<li>'+element.peliculas_actor.title+' '+'<a style="color:red;cursor:pointer" id="eliminar'+element.id+'">X</a>'+'</li>')
                $("#eliminar"+element.id).on('click', function(){
                    eliminarMovieActor(element.id);
                })
            });
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
        console.log(res);
        alert(res.responseText)
    });
    listMovies(idActor);
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
    listMovies(idActor);
}

function reload(){
    $(function() {
        location.reload();
    });
}

$("#searchActor").on('keyup',debounce(function(){
        let buscado = $(this).val();
        let ruta = '/configuracion/actores/buscar/show';
        if(buscado.length >= 3){
            $.ajax({
                type: 'GET',
                url:   '/configuracion/actores/listar',
                data: {name: buscado},
                success: function(response){
                    $('#tBodyActor').empty();
                    $('.pagination').empty();
                    response.map(function(element){
                        $('#tBodyActor').append('<tr><td>'+element.id+'</td><td>'+element.name+'</td><td><input type="hidden" value="http://127.0.0.1:8000/configuracion/actores/modificar/'+element.id+'" id="url'+element.id+
                            '"><button class="d-inline m-2 btn btn-primary" data-bs-target="#componenteModal" data-bs-toggle="modal" onclick="edit('+element.id+')">Editar</button><button class="d-inline m-2 btn btn-primary">Elimnar</button></td></tr>');
                    })
                    console.log(response);
                },
                error: function(res){
                    console.log('Error '+res.status);
                }
            })
        }
    }, 500)
)

function debounce(func, wait) {
    let timeout;
    return function(...args) {
        const context = this;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), wait);
    };
}

// TODO: al eliminar o agregar un pelicula dentro de editar actor no debe modificar los input




