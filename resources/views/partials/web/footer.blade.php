<footer class="footer py-5">
    <div class="container">
        <div class="row">
            <!-- Logo Column -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="footer-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/img/yummy.png') }}" alt="Yummy" class="img-fluid" width="180"
                            lazyload="lazy">
                    </a>
                </div>
            </div>

            <!-- Konten Yummy Column -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h5 class="footer-heading mb-4">Konten Yummy</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('kategori', 'yummy') }}" class="text-decoration-none text-dark">Resep Yummy</a></li>
                    <li><a href="{{ route('kategori', 'sobat') }}" class="text-decoration-none text-dark">Resep Komunitas</a></li>
                    <li><a href="{{ route('bahan-makanan') }}" class="text-decoration-none text-dark">Resep dari Bahan</a></li>
                    <li><a href="{{ route('kategori', 'kreasi') }}" class="text-decoration-none text-dark">Resep Kreasi</a></li>
                    <li><a href="{{ route('kategori', 'camilan') }}" class="text-decoration-none text-dark">Snack & Cemilan</a></li>
                    <li><a href="{{ route('kategori', 'minuman') }}" class="text-decoration-none text-dark">Minuman</a></li>
                    <li><a href="{{ route('kategori', 'buah') }}" class="text-decoration-none text-dark">Resep Buah</a></li>
                </ul>
            </div>

            <!-- Tentang Yummy Column -->
            <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                <h5 class="footer-heading mb-4">Tentang Yummy</h5>
                <ul class="footer-links">
                    <li><a href="#" class="text-decoration-none text-dark">Panduan Menulis Yummy</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Syarat dan Ketentuan</a></li>
                    <li><a href="#" class="text-decoration-none text-dark">Masukan dan Bantuan</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading mb-4">Kontak Kami:</h5>
                <ul class="footer-contact">
                    <li>
                        <a href="mailto:hello@yummy.co.id"
                            class="d-flex align-items-center mb-3 text-decoration-none text-dark">
                            <i class="ri-mail-line me-2"></i>
                            <span>hello@yummy.co.id</span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:+6283843870483"
                            class="d-flex align-items-center mb-4 text-decoration-none text-dark">
                            <i class="ri-phone-line me-2"></i>
                            <span>+62 838-4387-0483</span>
                        </a>
                    </li>
                </ul>

                <h5 class="footer-heading mb-3">Download Aplikasi</h5>
                <div class="app-download d-flex flex-wrap mb-4">
                    <a href="#" class="me-2 mb-2">
                        <img src="{{ asset('assets/img/gplay.png') }}" lazyload="lazy" alt="Get it on Google Play"
                            height="40">
                    </a>
                    <a href="#" class="mb-2">
                        <img src="{{ asset('assets/img/appstore.png') }}" lazyload="lazy"
                            alt="Download on the App Store" height="40">
                    </a>
                </div>

                <h5 class="footer-heading mb-3">Ikuti Kami:</h5>
                <div class="social-links">
                    <a href="https://www.youtube.com/yummy" class="social-link text-dark text-decoration-none youtube"
                        target="_blank" aria-label="YouTube">
                        <i class="ri-youtube-fill"></i>
                    </a>
                    <a href="https://www.tiktok.com/@yummy" class="social-link text-dark text-decoration-none tiktok"
                        target="_blank" aria-label="TikTok">
                        <i class="ri-tiktok-fill"></i>
                    </a>
                    <a href="https://www.instagram.com/yummy"
                        class="social-link text-dark text-decoration-none instagram" target="_blank"
                        aria-label="Instagram">
                        <i class="ri-instagram-fill"></i>
                    </a>
                    <a href="https://www.facebook.com/yummy" class="social-link text-dark text-decoration-none facebook"
                        target="_blank" aria-label="Facebook">
                        <i class="ri-facebook-fill"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="scroll-to-top">
        <button class="btn rounded-circle shadow" id="scrollToTopBtn">
            <i class="ri-arrow-up-line"></i>
        </button>
    </div>
</footer>

@push('styles')
    <style>
        .footer {
            background-color: #f0f4f8;
            color: #333;
            position: relative;
        }

        .footer-logo {
            margin-bottom: 1.5rem;
        }

        .footer-heading {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }

        .footer-links {
            list-style: none;
            padding-left: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            text-decoration: none;
            color: #555;
            transition: color 0.3s ease;
            font-size: 0.95rem;
        }

        .footer-links,
        .footer-contact {
            list-style: none !important;
            padding-left: 0;
            margin-left: 0;
        }

        .app-download img {
            height: 40px;
            width: 140px;
            object-fit: contain;
        }

        .footer-links a:hover {
            color: #ff8a00;
        }

        .footer-contact {
            list-style: none;
            padding-left: 0;
        }

        .footer-contact a {
            text-decoration: none;
            color: #555;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .footer-contact a:hover {
            color: #ff8a00;
        }

        .footer-contact i {
            color: #666;
            font-size: 1.1rem;
        }

        .social-links {
            display: flex;
            gap: 12px;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #fff;
            transition: all 0.3s ease;
        }

        .youtube {
            background-color: #ff0000;
        }

        .youtube:hover {
            background-color: #cc0000;
            transform: translateY(-3px);
        }

        .tiktok {
            background-color: #000000;
        }

        .tiktok:hover {
            background-color: #333333;
            transform: translateY(-3px);
        }

        .instagram {
            background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
        }

        .instagram:hover {
            opacity: 0.9;
            transform: translateY(-3px);
        }

        .facebook {
            background-color: #1877f2;
        }

        .facebook:hover {
            background-color: #0e5aa7;
            transform: translateY(-3px);
        }

        .app-download img {
            transition: transform 0.3s ease;
        }

        .app-download img:hover {
            transform: translateY(-3px);
        }

        .footer-bottom {
            border-top: 1px solid #e0e0e0;
        }

        .site-url a {
            color: #555;
            font-size: 0.9rem;
        }

        .scroll-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
        }

        .scroll-to-top button {
            width: 45px;
            height: 45px;
            background-color: #ff8a00;
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            opacity: 0;
        }

        .scroll-to-top button:hover {
            background-color: #e67e00;
            transform: translateY(-3px);
        }

        .scroll-to-top button.show {
            opacity: 1;
        }

        /* RESPONSIVE STYLES */
        
        /* Large screens (lg) - 992px and up */
        @media (min-width: 992px) {
            .footer-logo img {
                max-width: 180px;
            }
        }

        /* Medium screens (md) - 768px to 991px */
        @media (min-width: 768px) and (max-width: 991px) {
            .footer {
                padding: 3rem 0;
            }
            
            .footer-heading {
                margin-top: 1.5rem;
                font-size: 1rem;
            }
            
            .footer-logo {
                text-align: center;
                margin-bottom: 2rem;
            }
            
            .footer-logo img {
                max-width: 150px;
            }
            
            .footer-links,
            .footer-contact {
                text-align: center;
            }
            
            .social-links {
                justify-content: center;
            }
            
            .app-download {
                justify-content: center;
            }
            
            .app-download img {
                width: 120px;
                height: 35px;
            }
        }

        /* Small screens (sm) - 576px to 767px */
        @media (min-width: 576px) and (max-width: 767px) {
            .footer {
                padding: 2.5rem 0;
            }
            
            .footer .container {
                padding: 0 2rem;
            }
            
            .footer-heading {
                font-size: 1rem;
                margin-top: 2rem;
                text-align: center;
            }
            
            .footer-logo {
                text-align: center;
                margin-bottom: 2rem;
            }
            
            .footer-logo img {
                max-width: 140px;
            }
            
            .footer-links,
            .footer-contact {
                text-align: center;
                margin-bottom: 2rem;
            }
            
            .footer-links a,
            .footer-contact a {
                font-size: 0.9rem;
            }
            
            .footer-contact a {
                justify-content: center;
            }
            
            .social-links {
                justify-content: center;
                gap: 15px;
            }
            
            .social-link {
                width: 45px;
                height: 45px;
            }
            
            .app-download {
                justify-content: center;
                flex-direction: column;
                align-items: center;
            }
            
            .app-download a {
                margin: 0.5rem 0;
            }
            
            .app-download img {
                width: 140px;
                height: 40px;
            }
            
            .scroll-to-top {
                bottom: 20px;
                right: 20px;
            }
        }

        /* Extra small screens (xs) - less than 576px */
        @media (max-width: 575px) {
            .footer {
                padding: 2rem 0;
            }
            
            .footer .container {
                padding: 0 1rem;
            }
            
            .footer-heading {
                font-size: 0.95rem;
                margin-top: 2rem;
                margin-bottom: 1rem;
                text-align: center;
            }
            
            .footer-logo {
                text-align: center;
                margin-bottom: 1.5rem;
            }
            
            .footer-logo img {
                max-width: 120px;
            }
            
            .footer-links,
            .footer-contact {
                text-align: center;
                margin-bottom: 2rem;
            }
            
            .footer-links li {
                margin-bottom: 0.5rem;
            }
            
            .footer-links a,
            .footer-contact a {
                font-size: 0.85rem;
            }
            
            .footer-contact a {
                justify-content: center;
                margin-bottom: 1rem !important;
            }
            
            .footer-contact a span {
                font-size: 0.85rem;
            }
            
            .social-links {
                justify-content: center;
                gap: 10px;
                margin-bottom: 1.5rem;
            }
            
            .social-link {
                width: 40px;
                height: 40px;
            }
            
            .app-download {
                justify-content: center;
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
            }
            
            .app-download a {
                margin: 0.25rem 0;
            }
            
            .app-download img {
                width: 130px;
                height: 38px;
            }
            
            .scroll-to-top {
                bottom: 15px;
                right: 15px;
            }
            
            .scroll-to-top button {
                width: 40px;
                height: 40px;
            }
        }

        /* Extra extra small screens - less than 400px */
        @media (max-width: 399px) {
            .footer {
                padding: 1.5rem 0;
            }
            
            .footer .container {
                padding: 0 0.5rem;
            }
            
            .footer-heading {
                font-size: 0.9rem;
                margin-top: 1.5rem;
            }
            
            .footer-logo img {
                max-width: 100px;
            }
            
            .footer-links a,
            .footer-contact a {
                font-size: 0.8rem;
            }
            
            .footer-contact a span {
                font-size: 0.8rem;
                word-break: break-all;
            }
            
            .social-link {
                width: 35px;
                height: 35px;
            }
            
            .social-link i {
                font-size: 0.9rem;
            }
            
            .app-download img {
                width: 120px;
                height: 35px;
            }
            
            .scroll-to-top button {
                width: 35px;
                height: 35px;
            }
        }

        /* Landscape orientation for mobile */
        @media (max-width: 767px) and (orientation: landscape) {
            .footer {
                padding: 1.5rem 0;
            }
            
            .footer-heading {
                margin-top: 1rem;
                margin-bottom: 0.75rem;
            }
            
            .footer-links li {
                margin-bottom: 0.5rem;
            }
            
            .social-links {
                margin-bottom: 1rem;
            }
        }

        /* Print styles */
        @media print {
            .footer {
                background-color: white !important;
                color: black !important;
            }
            
            .scroll-to-top {
                display: none !important;
            }
            
            .social-links a {
                background-color: gray !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollToTopBtn = document.getElementById('scrollToTopBtn');

            // Show/hide scroll to top button based on scroll position
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollToTopBtn.classList.add('show');
                } else {
                    scrollToTopBtn.classList.remove('show');
                }
            });

            // Scroll to top when button is clicked
            scrollToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Handle touch events for mobile scroll to top
            let touchStartY = 0;
            scrollToTopBtn.addEventListener('touchstart', function(e) {
                touchStartY = e.touches[0].clientY;
            });

            scrollToTopBtn.addEventListener('touchend', function(e) {
                const touchEndY = e.changedTouches[0].clientY;
                const touchDiff = touchStartY - touchEndY;
                
                // Only trigger if it's a tap (not a swipe)
                if (Math.abs(touchDiff) < 10) {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
@endpush