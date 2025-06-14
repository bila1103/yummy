<header class="bg-warning py-3 shadow-sm">
    <div class="container-fluid d-flex flex-row align-items-center justify-content-between">
        <!-- Logo -->
        <div class="d-flex align-items-center">
            <a href="/" class="d-block">
                <img loading="lazy" src="{{ asset('assets/img/yummy-header.png') }}" alt="Yummy Logo" class="img-fluid"
                    style="max-height: 40px;">
            </a>
        </div>

        <!-- Navigation (Desktop) -->
        <nav class="flex-grow-1 ms-4 d-none d-lg-block">
            <ul class="nav">
                <!-- Mega Menu Dropdown -->
                <li class="nav-item dropdown position-static">
                    <a class="nav-link fw-bold text-white dropdown-toggle" href="#" id="resepDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Resep Masakan</i>
                    </a>
                    <div class="dropdown-menu w-100 border-0 shadow-lg mt-2" aria-labelledby="resepDropdown">
                        <div class="container-fluid py-4 px-3 px-lg-5">
                            <div class="row gx-4 gy-3">
                                <div class="col-12 col-md-2">
                                    <div class="fw-bold mb-2">Rekomendasi Untukmu</div>
                                    <a href="{{ route('resep-teruji') }}" class="dropdown-item mb-1 px-0">Resep Teruji
                                        <i class="ri-vip-crown-fill text-warning"></i></a>
                                    <a href="{{ route('resep-terbaru') }}" class="dropdown-item mb-1 px-0">Resep
                                        Terbaru</a>
                                    <a href="{{ route('resep-terpopuler') }}" class="dropdown-item mb-1 px-0">Resep
                                        Terpopuler</a>
                                    <a href="{{ route('resep-terfavorit') }}" class="dropdown-item mb-1 px-0">Resep
                                        Terfavorit</a>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="fw-bold mb-2">Penulis Resep</div>
                                    <a href="/kategori/yummy" class="dropdown-item mb-1 px-0">Chef Yummy</a>
                                    <a href="/kategori/sobat" class="dropdown-item mb-1 px-0">Sobat Yummy</a>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="fw-bold mb-2">Bahan Pilihan</div>
                                    <a href="/kategori/ayam" class="dropdown-item mb-1 px-0">Ayam</a>
                                    <a href="/kategori/telur" class="dropdown-item mb-1 px-0">Telur</a>
                                    <a href="/kategori/tahu" class="dropdown-item mb-1 px-0">Tahu</a>
                                    <a href="/kategori/kentang" class="dropdown-item mb-1 px-0">Kentang</a>
                                    <a href="/kategori/tempe" class="dropdown-item mb-1 px-0">Tempe</a>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="fw-bold mb-2">Kategori Makanan</div>
                                    <a href="/kategori/makanan-pembuka" class="dropdown-item mb-1 px-0">Makanan
                                        Pembuka</a>
                                    <a href="/kategori/makanan-utama" class="dropdown-item mb-1 px-0">Makanan Utama</a>
                                    <a href="/kategori/makanan-penutup" class="dropdown-item mb-1 px-0">Makanan
                                        Penutup</a>
                                    <a href="/kategori/makanan-pendamping" class="dropdown-item mb-1 px-0">Makanan
                                        Pendamping</a>
                                    <a href="/kategori/minuman" class="dropdown-item mb-1 px-0">Minuman</a>
                                    <a href="/kategori/camilan" class="dropdown-item mb-1 px-0">Camilan</a>
                                    <a href="/kategori/mpasi" class="dropdown-item mb-1 px-0">MPASI</a>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="fw-bold mb-2">Cara Memasak</div>
                                    <a href="/kategori/masakan-goreng" class="dropdown-item mb-1 px-0">Goreng</a>
                                    <a href="/kategori/masakan-kukus" class="dropdown-item mb-1 px-0">Kukus</a>
                                    <a href="/kategori/masakan-panggang" class="dropdown-item mb-1 px-0">Panggang</a>
                                    <a href="/kategori/masakan-rebus" class="dropdown-item mb-1 px-0">Rebus</a>
                                    <a href="/kategori/masakan-bakar" class="dropdown-item mb-1 px-0">Bakar</a>
                                    <a href="/kategori/masakan-tumis" class="dropdown-item mb-1 px-0">Tumis</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-white" href="{{ route('all.recipes') }}">Resep</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-white" href="{{ route('bahan-makanan') }}">Bahan Makanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-white" href="{{ route('user.recipes.all') }}">Kreator</a>
                </li>
            </ul>
        </nav>

        <!-- Search & Icon (Desktop) -->
        <div class="col-lg-3 d-none d-lg-block">
            <div class="d-flex align-items-center">
                <div class="input-group">
                    <form action="{{ route('all.recipes') }}" method="GET" class="d-flex">
                        <input type="text" class="form-control" placeholder="Cari Resep..." aria-label="Search"
                            value="{{ request()->get('search') }}" name="search">
                        <button type="submit" class="btn btn-light d-flex align-items-center" type="button">
                            <i class="ri-search-line"></i>
                        </button>
                        <a href="{{ route('login') }}" class="btn-login ">LOGIN</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Mobile Controls -->
        <div class="d-flex d-lg-none">
            <button class="btn btn-transparent text-white" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileNav" aria-controls="mobileNav">
                <i class="ri-menu-line fs-4"></i>
            </button>
        </div>
    </div>

</header>

<!-- Mobile Off-Canvas Navigation -->
<div class="offcanvas offcanvas-start bg-warning" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileNavLabel">
            <img loading="lazy" src="{{ asset('assets/img/yummy-header.png') }}" alt="Yummy Logo" style="height: 40px;">
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mobile-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link py-2 text-white fw-bold d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" href="#resepSubmenu" role="button">
                        Resep Masakan
                        <i class="ri-arrow-down-s-line"></i>
                    </a>
                    <div class="collapse" id="resepSubmenu">
                        <div class="card card-body bg-transparent border-0">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <h6 class="text-white-50 mb-2">Rekomendasi Untukmu</h6>
                                    <ul class="list-unstyled">
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="{{ route('resep-teruji') }}">Resep Teruji</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="{{ route('resep-terbaru') }}">Resep Terbaru</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="{{ route('resep-terpopuler') }}">Resep Terpopuler</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="{{ route('resep-terfavorit') }}">Resep Terfavorit</a></li>
                                    </ul>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6 class="text-white-50 mb-2">Penulis Resep</h6>
                                    <ul class="list-unstyled">
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/yummy">Chef Yummy</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/sobat">Sobat Yummy</a></li>
                                    </ul>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6 class="text-white-50 mb-2">Bahan Pilihan</h6>
                                    <ul class="list-unstyled">
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/ayam">Ayam</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/telur">Telur</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/tahu">Tahu</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/kentang">Kentang</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/tempe">Tempe</a></li>
                                    </ul>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6 class="text-white-50 mb-2">Kategori Makanan</h6>
                                    <ul class="list-unstyled">
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/makanan-pembuka">Makanan Pembuka</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/makanan-utama">Makanan Utama</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/makanan-penutup">Makanan Penutup</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/makanan-pendamping">Makanan Pendamping</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/minuman">Minuman</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/camilan">Camilan</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/mpasi">MPASI</a></li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-white-50 mb-2">Cara Memasak</h6>
                                    <ul class="list-unstyled">
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/masakan-goreng">Goreng</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/masakan-kukus">Kukus</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/masakan-panggang">Panggang</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/masakan-rebus">Rebus</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/masakan-bakar">Bakar</a></li>
                                        <li><a class="text-white text-decoration-none py-1 d-block"
                                                href="/kategori/masakan-tumis">Tumis</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2 text-white fw-bold" href="{{ route('bahan-makanan') }}">Resep</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2 text-white fw-bold" href="{{ route('all.recipes') }}">Bahan Makanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2 text-white fw-bold" href="{{ route('user.recipes.all') }}">Kreator</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
    /* Navigation Links */
    .nav-link {
        font-size: 1rem;
        transition: color 0.2s ease;
    }

    .nav-link:hover {
        color: #fff7d6 !important;
    }

    /* Dropdown Menu Styling (Desktop) */
    .dropdown-menu {
        min-width: 90vw;
        max-width: 1300px;
        left: 0 !important;
        right: 0 !important;
        margin-left: auto !important;
        margin-right: auto !important;
        border-radius: 14px;
        padding: 1.5rem 1.5rem !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, .10);
    }

    .dropdown-menu .fw-bold {
        font-size: 1.1rem;
        color: #333;
    }

    .dropdown-menu .dropdown-item {
        color: #333;
        background: none;
        font-size: 1rem;
        border-radius: 0;
        transition: background .12s;
        padding-left: 0;
        padding-right: 0;
    }

    .dropdown-menu .dropdown-item:hover,
    .dropdown-menu .dropdown-item:focus {
        background: #f8991d22;
        color: #f8991d;
    }

    .dropdown-menu .row>div {
        margin-bottom: 1rem;
    }

    .btn-login {
        background-color: #fff;
        color: #f7931e;
        /* oranye khas yummy */
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
        margin-left: 10px;
    }

    .btn-login:hover {
        background-color: #f7931e;
        color: white;
    }


    /* Mobile Styles */
    @media (max-width: 991.98px) {
        .container-fluid.d-flex {
            flex-direction: row;
            align-items: center !important;
            justify-content: space-between !important;
        }

        nav.flex-grow-1.ms-4 {
            margin-left: 0 !important;
            width: auto;
        }

        .offcanvas {
            width: 80%;
            max-width: 300px;
        }

        .mobile-menu .nav-link {
            border-radius: 5px;
            margin-bottom: 3px;
            transition: background-color 0.2s;
        }

        .mobile-menu .nav-link:hover,
        .mobile-menu .nav-link:active {
            background-color: rgba(255, 255, 255, 0.1);
        }

        #resepSubmenu .row {
            flex-direction: column;
        }

        #resepSubmenu .col-6 {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .container-fluid.d-flex {
            flex-direction: column;
            align-items: flex-start !important;
        }

        nav.flex-grow-1.ms-4 {
            margin-left: 0 !important;
            width: 100%;
        }

        .input-group {
            width: 100%;
        }
    }

    /* Fix for dropdown on smaller screens */
    @media (max-width: 1199.98px) and (min-width: 992px) {
        .nav {
            justify-content: flex-start !important;
        }

        .nav-item {
            margin-right: 12px;
        }
    }
</style>

<script>
    // Dropdown mega menu show on hover (desktop only)
    function isDesktop() {
        return window.innerWidth >= 992;
    }

    document.querySelectorAll('.dropdown').forEach(function (dropdown) {
        dropdown.addEventListener('mouseenter', function () {
            if (isDesktop()) {
                let menu = this.querySelector('.dropdown-menu');
                if (menu) menu.classList.add('show');
            }
        });

        dropdown.addEventListener('mouseleave', function () {
            if (isDesktop()) {
                let menu = this.querySelector('.dropdown-menu');
                if (menu) menu.classList.remove('show');
            }
        });

        // For mobile, close dropdown on click outside
        document.addEventListener('click', function (e) {
            if (!dropdown.contains(e.target)) {
                let menu = dropdown.querySelector('.dropdown-menu');
                if (menu) menu.classList.remove('show');
            }
        });
    });

    // Ensure dropdown closes on resize to mobile
    window.addEventListener('resize', function () {
        if (!isDesktop()) {
            document.querySelectorAll('.dropdown-menu').forEach(function (menu) {
                menu.classList.remove('show');
            });
        }
    });

    // Fix for off-canvas menu links
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('#mobileNav .nav-link');
        links.forEach(link => {
            link.addEventListener('click', function (e) {
                if (!this.hasAttribute('data-bs-toggle')) {
                    document.querySelector('#mobileNav').classList.remove('show');
                    const backdrop = document.querySelector('.offcanvas-backdrop');
                    if (backdrop) backdrop.remove();
                }
            });
        });
    });
</script>