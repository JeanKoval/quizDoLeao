<div>
    <div class="navbar bg-base-100">
        <div class="flex-none">
            <label for="my-drawer" class="btn btn-square btn-ghost drawer-button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </label>
        </div>
        <div class="flex-1">
            <a href="/" class="btn btn-ghost normal-case text-xl">Quiz do Leão - Administrar</a>
        </div>
        <div class="flex-none">
            <div class="dropdown dropdown-end">
                <button tabindex="0" class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                    </svg>
                </button>
                <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                    <li>
                        <a href="{{ route('profile.show') }}">
                            Profile
                        </a>
                    </li>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <li>
                            <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                Sair
                            </a>
                        </li>
                    </form>
                </ul>
            </div>
        </div>
    </div>
    @extends('livewire.admin.drawer')

    @section('content-drawer')

    @yield('content-nav-bar')

    @endsection
</div>