@csrf
<div class="mb-6">
    <x-label for="title" :value="__('Title')" />
    <x-input type="text" name="title" class="block w-full mt-2" :value="old('title') ?? $video->title" id="title" />
    @error('title')
        <div class="mt-2 text-red-500">{{ $message }}</div>
    @enderror
</div>
<div class="mb-6">
    <x-label for="unique_video_id" :value="__('Unique key')" />
    <x-input type="text" name="unique_video_id" id="unique_video_id" class="block w-full mt-2"
        :value="old('unique_video_id') ?? $video->unique_video_id" />
    @error('unique_video_id')
        <div class="mt-2 text-red-500">{{ $message }}</div>
    @enderror
</div>
<div class="flex items-center">
    <div class="w-1/2 mb-6 lg:px-2">
        <x-label for="episode" :value="__('Episode')" />
        <x-input id="episode" name="episode" type="text" class="block w-full mt-2"
            :value="old('episode') ?? $video->episode" />
        @error('episode')
            <div class="mt-2 text-red-500">{{ $message }}</div>
        @enderror
    </div>
    <div class="w-1/2 mb-6 lg:px-2">
        <x-label for="runtime" :value="__('Runtime')" />
        <x-input id="runtime" name="runtime" type="text" class="block w-full mt-2"
            :value="old('runtime') ?? $video->runtime" />
        @error('runtime')
            <div class="mt-2 text-red-500">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="flex items-center mb-6">
    <input type="checkbox" id="intro" name="intro" {{ $video->intro ? 'checked' : ''}}
        class="mr-2 rounded-full checked:ring focus:outline-none checked:ring-fuchsia-500 checked:bg-fuchsia-600 checked:hover:bg-fuchsia-600 text-fuchsia-600 form-checkbox" />
    <label for="intro">
        <span class="select-none">Intro</span>
    </label>
</div>

<x-button>{{ $submit }}</x-button>
