@extends('layouts.layouts')

@section('content')
    <h1>Create Actors</h1>
    <form method="POST" action="{{route('actorStore')}}">
        @csrf
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name">

        <label for="dateBirth">Fecha de Nacimiento</label>
        <input type="date" id="dateBirth" name="dateBirth">

        <input type="submit" value='Crear'>

    </form>
@endsection