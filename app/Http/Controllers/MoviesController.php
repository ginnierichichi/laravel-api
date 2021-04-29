<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $popularMovies = Http::get(config('services.tmdb.key'))
            ->json()['results'];

        $nowPlayingMovies = Http::get(config('services.tmdb.now'))
            ->json()['results'];

        $genres = Http::get(config('services.tmdb.genre'))
            ->json()['genres'];

//        return view('index', [
//            'popularMovies' => $popularMovies,
//            'nowPlaying' => $nowPlayingMovies,
//            'genres' => $genres,
//        ]);

        $viewModel= new MoviesViewModel(
            $popularMovies,
            $nowPlayingMovies,
            $genres,
        );

        return view('index', $viewModel);
    }

    public function show($id)
    {
        $movieDetails = Http::get('https://api.themoviedb.org/3/movie/'.$id.'?api_key='.config('services.tmdb.search').'&append_to_response=credits,images,videos&language=en-US')
            ->json();



        $detailsModel= new MovieViewModel($movieDetails,);

        return view('show', $detailsModel);
    }
}
