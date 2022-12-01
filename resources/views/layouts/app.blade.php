<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name_admin', 'Quiz do Leão - Admin') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.15.2/dist/full.css" rel="stylesheet" type="text/css" />

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased bg-gray-100">

    @if(Auth::user())
        @extends('livewire.admin.nav-bar')

        @section('content-nav-bar')
        <!-- Page Content -->
        <main>
            <!-- Breadcrumbs -->
            @if(Session::has('breadcrumbs'))
            <div class="pl-6 pt-5 pb-0 text-sm breadcrumbs">
                <ul>
                    <li>
                        <a href="{{ route('homePageAdmin') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    @foreach(Session::get('breadcrumbs') as $key)
                    <li>
                        <a href="{{\App\Providers\RouteServiceProvider::HOME_ADMIN}}{{ $key['href'] }}">
                            @if($key['icon'] == 'pasta')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 mr-2 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            @endif
                            {{ $key['text'] }}
                        </a>
                    </li>
                    @endforeach
                    {{-- Limpa a Session do BreadCrumbs --}}
                    {{ Session::forget('breadcrumbs') }}
                </ul>
            </div>
            @endif

            <!-- Flash Data -->
            @if(Session::has('messageFlashData'))
                @livewire('admin.flash-data',[
                        session('typeFlashData'), 
                        session('messageFlashData')
                    ]
                )
            @endif
            
            <!-- Content -->
            {{ $slot }}
        </main>
        @endsection
    @else
        <main>
            <!-- Content -->
            {{ $slot }}
        </main>
    @endif
    
    @stack('modals')

    <!-- DaisyUI -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Ion Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- amCharts -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    @livewireScripts
</body>

</html>