<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">
            <div class="flex">
                @include('layouts.sidebar')

                <!-- Page Content -->
                <main class="w-4/5 px-4 py-6">
                    @isset($header)
                        <div>
                            <h1 class="text-2xl font-medium">{{ $header }}</h1>
                            <div class="h-1 my-2 mb-5 bg-blue-600 rounded-full w-28"></div>
                        </div>
                    @endisset
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>