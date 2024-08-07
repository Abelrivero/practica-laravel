<?php

namespace App\Http\Controllers;

use App\Models\Actor_Movie;
use App\Models\Movie;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MovieController extends Controller
{
    public function index()
    {
        $moviesPag = 10;
        $movies = Movie::paginate($moviesPag);
        return view('movies.index', ['movies' => $movies]);
    }

    public function allMovies()
    {
        $movies = Movie::all();
        return response($movies);
    }
    
    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $movie = new Movie;
        $movie->title = $request->title;
        $movie->year = $request->year;
        $movie->duration = $request->duration;
        $movie->synopsis = $request->synopsis;
        $movie->save();

        return redirect()->route('movieIndex');

    }


    public function edit(){

    }
    
    public function update(){

    }

    public function destroy(Request $request,Movie $movieId){
        $movieId->delete();
        return redirect()->route('movieIndex');
    }

    public function createPDF()
    {
        $movies = Movie::all();
        foreach ($movies as $movie) {
            $casting = [];
            $actoresMovies = $movie->actores;
            foreach ($actoresMovies as $actor) {
                $casting[] = $actor->cast->name;
                /* dd($actor->cast->name); */
            }  
            $movie->casting = $casting; 
        }
        $pdf = Pdf::loadView('movies.pdfMovies', compact('movies'));
        return $pdf->stream('peliculas_actores.pdf');
    }
}
