<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $details;

    public function __construct($movie)
    {
        $this->details = $movie;
    }

    public function details()
    {
        return collect($this->details)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->details['poster_path'],
            'vote_average' => $this->details['vote_average'] * 10,
            'release_date' =>  Carbon::parse($this->details['release_date'])->format('d, M Y'),
            'genres' => collect($this->details['genres'])->pluck('name')->flatten()->implode(' | '),
            'crew' => collect($this->details['credits']['crew'])->take(2),
            'cast' => collect($this->details['credits']['cast'])->take(5),
            'images' => collect($this->details['images']['backdrops'])->take(9),
        ])->only([
            'poster_path', 'id', 'genres', 'title', 'vote_average', 'overview', 'release_date', 'credits', 'videos', 'crew', 'cast', 'images'
        ]);
    }
}
