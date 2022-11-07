<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quiz do Leão') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.15.2/dist/full.css" rel="stylesheet" type="text/css" />

    @livewireStyles

</head>

<body>

    @extends('livewire.web-site.nav')

    @section('content')

    <main>
        {{ $main }}
    </main>

    @endsection
    
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- DaisyUI -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Ion Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    @livewireScripts
</body>

</html>