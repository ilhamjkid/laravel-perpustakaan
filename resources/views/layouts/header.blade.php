<header class="navbar navbar-dark sticky-top bg-success flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-5" href="/">
        PERPUS MTSN 3 SDA
    </a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="space-dark w-100"></div>
    <div class="navbar-nav">
        @auth
            <form action="/logout" method="post" class="nav-item text-nowrap">
                @csrf
                <button type="submit" class="btn nav-link px-3 d-flex align-items-center text-white">
                    <span class="me-1">LOGOUT</span>
                    <span data-feather="log-out"></span>
                </button>
            </form>
        @else
            <a href="/login" class="btn nav-link px-3 d-flex align-items-center text-white">
                <span data-feather="log-in"></span>
                <span class="ms-1">LOGIN</span>
            </a>
        @endauth
    </div>
</header>
