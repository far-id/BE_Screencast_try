<x-app-layout>
    <x-slot name="title">
        Your Playlists
    </x-slot>
    <x-slot name="header">
        Your Playlists
    </x-slot>

    <x-table>
        <tr>
            <x-th>#</x-th>
            <x-th>Name</x-th>
            <x-th>Published</x-th>
            <x-th>Action</x-th>
        </tr>

        @foreach ($playlists as $item)
            <tr>
                <x-td>{{ $playlists->count() * ($playlists->currentPage() - 1) + $loop->iteration }}</x-td>
                <x-td>
                    <div>
                        <a href="{{ route('videos.table', $item->slug) }}"
                            class="block text-blue-500 hover:text-blue-600 hover:underline">
                            {{ $item->name }}
                        </a>
                        @foreach ($item->tags as $tag)
                            <span class="mr-1 text-xs">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </x-td>
                <x-td>{{ $item->created_at->format('d F, Y') }}</x-td>
                <x-td>
                    <div class="flex items-center">
                        <a class="mr-1 text-xs font-medium text-blue-500 underline uppercase hover:text-blue-600"
                            href="{{ route('videos.create', $item->slug) }}">Video</a>
                        <a class="mx-1 text-xs font-medium text-blue-500 underline uppercase hover:text-blue-600"
                            href="{{ route('playlists.edit', $item->slug) }}">Edit</a>
                        <div x-data="{ open: false }">
                            <x-modal state="open" x-show="open" bg='true' title="Delete playlist"
                                actionRoute="{{ route('playlists.delete', $item->slug) }}" method="delete"
                                button="Delete">
                                Are you sure to delete <span class="italic text-light">{{ $item->name }}</span> from
                                playlist?
                            </x-modal>

                            <button @click="open = true"
                                class="text-xs font-medium text-red-500 underline uppercase focus:outline-none hover:text-red-600">Delete
                            </button>
                        </div>
                    </div>
                </x-td>
            </tr>
        @endforeach
    </x-table>

    {{ $playlists->links() }}
</x-app-layout>
