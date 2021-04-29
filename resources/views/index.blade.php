<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-16">
           <div class="border-b border-gray-700">
               <div class="uppercase tracking-wider text-yellow-500 text-2xl font-semibold">
                   Popular Movies
               </div>
               <div class="flex flex-col grid md:grid-cols-5 gap-8">
                   @forelse($popularMovies as $movie)
                       <div class="mt-8">
                           <a href="{{ route('movie.show', ['movie' => $movie['id']]) }}" >
                               <img src="{{ $movie['poster_path'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                           </a>
                           <div class="mt-2">
                               <a href="#">{{ $movie['title'] }}</a>
                               <div class="flex items-center text-sm text-gray-400 mt-1">
                                   <span><i class="fas fa-star mr-2 text-yellow-300"></i></span>
                                   <span>{{ $movie['vote_average'] }}%</span>
                                   <span class="mx-2"> | </span>
                                   <span>{{ $movie['release_date'] }}</span>
                               </div>
                               <div class="text-gray-400 text-sm mb-6">
                                   @foreach($movie['genre_ids'] as $genre)
                                       {{ $genres->get($genre) }}
                                       @if(!$loop->last)|
                                       @endif
                                   @endforeach
                               </div>
                           </div>
                       </div>
                   @empty
                       <div>Cant Fetch popular movies</div>
                   @endforelse
               </div>
           </div>

            <div class="border-b border-gray-700 my-8">
                <div class="uppercase tracking-wider text-yellow-500 text-2xl font-semibold">
                    Now Playing
                </div>
                <div class="flex flex-col grid md:grid-cols-5 gap-8">
                    @forelse($nowPlayingMovies as $movie)
                        <div class="mt-8">
                            <a href="{{ route('movie.show', ['movie' => $movie['id']]) }}" >
                                <img src="{{ $movie['poster_path'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="mt-2">
                                <a href="#">{{ $movie['title'] }}</a>
                                <div class="flex items-center text-sm text-gray-400 mt-1">
                                    <span><i class="fas fa-star mr-2 text-yellow-300"></i></span>
                                    <span>{{ $movie['vote_average'] }}%</span>
                                    <span class="mx-2"> | </span>
                                    <span>{{ $movie['release_date'] }}</span>
                                </div>
                                <div class="text-gray-400 text-sm break-words">
                                   {{ $movie['genres'] }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div>Cant Fetch popular movies</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
