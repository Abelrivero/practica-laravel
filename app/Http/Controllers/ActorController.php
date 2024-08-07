<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Actor_Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ActorRequest;

class ActorController extends Controller
{

    
    public function index(Request $request)
    {
        $actorPag = 10;
        $actors = Actor::paginate($actorPag);
        if ($request->ajax()) {
            $nameActor = $request->input('name');
            $actors = Actor::where('name','like','%'.$nameActor.'%')->get();
            return $actors;
        };
        
        return view('actors.index', ['actors' => $actors]);
    }

    public function show(Request $request)
    {
        $nameActor = $request->input('name');
        $actor = Actor::where('name','like','%'.$nameActor.'%')->get();
        return response([$actor]);       
    }
    
    public function create()
    {
        return view('actors.create');
    }

    public function store(ActorRequest $request)
    {
        $actor = new Actor;
        $actor->name = $request->name;
        $actor->dateBirth = $request->dateBirth;
        $actor->save();

        return redirect()->route('actorIndex');
    }

    public function edit(Actor $actorId)
    {
        $idsPeliculas = $actorId->movies->pluck('movie_id'); 
        $peliculasFaltantes = DB::table('movies')->whereNotIn('id', $idsPeliculas)->get();
        $peliculas = [];
        $peliculasid = $actorId->movies;
        foreach ($peliculasid as $key => $value) {
            $peliculas[] = $value->peliculasActor;
        }
        return response([$actorId, $peliculas, $peliculasFaltantes]);
        /* return response()->json([$actorId, $peliculas]); */
    }

    public function storeMoviesActor(Request $request)
    {
        $existMovieActor = Actor_Movie::where('movie_id', $request->movie_id)->where('actor_id', $request->actor_id)->first();
        /* dd($existMovieActor); */
        if(!$existMovieActor){
            $MoviesActor = new Actor_Movie();
            $MoviesActor->actor_id = $request->actor_id;
            $MoviesActor->movie_id = $request->movie_id;
            $MoviesActor->save();
            /* return response('Pelicula Agregado', 200); */
        }else{
            return response('El Actor ya pertenece a esta pelicula', 400);
        }
    }
    
    public function update(ActorRequest $request, Actor $actorId)
    {
        $actorId->update([
            'name' => $request->name,
            'dateBirth' => $request->dateBirth
        ]);
    }

    public function deleteMovie(Request $request)
    {
        $movieActor = Actor_Movie::find($request->id);
        $movieActor->delete();
    }

    public function destroy(Actor $actorId) 
    {
        $actorId->delete();
        return redirect()->route('actorIndex');
    }
}
