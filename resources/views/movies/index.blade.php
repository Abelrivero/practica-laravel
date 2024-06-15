@extends('layouts.layouts')

@section('content')
    <div class="d-flex flex-column">
        <div class="d-flex justify-content-center">
            <h1 class="mt-4 mb-3">PELICULAS</h1>
        </div>
        <div class="d-flex justify-content-center">
            {{ $movies->links()}}
        </div>
    </div>
    <div class="conteiner m-4 d-flex">
        <div style="width:80%;margin-right:10%;">
            @livewire('search-movie')
        </div>
        <div class="d-flex justify-content-end mb-2">
            <a href="{{route('movieCreate')}}" class="btn btn-success me-3 end-0" role="button">Crear</a>
        </div>
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
            <tbody id="tBodyMovie">
                @foreach ($movies as $movie)
                <tr>
                    <td>{{$movie->id}}</td>
                    <td>{{$movie->title}}</td>
                    <td>
                        <div class="d-flex align-items-start">
                            <button type="button" class="d-inline m-2 btn btn-primary" onclick="editar({{$movie->id}})">Editar</button>
                            <form action="{{route('movieDestroy', $movie->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="d-inline m-2 btn btn-primary">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
    
@livewire('edit-movie', ['movie' => $movie])
        
    
@section('scripts')
    <script  src="{{ asset('/js/movieJS.js') }}">
    </script>
@endsection