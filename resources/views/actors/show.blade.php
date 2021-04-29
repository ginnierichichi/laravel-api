<x-app-layout>
    <div class="movie-info border-b border-gray-700 my-10">
        <div class="container mx-auto px-4 my-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{ $actor['profile_path'] }}" alt="" class="w-96 mb-6">
                <div class="flex items-center space-x-4 my-4 text-2xl">
                    <a href="{{ $socials['facebook'] }}" target="_blank"><i class="fab fa-facebook-square"></i></a>
                    <a href="{{ $socials['twitter'] }}" target="_blank"><i class="fab fa-twitter-square"></i></a>
                    <a href="{{ $socials['instagram'] }}" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="mx-4">
                <div class="text-4xl font-semibold">{{ $actor['name'] }}</div>
                <div class="mt-2">
                    <div class="flex items-center text-base text-gray-400 mt-1">
                        <span><i class="fas fa-birthday-cake pr-2"></i></span>
                        <span>{{ $actor['birthday'] }}</span>
                        <span class="pl-2">({{ $actor['age'] }} years old)</span>
                        <span class="mx-2"> | </span>
                        <span>{{ $actor['place_of_birth'] }}</span>
                        <span class="mx-2"> | </span>
                        <div>
                           stuff they do
                        </div>
                    </div>

                </div>
                <div class="pt-6 mb-4">
                    <span class="text-lg uppercase tracking-wider">Biography:</span>
                    <div>{{ $actor['biography'] }}</div>
                </div>

                <div>
                   <span class="text-lg uppercase tracking-wider "> Known For:</span>
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 my-2 ">
                        @foreach($knownForTitles as $movie )
                            <a href="{{ route('movie.show', ['movie' => $movie['id']]) }}">
                                <img src="{{ $movie['poster_path'] }}" alt="">
                                <div class="mt-4">{{ $movie['title']  }}</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!----Credits Section --------->
    <div class="credits border-b border-gray-700 my-10">
        <div class="container mx-auto px-4 py-16">

            <h2 class="text-4xl">Credits</h2>

            <div class="flex  gap-8">
                <ul>
                    @foreach($credits as $credit)
                        <li class="flex items-center space-x-2">
                            <div class="tracking-widest">{{ $credit['release_year'] }}</div>
                            <div class="text-lg">&middot;</div>
                            <div><strong>{{ $credit['title'] }}</strong> as</div>
                            <div>{{ $credit['character'] }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
