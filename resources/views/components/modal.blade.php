<div
    {{ $attributes->merge(['class' => 'absolute inset-0 w-full min-h-screen bg-black bg-opacity-25 flex items-center justify-center']) }}>
    <div class="w-1/2 overflow-hidden bg-white rounded-lg shadow-lg md:max-w-xl">
        <div class="flex items-center justify-between px-6 py-4 border-b bg-gray-50">
            <div class="text-lg font-medium leading-6 text-gray-900">{{ $title }}</div>
            <button class="focus:outline-none" @click="{{ $state }} = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="p-6">

            {{ $slot }}
        </div>
        <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
            <form action="{{ $actionRoute }}" method="post">
                @csrf
                @method($method)
                <button type="submit"
                    class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    {{ $button }}
                </button>
            </form>
            <button type="button" @click="{{ $state }} = false"
                class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                Cancel
            </button>
        </div>
    </div>
</div>
