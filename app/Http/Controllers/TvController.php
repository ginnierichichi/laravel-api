<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $popularTv = Http::get(config('services.tmdb.tv'))
            ->json()['results'];

        $topRatedTv = Http::get(config('services.tmdb.top'))
            ->json()['results'];

        $genres = Http::get(config('services.tmdb.list'))
            ->json()['genres'];

        $viewModel= new TvViewModel(
            $popularTv,
            $topRatedTv,
            $genres,
        );

        return view('tv.index', $viewModel);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function show(int $id)
    {
        $tvshow = Http::withToken(config('services.tmdb.search'))
            ->get('https://api.themoviedb.org/3/tv/'.$id.'?api_key='.config('services.tmdb.search').'&append_to_response=credits,images,videos&language=en-US')
            ->json();

        $viewModel = new TvShowViewModel($tvshow);

        return view('tv.show', $viewModel);

    }
}
