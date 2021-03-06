<div>
    <div class="drawer">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            <!-- <label for="my-drawer" class="btn btn-primary drawer-button">Open drawer</label> -->
            <div class="active-side">
                <!-- Layout nav-bar controla o toggle -->
            </div>

            <div class="content">
                @yield('content-drawer')
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