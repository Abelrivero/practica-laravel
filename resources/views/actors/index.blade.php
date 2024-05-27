@extends('layouts.layouts')

@section('content')
    <a href="{{route('actorCreate')}}">Crear</a>
    <h1>acotres</h1>
    <ul>
        @foreach ($actors as $actor)
            <li>{{$actor->name}} 
            <button onclick="edit({{$actor->id}})">Editar</button>
            <button>Eliminar</button>
            </li>
        @endforeach
    </ul>
@endsection

@section('scripts')
    <script src="{{ asset('/js/jquery.js') }}">
    </script>
@endsection