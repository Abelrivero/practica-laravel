@extends('layouts.layouts')

@section('content')
    <h1>Create Actors</h1>
    <form method="POST" action="{{route('actorStore')}}">
        @csrf
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name">
        @error('name')
            <p style="color:red">{{$message}}</p>
        @enderror

        <label for="dateBirth">Fecha de Nacimiento</label>
        <input type="date" id="dateBirth" name="dateBirth">
        @error('dateBirth')
            <p style="color:red">{{$message}}</p>
        @enderror

        <input type="submit" value='Crear'>

    </form>
@endsection