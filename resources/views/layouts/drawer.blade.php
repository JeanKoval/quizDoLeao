<div>
    <div class="drawer">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            <!-- <label for="my-drawer" class="btn btn-primary drawer-button">Open drawer</label> -->
            <div class="active-side">

                <label for="my-drawer" class="btn btn-circle swap swap-rotate drawer-button">

                    <!-- this hidden checkbox controls the state -->
                    <input type="checkbox" />

                    <!-- hamburger icon -->
                    <svg class="swap-off fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512">
                        <path d="M64,384H448V341.33H64Zm0-106.67H448V234.67H64ZM64,128v42.67H448V128Z" />
                    </svg>

                    <!-- close icon -->
                    <svg class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512">
                        <polygon points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                    </svg>

                </label>
            </div>

            <div class="content">
                @yield('content')
            </div>

        </div>
        <div class="drawer-side">
            <label for="my-drawer" class="drawer-overlay"></label>
            <ul class="menu p-4 overflow-y-auto w-80 bg-base-100 text-base-content">
                <!-- Sidebar content here -->
                <li>
                    <a href="/">
                        <ion-icon name="home-outline"></ion-icon>
                        Home
                    </a>
                </li>
                <li>
                    <a href="/pergunta">
                        <ion-icon name="help-outline"></ion-icon>
                        Perguntas
                    </a>
                </li>
                <li>
                    <a href="/user">
                        <ion-icon name="people-outline"></ion-icon>
                        Usuários
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>