@extends('layouts.layouts')

@section('content')
    <a href="{{route('actorCreate')}}">Crear</a>
    <h1>acotres</h1>
    <ul>
        @foreach ($actors as $actor)
            <li>{{$actor->name}} 
            <input type="hidden" value="{{route('actorEdit', $actor->id) }}" id="url{{$actor->id}}">
            <button onclick="edit({{$actor->id}})" data-bs-toggle="modal" data-bs-target="#exampleModal">Editar</button>
            <button>Eliminar</button>
            </li>
        @endforeach
    </ul>
@endsection

@component('componentes.modal')
    @slot('modalTitle' , 'Editar Actor')
    @slot('inputName')
        <form action="" method="POST">
            @method('PUT')
            @csrf
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name">
            <br>
            <label for="dateBitrh">Fecha de Nacimiento</label>
            <input type="date" id="dateBirth" name="dateBirth">

            <input type="hidden" name="_token"  id="token" value="{{ csrf_token() }}" />
        </form>
    @endslot
    @slot('saveEdit')
        <button type="button" id="btn-edit" class="btn btn-primary" onclick="guardar()" data-bs-dismiss="modal">Editar Actor</button>
    @endslot
@endcomponent



@section('scripts')
    <script src="{{ asset('/js/jquery.js') }}">
    </script>
@endsection

