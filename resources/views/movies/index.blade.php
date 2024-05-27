@extends('layouts.layouts')

@section('content')
    <a href="{{route('movieCreate')}}">Crear</a>
    <h1>movies</h1>
    <ul>
        @foreach ($movies as $movie)
            <li>{{$movie->title}}</li>
        @endforeach
    </ul>
@endsection

@section('scripts')
    <script src="{{ asset('/js/jquery.js') }}"></script>
@endsection