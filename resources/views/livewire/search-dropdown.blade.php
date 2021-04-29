<div class="flex items-center">
    <div x-data="{ isOpen:false }" @click.away="isOpen = false" class="relative">
        <input
            x-ref="search"
            @click="isOpen = true"
            @focus="isOpen = true"
            @keydown="isOpen = true"
            @keydown.window="
                if(event.keycode === 191) {
                    event.preventDefault();
                    $refs.search.focus();
                }
            "
            @keydown.escape.window="isOpen = false"
            @keydown.shift.tab="isOpen = false"
            wire:model.debounce="search"
            type="text"
            class="bg-gray-700 rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline"
            placeholder="Search"/>
        <div wire:loading class="spinner top-0 right-0 mr-4 mt-2"></div>
        <div class="absolute top-0">
            <i class="fas fa-search py-2 ml-3 text-gray-400"></i>
        </div>

        @if(strlen($search) >= 2)
            <div
                x-show.transition.opacity="isOpen"
                class="z-50 absolute bg-gray-700 rounded-lg p-4 mt-4 ">
                <ul>
                    @forelse($searchResults as $result)
                        <li class="border-b border-gray-600">
                            <a href="{{ route('movie.show', $result['id']) }}"
                               @if($loop->last) @keydown.tab.exact="isOpen = false" @endif
                               class="block opacity-75 hover:opacity-100 rounded-lg p-3 flex items-center">
                                @if($result['poster_path'])
                                    <img src="{{ 'https://image.tmdb.org/t/p/w92/'.$result['poster_path'] }}"
                                         alt="poster" class="w-10 pr-4">
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="placeholder" class="w-8 pr-4">
                                @endif
                                <div> {{ $result['title'] }}</div>
                            </a>
                        </li>
                    @empty
                        <li>
                            <div>No Search Results...</div>
                        </li>
                    @endforelse
                </ul>
            </div>
        @endif
    </div>
</div>
