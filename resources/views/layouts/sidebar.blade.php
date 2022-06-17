<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky">
        <h6 class="sidebar-heading px-3 mt-3 mb-1 text-muted" style="user-select:none">Beranda</h6>
        <ul class="nav flex-column fs-6">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ Request::is('/') ? 'active' : '' }}" href="/">
                    <span data-feather="home"></span>
                    <span class="ms-1">Dasbor</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ Request::is('grade*') ? 'active' : '' }}"
                    href="/grade">
                    <span data-feather="hexagon"></span>
                    <span class="ms-1">Kelas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ Request::is('category*') ? 'active' : '' }}"
                    href="/category">
                    <span data-feather="grid"></span>
                    <span class="ms-1">Kategori</span>
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading px-3 mt-3 mb-1 text-muted" style="user-select:none">Peminjam</h6>
        <ul class="nav flex-column fs-6">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ Request::is('book*') ? 'active' : '' }}" href="/book">
                    <span data-feather="book"></span>
                    <span class="ms-1">Buku</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ Request::is('borrower*') ? 'active' : '' }}"
                    href="/borrower">
                    <span data-feather="book-open"></span>
                    <span class="ms-1">Peminjam</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ Request::is('history*') ? 'active' : '' }}"
                    href="/history">
                    <span data-feather="bar-chart-2"></span>
                    <span class="ms-1">Sejarah</span>
                </a>
            </li>
        </ul>
        @auth
            <h6 class="sidebar-heading px-3 mt-3 mb-1 text-muted" style="user-select:none">Admin</h6>
            <ul class="nav flex-column fs-6">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ Request::is('user*') ? 'active' : '' }}" href="/user">
                        <span data-feather="user"></span>
                        <span class="ms-1">User</span>
                    </a>
                </li>
            </ul>
        @endauth
    </div>
</nav>
