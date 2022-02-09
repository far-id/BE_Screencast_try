<div class="w-1/5 bg-gray-900 min-h-screen p-5">
    <div class="mb-8">
        <header class="font-medium uppercase px-2 text-gray-400 text-xs">
            Main
        </header>
        <a href="#" class="block text-gray-200 px-2 py-2">Dashboard</a>
    </div>
    @can('create playlists')
        <div class="mb-8">
            <header class="font-medium uppercase px-2 text-gray-400 text-xs">
                Playlist
            </header>
            <a href="{{ route('playlists.create') }}" class="block text-gray-200 px-2 py-2">Create</a>
            <a href="{{ route('playlists.table') }}" class="block text-gray-200 px-2 py-2">Table</a>
        </div>
    @endcan

    @can('create tags')
        <div class="mb-8">
            <header class="font-medium uppercase px-2 text-gray-400 text-xs">
                Tags
            </header>
            <a href="{{ route('tags.create') }}" class="block text-gray-200 px-2 py-2">Create</a>
            <a href="{{ route('tags.table') }}" class="block text-gray-200 px-2 py-2">Table</a>
        </div>
    @endcan

    @can('show users')
        <div class="mb-8">
            <header class="font-medium uppercase px-2 text-gray-400 text-xs">
                Users
            </header>
            <a href="#" class="block text-gray-200 px-2 py-2">Table</a>
        </div>
    @endcan

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <a href="route('logout')" class="block text-gray-200 px-2 py-2" onclick="event.preventDefault();
                                        this.closest('form').submit();">
            {{ __('Log Out') }}
        </a>
    </form>
</div>
