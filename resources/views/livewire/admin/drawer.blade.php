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
                    <a href="{{ route('homePageAdmin') }}">
                        <ion-icon name="home-outline"></ion-icon>
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('perguntaShow') }}">
                        <ion-icon name="help-circle-outline"></ion-icon>
                        Perguntas
                    </a>
                </li>
                <li>
                    <a href="{{ route('baseJuridicaShow') }}">
                        <ion-icon name="reader-outline"></ion-icon>
                        Base Jurídica
                    </a>
                </li>
                <li>
                    <a href="{{ route('capituloShow') }}">
                        <ion-icon name="reader-outline"></ion-icon>
                        Capitulo
                    </a>
                </li>
                <li>
                    <a href="{{ route('artigoShow') }}">
                        <ion-icon name="reader-outline"></ion-icon>
                        Artigo
                    </a>
                </li>
                <li>
                    <a href="{{ route('paragrafoShow') }}">
                        <ion-icon name="reader-outline"></ion-icon>
                        Paragrafo
                    </a>
                </li>
                <li>
                    <a href="{{ route('incisoShow') }}">
                        <ion-icon name="reader-outline"></ion-icon>
                        Inciso
                    </a>
                </li>
                <li>
                    <a href="{{ route('alineaShow') }}">
                        <ion-icon name="reader-outline"></ion-icon>
                        Alinea
                    </a>
                </li>
                <li>
                    <a href="#">
                        <ion-icon name="people-outline"></ion-icon>
                        Usuários
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>