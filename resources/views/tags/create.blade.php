<x-app-layout>
    <x-slot name="title">{{ $title }}</x-slot>
    <x-slot name="header">{{ $title }}</x-slot>

    <form action="{{ route('tags.create') }}" method="POST" novalidate>
        @include('tags._form-control', [
        'submit' => 'Create'
        ])
    </form>
</x-app-layout>
