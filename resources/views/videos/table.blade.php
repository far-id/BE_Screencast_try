<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="header">{{ $title }}</x-slot>

    <x-table>
        <tr>
            <x-th>#</x-th>
            <x-th>Title</x-th>
            <x-th>Action</x-th>
        </tr>
        @foreach ($videos as $item)
            <tr>
                <x-td>{{ $videos->count() * ($videos->currentPage() - 1) + $loop->iteration }}</x-td>
                <x-td>{{ $item->title }}</x-td>
                <x-td>
                    <div class="flex items-center">
                        <a href="{{ route('videos.edit', [$playlist->slug, $item->unique_video_id]) }}"
                            class="mr-1 text-xs font-medium text-blue-500 underline uppercase hover:text-blue-600">Edit</a>
                        <div x-data="{ openModal: false }">
                            <x-modal state="openModal" x-show="openModal" bg='true' title="Delete Tag"
                                actionRoute="{{ route('videos.delete', [$playlist->slug, $item->unique_video_id]) }}" method="delete" button="Delete">
                                <h4 class="text-base font-medium">{{ $item->title }}</h4>
                                <span class="text-sm font-light text-gray-500">Episode {{ $item->episode }}
                                  -
                                  Runtime {{ $item->runtime }}
                                </span>
                            </x-modal>
                            <button @click="openModal = true"
                                class="text-xs font-medium text-red-500 underline uppercase focus:outline-none hover:text-red-600">Delete
                            </button>
                        </div>
                    </div>
                </x-td>
            </tr>
        @endforeach
    </x-table>

    {{ $videos->links() }}
</x-app-layout>
