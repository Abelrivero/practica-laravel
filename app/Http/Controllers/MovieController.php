<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
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

    public function destroy(){

    }
}
