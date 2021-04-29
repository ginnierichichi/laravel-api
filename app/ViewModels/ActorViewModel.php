<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $socials;
    public $credits;

    public function __construct($actor, $socials, $credits)
    {
        $this->actor = $actor;
        $this->socials = $socials;
        $this->credits = $credits;
    }

    public function actor()
    {
        return collect($this->actor)->merge([
            'birthday' => Carbon::parse($this->actor['birthday'])->format('d, M Y'),
            'age' => Carbon::parse($this->actor['birthday'])->age,
            'profile_path' => $this->actor['profile_path'] ? 'https://image.tmdb.org/t/p/w500'.$this->actor['profile_path'] : 'https://via.plaveholder.com/300x450',
        ]);
    }

    public function socials()
    {
        return collect($this->socials)->merge([
            'twitter' => $this->socials['twitter_id'] ? 'https://twitter.com/'.$this->socials['twitter_id'] : null,
            'facebook' => $this->socials['facebook_id'] ? 'https://facebook.com/'.$this->socials['facebook_id'] : null,
            'instagram' =>$this->socials['instagram_id'] ? 'https://instagram.com/'.$this->socials['instagram_id'] : null,
        ]);
    }

    public function knownForTitles()
    {
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)->sortByDesc('popularity')->take(5)->map(function($movie) {

            if(isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w185'.$movie['poster_path'] : 'https://via.placeholder.com/185x278',
                'title' => $title,
                'linkToPage' => $movie['media_type'] === 'movie' ? route('movie.show', ['movie' => $movie['id']]) : route('tv.show', ['show' => $movie['id']])
            ]);
        });
    }

    public function credits()
    {
        $castTitles = collect($this->credits)->get('cast');

        return collect($castTitles)->map(function($movie) {

            if(isset($movie['release_date'])) {
                $releaseDate = $movie['release_date'];
            } elseif (isset($movie['first_air_date'])) {
                $releaseDate = $movie['first_air_date'];
            } else {
                $releaseDate = '';
            }

            if(isset($movie['title'])) {
                $title = $movie['title'];
            } elseif (isset($movie['name'])) {
                $title = $movie['name'];
            } else {
                $title = 'Untitled';
            }

            return collect($movie)->merge([
                'release_date' => $releaseDate,
                'release_year' => isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                'title' => $title,
                'character' => $movie['character'] ?? '',
            ])->sortByDesc('release_date');
        });
    }
}
