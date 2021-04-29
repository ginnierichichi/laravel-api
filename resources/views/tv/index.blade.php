<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-16">
            <div class="border-b border-gray-700">
                <div class="uppercase tracking-wider text-yellow-500 text-2xl font-semibold">
                    Popular TV Shows
                </div>

                <div class="flex flex-col grid md:grid-cols-5 gap-8">
                    @forelse($popularTv as $tvshow)
                        <x-tv-card :tvshow="$tvshow" :genres="$genres"/>
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
                    @forelse($topRatedTv as $tvshow)
                        <x-tv-card :tvshow="$tvshow" :genres="$genres"/>
                    @empty
                        <div>Cant Fetch popular movies</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
