<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::all();
        return view('actors.index', ['actors' => $actors]);
    }
    
    public function create()
    {
        return view('actors.create');
    }

    public function store(Request $request)
    {
        $actor = new Actor;
        $actor->name = $request->name;
        $actor->dateBirth = $request->dateBirth;
        $actor->save();

        return redirect()->route('actorIndex');
    }

    public function edit(Actor $actorId)
    {
        return response()->json($actorId);
    }
    
    public function update(Request $request, Actor $actorId)
    {
        $actorId->update([
            'name' => $request->name,
            'dateBirth' => $request->dateBirth
        ]);
    }

    public function destroy(){

    }
}
