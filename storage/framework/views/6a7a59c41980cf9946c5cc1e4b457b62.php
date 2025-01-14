<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo e(asset('assets/style.css')); ?>">
    <title> <?php echo $__env->yieldContent("title"); ?> </title>
</head>

<body>

        <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-code-alt'></i>
            <div class="logo-name"><span>Pustaka</span>Pintar</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="/dashboard"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li ><a href="/katalog"><i class='bx bx-store-alt'></i>Katalog</a></li>
            <li ><a href="/sirkulasi"><i class='bx bx-analyse'></i>Sirkulasi</a></li>
            <li><a href="/keanggotaan"><i class='bx bx-group'></i>Keanggotaan</a></li>
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
            <div class="header">
                <div class="left">
                    <h1> <?php echo $__env->yieldContent("header"); ?> </h1>
                    <ul class="breadcrumb">
                        <li><a href="/sirkulasi">
                                Dashboard
                            </a></li>
                        
                    </ul>
                </div>
                <a href="#" class="report">
                    <i class='bx bx-cloud-download'></i>
                    <span>Download CSV</span>
                </a>
            </div>           

            <?php echo $__env->yieldContent("content"); ?>
        </main>

    </div>

    <script src="<?php echo e(asset('assets/index.js')); ?>"></script>
</body>

</html><?php /**PATH C:\laragon\www\perpustakaan-master\resources\views/dashboard.blade.php ENDPATH**/ ?>