@extends('layouts.layouts')

@section('content')
    <div class="d-flex flex-column">
        <div class="d-flex justify-content-center">
            <h1 class="mt-4 mb-3">ACTORES</h1>
        </div>
        <div class="d-flex justify-content-center">
            {{ $actors->links()}}
        </div>
    </div>
    <div class="d-flex justify-content-end mb-2">
        <input type="text" class="form-control me-5 ms-3" id="searchActor" name="searchActor" placeholder="Buscar Actor">
        <a href="{{route('actorCreate')}}" class="btn btn-success me-3" role="button">Crear</a>
    </div>

    
    <div class="conteiner m-4">
        <table class="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td colspan="2">Acciones</td>
                </tr>
            </thead>
            <tbody id="tBodyActor">
                @foreach ($actors as $actor)
                <tr>
                    <td>{{$actor->id}}</td>
                    <td>{{$actor->name}}</td>
                    <td class="d-flex align-items-start">
                        <input type="hidden" value="{{route('actorEdit', $actor->id) }}" id="url{{$actor->id}}">
                        <button onclick="edit({{$actor->id}})" data-bs-toggle="modal" data-bs-target="#componenteModal" class="d-inline m-2 btn btn-primary">Editar</button> 
                        <form action="{{route('actorDestroy', $actor->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar" class="d-inline m-2 btn btn-primary">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $actors->links()}}
@endsection

@component('componentes.modal')
    @slot('modalTitle' , 'Editar Actor')
    @slot('modalBody')
    <div class="errors" style="margin:0%; padding:0%;">
    </div>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
        <form method="POST">
            @method('PUT')
            @csrf
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name">
            
            <br>
            <label for="dateBirth">Fecha de Nacimiento</label>
            <input type="date" id="dateBirth" name="dateBirth">
            
            <br>
            <label for="selectMovies">Peliculas</label>
            <select name="state" id="selectMovies" style="width: 50%">
                @csrf
                <input type="hidden" name="_token"  id="tokenselect" value="{{ csrf_token() }}">
            </select>
            <br>
            <label for="listaMovies">Participo en:</label>
            <div id="moviesAcotr">
                <ul id="listaMovies">  
                </ul> 

            </div>

            <input type="hidden" name="_token"  id="token" value="{{ csrf_token() }}" />
        </form>
    @endslot
    @slot('cerrarBoton')
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="reload()">Cerrar</button>
    @endslot
    @slot('saveEdit')
        <button type="button" id="btn-edit" class="btn btn-primary" onclick="guardar()" {{-- data-bs-dismiss="modal" --}}>Editar Actor</button>
    @endslot
@endcomponent



@section('scripts')
    <script src="{{ asset('/js/jquery.js') }}">
    </script>
@endsection

