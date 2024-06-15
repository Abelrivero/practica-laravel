$(function(){
    $('#selectActor').select2({
        placeholder: "selecione una opcion",
        dropdownParent: $('#componenteModal')
    });
});
let idMovie;
function editar(id){
    Livewire.emit('edit', id);
    $('#componenteModal').modal('show');
    idMovie = id;
} 

document.addEventListener('livewire:load', function () {
    Livewire.on('cargarActores', function (actores, actoresFaltantes, actorMovie) {
        $('#casting').empty();
        if(actores.length === 0){
            $('#casting').append('<li>Sin Actores Registrados</li>')
        }else{
            actorMovie.forEach(function (movieActor) {
                $('#casting').append('<li>'+movieActor.cast.name+' '+'<a style="color:red;cursor:pointer" id="eliminar'+movieActor.id+'">X</a></li>');
                $('#eliminar'+movieActor.id).on('click', function() {
                    eliminarActorMovie(movieActor.id);
                });
            });
        }
        $('#selectActor').empty();
        $('#selectActor').append('<option></option>');
        if(actoresFaltantes.length === 0){
            $('#selectActor').append('<option>No Hay Mas Actores en la Base de Datos</option>');
        }else{
            actoresFaltantes.forEach(function (actor) {
                $('#selectActor').append('<option value="'+actor.id+'">'+actor.name+'</option>');
            });
        }
        
    });
    Livewire.on('relacionEliminada', function() {
        alert('Actor Eliminado')
        editar(idMovie);
    });
    Livewire.on('actorAgregado', function() {
        alert('Actor Agregado')
        editar(idMovie);
    });
    Livewire.on('guradarEditMovie', function() {
        alert('Modificado')
        $(function() {
            location.reload();
        })
    })
    Livewire.on('movieEncontrada', function(movies){
        if (movies && movies.length > 0) {
            console.log(movies);
            $('#tBodyMovie').empty();
            movies.forEach(element => {
                $('#tBodyMovie').append('<tr><td>'+element.id+'</td><td>'+element.title+'</td><td><button class="d-inline m-2 btn btn-primary" onclick="editar('+element.id+')">Editar</button><button class="d-inline m-2 btn btn-primary">Eliminar</button></td></tr>');
            });
        }
    })
});

$('#selectActor').on("select2:select", function (e) {
    let idActor = e.params.data.element.value;
    Livewire.emit('guardarActorMovie', idActor);
});

function eliminarActorMovie(idRelacion){
    Livewire.emit('eliminarActorMovie', idRelacion);
}

