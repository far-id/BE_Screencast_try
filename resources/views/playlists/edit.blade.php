<x-app-layout>
    <x-slot name="title">
        Edit Playlists : {{ $playlist->name }}
    </x-slot>
    <x-slot name="header">
        Edit Playlists : {{ $playlist->name }}
    </x-slot>

    <div class="w-full lg:w-1/2">
        <img class="w-full mb-6 rounded-lg" src="{{ $playlist->picture }}" alt="{{ $playlist->name }}">
    </div>

    <form action="{{ route('playlists.edit', $playlist->slug) }}" method="post" enctype="multipart/form-data" novalidate>
        @method('put')
        @include('playlists._form-control', [
            'submit' => 'Update'
        ])
    </form>
</x-app-layout>
