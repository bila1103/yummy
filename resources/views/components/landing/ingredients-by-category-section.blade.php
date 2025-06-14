<section class="ingredients-section py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Resep Berdasarkan Bahan</h2>
            <p class="section-subtitle mt-3">
                Tak perlu bingung lagi mau masak apa hari ini. Tinggal pilih bahan yang kamu
                punya dan dapatkan inspirasi resepnya!
            </p>
        </div>

        {{-- Row 1 --}}
        <div class="row g-2 mb-2 justify-content-center">
            @foreach ($ingredients as $ingredient)
                <div class="col-4 col-sm-4 col-md-2 col-lg">
                    <div class="text-decoration-none">
                        <div class="ingredient-card text-center">
                            <div class="ingredient-image mb-1">
                                <img loading="lazy" src="{{ $ingredient['image_url'] }}"
                                    alt="{{ $ingredient['name'] }}" class="img-fluid rounded">
                            </div>
                            <h6 class="ingredient-name">{!! nl2br(e(str_replace(' ', "\n", $ingredient['name']))) !!}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('bahan-makanan') }}" class="btn btn-primary px-4">Lihat Semua</a>
        </div>
    </div>

    <div class="scroll-to-top">
        <button class="btn rounded-circle shadow">
            <i class="ri-arrow-up-line"></i>
        </button>
    </div>
</section>

@push('styles')
    <style>
        .ingredients-section {
            background-color: #f0f4f8;
            margin-bottom: 150px;
        }

        .section-title {
            font-weight: 600;
            color: #333;
            font-size: 2rem;
        }

        .section-subtitle {
            color: #555;
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1rem;
        }

        .ingredient-card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 8px;
            height: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .ingredient-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .ingredient-image {
            overflow: hidden;
            border-radius: 6px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ingredient-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .ingredient-card:hover .ingredient-image img {
            transform: scale(1.1);
        }

        .ingredient-name {
            font-size: 0.8rem;
            font-weight: 500;
            color: #333;
            margin-bottom: 0;
            line-height: 1.2;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 30px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
            transform: translateY(-2px);
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
        }

        .scroll-to-top button:hover {
            background-color: #e67e00;
            transform: translateY(-3px);
        }

        /* Custom adjustments for even spacing */
        @media (min-width: 992px) {
            .col-lg {
                flex: 0 0 auto;
                width: 14.285%;
                /* 100% / 7 */
            }
        }

        @media (max-width: 991.98px) {
            .col-md-1 {
                flex: 0 0 auto;
                width: 14.285%;
                /* 100% / 7 */
            }
        }

        @media (max-width: 767.98px) {
            .section-title {
                font-size: 1.5rem;
            }

            .section-subtitle {
                font-size: 0.95rem;
            }

            .ingredient-image {
                height: 70px;
            }

            .ingredient-name {
                font-size: 0.7rem;
            }

            .ingredient-card {
                padding: 6px;
            }
        }

        @media (max-width: 575.98px) {
            .ingredient-image {
                height: 60px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll to top button functionality
            const scrollToTopBtn = document.querySelector('.scroll-to-top button');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollToTopBtn.style.opacity = '1';
                } else {
                    scrollToTopBtn.style.opacity = '0';
                }
            });

            scrollToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Initially hide the button
            scrollToTopBtn.style.opacity = '0';
        });
    </script>
@endpush
