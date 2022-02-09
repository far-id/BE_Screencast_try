<x-app-layout>
  <x-slot name="title">{{ $title }}</x-slot>
  <x-slot name="header">{{ $title }}</x-slot>

  <form action="{{ route('videos.create', $playlist->slug) }}" method="post" novalidate>
      @include('videos._form-control', [
        'submit' => "Add"
      ])
  </form>
</x-app-layout>