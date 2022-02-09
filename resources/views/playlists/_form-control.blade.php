@csrf

        <div class="mb-6">
            <input type="file" name="thumbnail" id="thumbnail">
            @error('thumbnail')
                <div class="mt-2 text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-6">
            <x-label for="name" :value="__('Name')" />
            <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name') ?? $playlist->name" required   autofocus />
            @error('name')
                <div class="mt-2 text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-6">
            <x-label for="price" :value="__('Price')" />
            <x-input id="price" class="block w-full mt-1" type="number" name="price" :value="old('price') ?? $playlist->price" required/>
            @error('price')
                <div class="mt-2 text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-6">
            <x-label for="description" :value="__('Description')" />
            <x-textarea id="description" name="description" required>{{ old('description') ?? $playlist->description }}</x-textarea>
            @error('description')
                <div class="mt-2 text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-6">
            <x-label for="tags" value="Tags" />
            <select multiple name="tags[]" id="tags" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-100">
                @foreach ($tags as $tag)
                    <option {{ $playlist->tags()->find($tag->id) ? ' selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>

        <x-button class="my-3" type="submit">{{ $submit }}</x-button>