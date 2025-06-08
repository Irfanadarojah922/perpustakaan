document.addEventListener('DOMContentLoaded', function() {
    // --- Sidebar Active Link Handling ---
    const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

    sideLinks.forEach(item => {
        const li = item.parentElement;
        item.addEventListener('click', () => {
            sideLinks.forEach(i => {
                i.parentElement.classList.remove('active');
            })
            li.classList.add('active');
        });
    });

    // --- Sidebar Toggle (Menu Bar) ---
    const menuBar = document.querySelector('.content nav .bx.bx-menu');
    const sideBar = document.querySelector('.sidebar');

    if(menuBar !== null) {
        menuBar.addEventListener('click', () => {
            sideBar.classList.toggle('close');
        });
    }

    // --- Search Form Toggle (Mobile) ---
    const searchBtn = document.querySelector('.content nav form .form-input button');
    const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
    const searchForm = document.querySelector('.content nav form');

    searchBtn.addEventListener('click', function (e) {
        if (window.innerWidth < 576) {
            e.preventDefault(); // Menghentikan perilaku default tombol submit
            searchForm.classList.toggle('show');
            if (searchForm.classList.contains('show')) {
                searchBtnIcon.classList.replace('bx-search', 'bx-x');
            } else {
                searchBtnIcon.classList.replace('bx-x', 'bx-search');
            }
        }
    });

    // --- Responsive Sidebar & Search Form on Window Resize ---
    // Fungsi untuk menangani visibilitas sidebar berdasarkan lebar jendela
    function handleSidebarVisibility() {
        if (window.innerWidth < 768) {
            sideBar.classList.add('close');
        } else {
            sideBar.classList.remove('close');
        }
    }

    // Panggil fungsi saat halaman pertama kali dimuat
    handleSidebarVisibility();

    window.addEventListener('resize', () => {
        handleSidebarVisibility(); // Panggil fungsi saat ukuran jendela berubah

        // Atur ulang tampilan form pencarian jika layar membesar
        if (window.innerWidth > 576) {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
            searchForm.classList.remove('show');
        }
    });

    // --- Theme Toggle ---
    const toggler = document.getElementById('theme-toggle');
    const tables = document.querySelectorAll('table');

    // Atur tema saat pertama kali halaman dimuat
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark');
        toggler.checked = true;
        tables.forEach(table => {
            table.classList.remove('table-light');
            table.classList.add('table-dark');
        });
    } else {
        document.body.classList.remove('dark');
        toggler.checked = false;
        tables.forEach(table => {
            table.classList.remove('table-dark');
            table.classList.add('table-light');
        });
    }

    // Toggle tema saat user mengganti switch
    toggler.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
        tables.forEach(table => {
            if (this.checked) {
                table.classList.remove('table-light');
                table.classList.add('table-dark');
            } else {
                table.classList.remove('table-dark');
                table.classList.add('table-light');
            }
        });
    });

    // --- Submenu Toggle ---
    const toggleButtons = document.querySelectorAll('.side-toggle');

    toggleButtons.forEach((button) => {
        button.addEventListener('click', () => {
            // Hapus kelas 'active' dari semua sidebar links saat submenu dibuka
            sideLinks.forEach(item => {
                item.parentElement.classList.remove('active');
            });

            const submenu = button.nextElementSibling;

            button.classList.toggle('show'); // Untuk ikon panah atau indikator toggle

            if (submenu && submenu.classList.contains('side-sub-menu')) {
                submenu.classList.toggle('show'); // Untuk menampilkan/menyembunyikan submenu
            }
        });
    });
});