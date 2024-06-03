@extends('layouts.layouts')

@section('content')
    <a href="{{route('actorCreate')}}">Crear</a>
    <h1>acotres</h1>
    <ul>
        @foreach ($actors as $actor)
            <li>{{$actor->name}}
            <input type="hidden" value="{{route('actorEdit', $actor->id) }}" id="url{{$actor->id}}">
            <button onclick="edit({{$actor->id}})" data-bs-toggle="modal" data-bs-target="#componenteModal" class="btn btn-primary">Editar</button>
            <form action="{{route('actorDestroy', $actor->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Eliminar" class="btn btn-primary">
            </form>
            </li>
        @endforeach
    </ul>
    
@endsection

@component('componentes.modal')
    @slot('modalTitle' , 'Editar Actor')
    @slot('modalBody')
    <div>
        <ul class="errors" style="margin:0%; padding:0%;">

        </ul>
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

