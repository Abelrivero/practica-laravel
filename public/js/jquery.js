let ID
function edit(id){
    let ruta = document.getElementById('url'+id).getAttribute('value')
    $.ajax({
        type: 'GET',
        url: ruta,
        data: 'data',
        success: function(response){
            $("#name").val(response.name)
            $("#dateBirth").val(response.dateBirth)

            return ID = response.id     
        }
    }).fail(function(res){
        alert('error ' + res.status);
    });
}

function guardar(){
    let ruta = document.getElementById('url'+ ID).getAttribute('value');
    let nombre = $("#name").val();
    let dateBirth = $("#dateBirth").val();
    let csrf = $("#token").val();

    $.ajax({
        type: 'PUT',
        url: ruta,
        headers: {
            "X-CSRF-TOKEN": csrf,
        },
        data: {
            'name': nombre,
            'dateBirth': dateBirth
        },
        success: function(){
            alert('modificado')
        }
    }).fail(function(res){
        alert('error ' + res.status)
    });
     //Creamos el evento click del botón
    $(function() {
        location.reload();
    });
    
}