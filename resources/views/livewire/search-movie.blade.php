<div>
    <input type="text" class="form-control" id="searchActor" name="searchMovie" placeholder="Buscar Pelicula" wire:model="searchTerm" wire:keydown='search' wire:model.debounce.500ms="searchTerm">
</div>
