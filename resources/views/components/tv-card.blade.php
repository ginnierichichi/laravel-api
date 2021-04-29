<div class="mt-8">
    <a href="{{ route('tv.show', ['show' => $tvshow['id']]) }}" >
        <img src="{{ $tvshow['poster_path'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150">
    </a>

    <div class="mt-2">
        <a href="#">{{ $tvshow['name'] }}</a>
        <div class="flex items-center text-sm text-gray-400 mt-1">
            <span><i class="fas fa-star mr-2 text-yellow-300"></i></span>
            <span>{{ $tvshow['vote_average'] }}%</span>
            <span class="mx-2"> | </span>
            <span>{{ $tvshow['first_air_date'] }}</span>
        </div>
        <div class="text-gray-400 text-sm mb-6">
            @foreach($tvshow['genre_ids'] as $genre)
                {{ $genres->get($genre) }}
                @if(!$loop->last)|
                @endif
            @endforeach
        </div>
    </div>
</div>

