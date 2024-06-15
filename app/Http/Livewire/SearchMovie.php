<?php

namespace App\Http\Livewire;

use App\Models\Movie;
use Livewire\Component;

class SearchMovie extends Component
{
    public $movies = [];
    public $searchTerm = '';
    
    /* public function mount($movies)
    {
        $this->moviesResults = $movies;
    } */

    public function search()
    {
        if(strlen($this->searchTerm) >= 3){
            $this->movies = Movie::where('title', 'like', '%'.$this->searchTerm.'%')->get();   
        }
        $this->emit('movieEncontrada', $this->movies);
    }

    public function render()
    {
        return view('livewire.search-movie');
    }
}
