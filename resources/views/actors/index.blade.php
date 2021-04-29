<x-app-layout>
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-16">
            <div class="border-b border-gray-700">
                <div class="uppercase tracking-wider text-yellow-500 text-2xl font-semibold">
                    Popular Actors
                </div>
                <div class="scroll flex flex-col grid md:grid-cols-5 gap-8">
                    @foreach($popularActors as $actor)
                        <div class="actor mt-8">
                            <a href="{{ route('actors.show', ['actor' => $actor['id']]) }}">
                                <img src="{{ $actor['profile_path'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <a href="{{ route('actors.show', ['actor' => $actor['id']]) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                            <div class="text-sm truncate text-gray-400">
                                {{$actor['known_for']}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--- End popular actors ---->
            <div class="page-load-status my-8">
                <div class="infinite-scroll-request spinner text-center text-4xl">&nbsp;</div>
                <p class="infinite-scroll-last">End of content</p>
                <p class="infinite-scroll-error">Error</p>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let elem = document.querySelector('.scroll');
    let infScroll = new InfiniteScroll( elem, {
        // options
        path: '/actors/page/@{{#}}',
        append: '.actor',
        status: '.page-load-status'
    });
</script>


