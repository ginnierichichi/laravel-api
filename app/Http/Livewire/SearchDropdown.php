<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];

       if (strlen($this->search) >= 2) {
           $searchResults =  Http::get('https://api.themoviedb.org/3/search/movie?api_key='.config('services.tmdb.search').'&language=en-US&query='. $this->search . '&page=1&include_adult=false')
               ->json()['results'];
       }

//            Http::get(config('services.tmdb.search')->where('search', $this->search))
//            ->json()['results'];

        return view('livewire.search-dropdown', [
            'searchResults' => collect($searchResults)->take(7),
        ]);
    }
}
