<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <title> @yield ("title") </title>
    @stack("css-libs")
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Pustaka</span>Pintar</div>
        </a>

        <ul class="side-menu">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="side-toggle" href="/dashboard"><i class='bx bxs-dashboard'></i>Dashboard</a>
            </li>

            <li class="{{ Request::is('katalog') ? 'active' : '' }}">
                <a class="side-toggle" href="/katalog"><i class='bx bx-store-alt'></i>Katalog</a>
            </li>

            <li class="{{ Request::is('sirkulasi') ? 'active' : '' }} dropdown">
                <button class="side-toggle">
                    <span><i class='bx bx-analyse'></i></span> Sirkulasi
                    <span class="rotate"><i class="bx bx-chevron-right"></i></span>
                </button>
                <ul class="side-sub-menu">
                    <div>
                        <li class="">
                            <a href="/sirkulasi/peminjaman" class="">Peminjaman</a>
                        </li>
                        <li class="">
                            <a href="/sirkulasi/pengembalian" class="">Pengembalian</a>
                        </li>
                    </div>
                </ul>
            </li>

            <li class="{{ Request::is('keanggotaan') ? 'active' : '' }}">
                <a class="side-toggle" href="/keanggotaan"><i class='bx bx-group'></i>Keanggotaan</a>
            </li>
        </ul>

        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">

        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>
            <a href="#" class="profile">
                <img src="images/logo.png">
            </a>
        </nav>
        <!-- End of Navbar -->

        <main>
            @yield ("content")
        </main>

    </div>
    @stack('script-libs')
    @stack("scripts")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="{{asset('assets/index.js')}}"></script>

</body>

</html>