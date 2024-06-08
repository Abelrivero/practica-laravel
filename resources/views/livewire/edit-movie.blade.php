<div>
    <div wire:ignore>
        @component('componentes.modal')
        @slot('modalTitle' , 'Editar Pelicula')
        @slot('modalBody')
        <form action="">

            <label for="title">Titulo</label>
            <input type="text" id="title" name="title" wire:model="title">
            <br>
        
            <label for="year">Estreno</label>
            <input type="date" id="year" name="year" wire:model="year">
            <br>

            <label for="duration">Duracion</label>
            <input type="number" id="duration" name="duration" wire:model="duration">
            <br>

            <label for="synopsis">Sinopsis</label>
            <input type="text" id="synopsis" name="synopsis" wire:model="synopsis">
            <br>

        </form>
        <label for="selectActor">Actores:</label>
        <select class="selectActor" id="selectActor" style="width: 50%">
            <option value="5">1</option>
        </select>
        <br>
        
        <label for="casting">Casting:</label>
        <ul id="casting">
        </ul>
        
        @endslot
        @slot('cerrarBoton')
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        @endslot
        @slot('saveEdit')
        <button type="button" id="btn-edit" class="btn btn-primary" wire:click="updateMovie()">Editar Pelicula</button>
        @endslot 
        @endcomponent
    </div>
</div>
