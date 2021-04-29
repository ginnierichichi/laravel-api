<x-app-layout >
    <div class="tv-info border-b border-gray-700 my-10">
        <div class="container mx-auto px-4 my-16 flex flex-col md:flex-row">
            <img src="{{ $tvshow['poster_path'] }}" alt="" class="w-96 mb-6">
            <div class="mx-4">
                <div class="text-4xl font-semibold">{{$tvshow['name']}}</div>
                <div class="mt-2">
                    <div class="flex items-center text-sm text-gray-400 mt-1">
                        <span><i class="fas fa-star mr-2 text-yellow-300"></i></span>
                        <span>{{ $tvshow['vote_average'] }}%</span>
                        <span class="mx-2"> | </span>
                        <span>{{ $tvshow['first_air_date'] }}</span>
                        <span class="mx-2"> | </span>
                        <div>
                            {{ $tvshow['genres'] }}
                        </div>
                    </div>
                </div>
                <div class="pt-6">
                    {{ $tvshow['overview'] }}
                </div>
                <div class="mt-12">
                    <div class="flex items-start">
                        <div>
                            <h4 class="text-white font-semibold">Created by:</h4>
                            <div class="flex items-center mt-2 space-x-4">
                                @foreach($tvshow['created_by'] as $creator)
                                    <div>
                                        <div>{{ $creator['name'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="ml-8">
                            <h4 class="text-white font-semibold">Featured Crew:</h4>
                            <div class="flex items-center mt-2 space-x-4">
                                @foreach($tvshow['crew'] as $crew)
                                    <div>
                                        <div>{{ $crew['name'] }}</div>
                                        <div>{{ $crew['job'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div x-data="{ isOpen: false }">
                        @if (count($tvshow['videos']['results']) > 0)
                            <div class="mt-12">
                                <button
                                    @click="isOpen = true"
                                    class="flex inline-flex items-center rounded-lg bg-yellow-500 text-gray-800 rounded font-semibold px-5 py-4 hover:bg-yellow-600 transition ease-in-out duration-150"
                                >
                                    <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                    <span class="ml-2">Play Trailer</span>
                                </button>
                            </div>

                            <template x-if="isOpen">
                                <div
                                    style="background-color: rgba(0, 0, 0, .5);"
                                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                                >
                                    <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                        <div class="bg-gray-900 rounded">
                                            <div class="flex justify-end pr-4 pt-2">
                                                <button
                                                    @click="isOpen = false"
                                                    @keydown.escape.window="isOpen = false"
                                                    class="text-3xl leading-none hover:text-gray-300">&times;
                                                </button>
                                            </div>
                                            <div class="modal-body px-8 py-8">
                                                <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                                    <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="{{ 'https://www.youtube.com/embed/'.$tvshow['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----end movie info --------->

    <!----Casts Section --------->
    <div class="movie-cast border-b border-gray-700 my-10">
        <div class="container mx-auto px-4 py-16">

            <h2 class="text-4xl">Cast</h2>

            <div class="flex flex-col grid md:grid-cols-5 gap-8">
                            @foreach($tvshow['cast'] as $cast)
                                <div class="mt-8">
                                    <a href="{{ route('actors.show', ['actor' => $cast['id']]) }}">
                                        <img src="{{ 'https://image.tmdb.org/t/p/w300/'.$cast['profile_path'] }}" alt=""
                                             class="hover:opacity-75 transition ease-in-out duration-150">
                                        <div class="mt-2">
                                            <div>{{ $cast['name'] }}</div>
                                            <div class="flex items-center text-sm text-gray-400 my-1">
                                                <span>{{ $cast['character'] }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
            </div>
        </div>
    </div>

    <!------ Movie Images Section ----->
    <div class="movie-cast border-b border-gray-700 my-10">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl">Images</h2>

            <div class="flex flex-col grid md:grid-cols-3 gap-8 mt-8">
                            @foreach($tvshow['images'] as $image)
                                <img src="{{ 'https://image.tmdb.org/t/p/w500'.$image['file_path'] }}" alt=""
                                     class="hover:opacity-75 transition ease-in-out duration-150">
                            @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
