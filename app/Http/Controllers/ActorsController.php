<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    public function index($page = 1)
    {
        abort_if($page > 500, 204);

        $popularActors = Http::get(config('services.tmdb.people').$page)
            ->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $page);

        return view('actors.index', $viewModel);
    }

    public function show($id)
    {
        $actor = Http::get('https://api.themoviedb.org/3/person/'.$id.'?api_key='.config('services.tmdb.search').'&language=en-US')
            ->json();

        $socials = Http::get('https://api.themoviedb.org/3/person/'.$id.'/external_ids?api_key='.config('services.tmdb.search').'&language=en-US')
            ->json();

        $credits = Http::get('https://api.themoviedb.org/3/person/'.$id.'/combined_credits?api_key='.config('services.tmdb.search').'&language=en-US')
            ->json();

        $viewModel = new ActorViewModel($actor,  $socials, $credits);

        return view('actors.show', $viewModel);
    }
}
