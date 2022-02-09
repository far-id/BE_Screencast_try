<x-app-layout>
  <x-slot name="title">{{ $title }}</x-slot>
  <x-slot name="header">{{ $title }}</x-slot>

  <form action="{{ route('tags.edit', $tag->slug) }}" method="post" novalidate>
    @method('put')
    @include('tags._form-control', [
      'submit' => 'Update'
    ])
  </form>
</x-app-layout>