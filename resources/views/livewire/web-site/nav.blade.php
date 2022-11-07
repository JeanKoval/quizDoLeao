<div>
    <nav class="flex justify-between">
        <div style="color: #136CF2;" class="flex pl-14 font-black text-3xl">
            <h1 class="pt-8">Quiz do Leão</h1>
            <img class="w-40" src="{{ asset('images/leao_nav.png') }}" alt="">
        </div>

        <div class="flex pr-52 pt-10 font-semibold">
            <a href="{{ route('homeWebSite') }}">
                <h1 class="nav_a pr-20">Home</h1>
            </a>
            <a href="#">
                <h1 class="nav_a pr-20">Sobre nós</h1>
            </a>
            <a href="#">
                <h1 class="nav_a pr-20">Serviços</h1>
            </a>
            <a href="#">
                <h1 class="nav_a">Contato</h1>
            </a>
        </div>
    </nav>

    @yield('content')
</div>