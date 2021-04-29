<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{

    use Illuminate\Support\Facades\Http;

    public function can_display_the_correct_information() {

        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/movie/list' => $this->fakeGenres(),
            ]);
    $response = $this->get(route('movies.index'));

    $response->assertSuccessful();
    $response->assertSee('Popular Movies');
    $response->assertSee('Fake Movie');
//    $response->assertSee('Adventure, Drama');
        $response->assertSee('Now Playing');
        $response->assertSee('Now Playing Fake Movie');
    }

    public function the_movie_page_shows_the_correct_info()
    {
        Http::fake([
           'https://api.themoviedb.org/3/movie/*' => $this->fakeSingleMovie()
        ]);

        $response = $this->get(route('movie.show', 12345));
        $response->assertSee('Fake Jumanji');
        $response->assertSee('Jeanne McCarthy');
        $response->assertSee('Casting Director');
        $response->assertSee('Dwayne Johnson');
    }

    public function the_search_dropdown_works_correctly()
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=jumanji' => $this->fakeSearchMovies(),
        ]);

        Livewire::test('search-dropdown')
            ->assertDontSee('jumanji')
            ->set('search', 'jumanji')
            ->assertSee('Jumanji');
    }

    private function fakePopularMovies()
    {
        Http::response([
                'results' => [
                    [
                        "popularity" => 406,
                        "vote_count" => 2309,
                        "video" => false,
                        "poster_path" => "cast1.jpg",
                        "id" => 12345,
                        "adult" => false,
                        "backdrop_path" => "mau1.jpeg",
                        "original_language" => "en",
                        "original_title" => "Fake Movie",
                        "genre_ids" => [
                            12,18
                        ],
                        "title" => "Fake Movie",
                        "vote_average" => 6,
                        "overview" => "a fake movie with a fake title and description",
                        "release_date" => "2019-09-17",
                    ]
                ]
        ], 200);
    }

    private function fakeNowPlayingMovies()
    {
        Http::response([
            'results' => [
                [
                    "popularity" => 406,
                    "vote_count" => 2309,
                    "video" => false,
                    "poster_path" => "cast1.jpg",
                    "id" => 12345,
                    "adult" => false,
                    "backdrop_path" => "mau1.jpeg",
                    "original_language" => "en",
                    "original_title" => "Now Playing Fake Movie",
                    "genre_ids" => [
                        12,18
                    ],
                    "title" => "Now Playing Fake Movie",
                    "vote_average" => 6,
                    "overview" => "Now playing a fake movie with a fake title and description",
                    "release_date" => "2019-09-17",
                ]
            ]
        ], 200);
    }

    private function fakeGenres()
    {
        //
    }

    private function fakeSearchMovies()
    {
        Http::response([
            'results' => [
                [
                    "popularity" => 406,
                    "vote_count" => 2309,
                    "video" => false,
                    "poster_path" => "cast1.jpg",
                    "id" => 12345,
                    "adult" => false,
                    "backdrop_path" => "mau1.jpeg",
                    "original_language" => "en",
                    "original_title" => "Jumanji",
                    "genre_ids" => [
                        12,18
                    ],
                    "title" => "Jumanji",
                    "vote_average" => 6,
                    "overview" => "Jumanji is a fake movie with a fake title and description",
                    "release_date" => "2019-09-17",
                ]
            ]
        ], 200);
    }
}
