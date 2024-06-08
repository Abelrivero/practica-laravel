<?php

namespace App\Http\Livewire;

use App\Models\Actor;
use App\Models\Actor_Movie;
use App\Models\Movie;
use Livewire\Component;


class EditMovie extends Component
{
    public $actores = [];
    public $actoresFaltantes = [];
    public $idsActores = [];
    public $actorMovie = [];
    public $idSelect;
    public $title;
    public $year;
    public $duration;
    public $synopsis;

    protected $listeners = ['edit', 'guardarActorMovie', 'eliminarActorMovie'];

    public function edit($id)
    {   
        $movie = Movie::find($id);
        $this->actorMovie = $movie->actores;
        $this->actores = [];
        $this->idsActores = [];
        $this->actoresFaltantes = [];
        foreach ($this->actorMovie as  $actor) {
            $this->actores[] =  $actor->cast;
            $this->idsActores[] = $actor->cast->id;
        } 
        $this->actoresFaltantes = Actor::whereNotIn('id', $this->idsActores)->get();
        $this->title = $movie->title;
        $this->year = $movie->year;
        $this->duration = $movie->duration;
        $this->synopsis = $movie->synopsis;
        $this->idSelect = $id;
        
        $this->emit('cargarActores', $this->actores, $this->actoresFaltantes, $this->actorMovie);
        /* dd($this->actoresFaltantes); */
    }

    public function updateMovie(){
        $movie = Movie::find($this->idSelect);
      /*   $this->validate([
            'title' => 'required|min:3|max:250',
            'year' => 'reduired|date',
            'duration' => 'required|numeric',
            'synopsis' => 'required|min:5'
        ]); */
        $movie->update([
            'title' => $this->title,
            'year' => $this->year,
            'duration' => $this->duration,
            'synopsis' => $this->synopsis
        ]);
        $this->emit('guradarEditMovie');
    }

    public function guardarActorMovie($idActor)
    {
        $actorMovie = New Actor_Movie;
        $actorMovie->actor_id = $idActor;
        $actorMovie->movie_id = $this->idSelect;
        $actorMovie->save();
        $this->emit('actorAgregado');
    }

    public Function eliminarActorMovie($idRelacion)
    {
        $actorMovie = Actor_Movie::where('id', $idRelacion);
        $actorMovie->delete();
        $this->emit('relacionEliminada');
    }

    public function render()
    {
        return view('livewire.edit-movie', ['actores'=> $this->actores]);
    }
}
