@extends('layouts.layouts')

@section('content')
    <a href="{{route('movieCreate')}}">Crear</a>
    <h1>movies</h1>
    <ul>
        @foreach ($movies as $movie)
        <li>{{$movie->title}}</li>
        <button type="button" class="btn btn-primary" onclick="editar({{$movie->id}})">Editar</button>
        <form action="{{route('movieDestroy', $movie->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Eliminar" class="btn btn-primary">
        </form>
        @endforeach
    </ul>
@endsection
    
@livewire('edit-movie', ['movie' => $movie])
        
    
@section('scripts')
    <script  src="{{ asset('/js/movieJS.js') }}">
    </script>
@endsection