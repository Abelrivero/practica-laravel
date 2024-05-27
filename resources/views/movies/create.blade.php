@extends('layouts.layouts')

@section('content')
    <h1>Create Movies</h1>
    <form method="POST" action="{{ route('movieStore')}}">
        @csrf
        <label for="title">Titulo</label>
        <input type="text" id="title" name="title">

        <label for="year">Estero</label>
        <input type="date" id="year" name="year">

        <label for="duration">duracion</label>
        <input type="text" id="duration" name="duration">

        <label for="synopsis">Sinopsis</label>
        <input type="text" id="synopsis" name="synopsis">

        <input type="submit" value='Crear'>

    </form>
@endsection