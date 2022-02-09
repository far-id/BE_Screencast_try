@csrf
<div class="mb-6">
    <x-label for="name" :value="__('Name')" />
    <x-input id="name" class="block w-full" type="text" name="name" :value="old('name') ?? $tag->name" placeholder="Laravel" />
    @error('name')
        <div class="mt-2 text-red-500">
          {{ $message }}
        </div>
    @enderror
</div>

<x-button>{{ $submit }}</x-button>
