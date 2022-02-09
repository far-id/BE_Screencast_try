<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="header">{{ $title }}</x-slot>

    <x-table>
        <tr>
            <x-th>#</x-th>
            <x-th>Name</x-th>
            <x-th>Playlists</x-th>
            @can('delete tags', $tags)
                <x-th>Action</x-th>
            @endcan
        </tr>
        @foreach ($tags as $item)
            <tr>
                <x-td>{{ $tags->count() * ($tags->currentPage() - 1) + $loop->iteration }}</x-td>
                <x-td>{{ $item->name }}</x-td>
                <x-td>{{ $item->playlists_count }}</x-td>
                @can('delete tags', $tags)
                    <x-td>
                        <div class="flex items-center">
                            <a class="mr-1 text-xs font-medium text-blue-500 underline uppercase hover:text-blue-600"
                                href="{{ route('tags.edit', $item->slug) }}">Edit</a>
                            <div x-data="{ openModal: false }">
                                <x-modal state="openModal" x-show="openModal" bg='true' title="Delete Tag"
                                    actionRoute="{{ route('tags.delete', $item->slug) }}" method="delete" button="Delete">
                                    Are you sure to delete <span class="italic text-light">{{ $item->name }}</span> from
                                    Tag?

                                    <p>
                                        This action can remove <span class="italic text-light">{{ $item->name }}</span> tag
                                        from {{ $item->playlists_count }} Playlists
                                    </p>
                                </x-modal>
                                <button @click="openModal = true"
                                    class="text-xs font-medium text-red-500 underline uppercase focus:outline-none hover:text-red-600">Delete
                                </button>
                            </div>
                        </div>
                    </x-td>
                @endcan
            </tr>
        @endforeach
    </x-table>
    {{ $tags->links() }}
</x-app-layout>
