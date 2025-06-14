<section class="yummy-friends-section py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Resep Sobat Yummy</h2>
            <p class="section-subtitle mt-3 mb-5">
                Di komunitas Yummy, kamu bisa dapat uang dari tulis resep.<br>
                Ayo, tulis resep sebanyak-banyaknya!
            </p>
        </div>

        <div class="splide yummy-friends-slider">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($yummyRecipes as $recipe)
                        <li class="splide__slide">
                            <div class="card recipe-card h-100 border-0 shadow-sm">
                                <div class="card-body p-3 d-flex flex-column">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="user-avatar me-2">
                                            <img loading="lazy" src="{{ $recipe->user['avatar'] }}" alt="{{ $recipe->user['name'] }}"
                                                class="rounded-circle">
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <h6 class="user-name mb-0">{{ $recipe->user['name'] }}</h6>
                                            @if ($recipe->user['is_verified'])
                                                <div class="verified-badge ms-2">
                                                    <i class="ri-verified-badge-fill text-primary"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="recipe-image mb-3">
                                        <img loading="lazy" src="{{ $recipe['image'] }}" alt="{{ $recipe['title'] }}"
                                            class="img-fluid rounded">
                                    </div>

                                    <div class="flex-grow-1 d-flex flex-column">
                                        <h5 class="recipe-title mb-3 flex-grow-1">{{ $recipe['title'] }}</h5>

                                        <div class="recipe-meta d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center">
                                                <div class="rating me-2">
                                                    <i class="ri-star-fill text-warning"></i>
                                                    <span
                                                        class="rating-value">({{ number_format($recipe['rating'], 1) }})</span>
                                                </div>
                                                <div class="steps">
                                                    <i class="ri-bowl-fills text-secondary"></i>
                                                    <span>{{ $recipe['total_steps'] }} langkah</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="recipe-gallery d-flex justify-content-end align-items-center">
                                            <button class="btn btn-light bookmark-btn">
                                                <i class="ri-bookmark-line text-dark"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('kategori', 'sobat') }}" class="btn btn-primary px-4 py-2">Lihat Semua</a>
        </div>
    </div>
</section>


@push('styles')
    <style>
        .yummy-friends-section {
            background-color: #f0f4f8;
            margin-bottom: 80px;
        }

        .section-title {
            font-weight: 600;
            color: #333;
            font-size: 1.75rem;
        }

        .section-subtitle {
            color: #555;
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1rem;
            line-height: 1.5;
        }

        .recipe-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
        }

        .user-avatar img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .verified-badge {
            color: #007bff;
        }

        .user-name {
            font-weight: 500;
            font-size: 0.95rem;
            color: #333;
        }

        .recipe-image {
            overflow: hidden;
            border-radius: 0.25rem;
        }

        .recipe-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .recipe-card:hover .recipe-image img {
            transform: scale(1.05);
        }

        .recipe-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            line-height: 1.4;
            min-height: 4rem;
            word-wrap: break-word;
            word-break: break-word;
            hyphens: auto;
        }

        .recipe-meta {
            font-size: 0.85rem;
        }

        .rating {
            color: #333;
            display: flex;
            align-items: center;
        }

        .rating i {
            color: #ffc107;
            margin-right: 3px;
        }

        .steps {
            color: #666;
            display: flex;
            align-items: center;
        }

        .steps i {
            margin-right: 3px;
        }

        .recipe-thumbnails {
            display: flex;
            overflow: hidden;
        }

        .recipe-thumbnails img {
            width: 35px;
            height: 35px;
            object-fit: cover;
            margin-right: -10px;
            border: 2px solid white;
        }

        .recipe-thumbnails img:last-child {
            margin-right: 0;
        }

        /* Flexbox untuk card body agar spacing konsisten */
        .card-body {
            display: flex;
            flex-direction: column;
        }

        .card-body > .flex-grow-1 {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-body .recipe-title.flex-grow-1 {
            flex: 0 0 auto; /* Tidak perlu stretch, biarkan sesuai konten */
        }

        /* Splide custom styles */
        .splide__arrow {
            background: #ffffff;
            opacity: 1;
            width: 40px;
            height: 40px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .splide__arrow--next {
            right: -20px;
        }

        .splide__arrow--prev {
            left: -20px;
        }

        .splide__arrow svg {
            fill: #666;
            width: 14px;
            height: 14px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 1.5rem;
            }

            .section-subtitle {
                font-size: 0.95rem;
            }

            .recipe-image img {
                height: 180px;
            }

            .recipe-title {
                font-size: 1rem;
                min-height: 2.4rem;
            }

            .splide__arrow--next {
                right: -10px;
            }

            .splide__arrow--prev {
                left: -10px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Splide slider
            new Splide('.yummy-friends-slider', {
                perPage: 4,
                perMove: 1,
                gap: 20,
                pagination: false,
                breakpoints: {
                    1200: {
                        perPage: 3,
                    },
                    992: {
                        perPage: 2,
                    },
                    576: {
                        perPage: 1,
                        gap: 10
                    }
                }
            }).mount();

            // Bookmark button functionality
            const bookmarkButtons = document.querySelectorAll('.bookmark-btn');
            bookmarkButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.classList.toggle('active');
                    if (this.classList.contains('active')) {
                        this.innerHTML = '<i class="ri-bookmark-fill"></i>';
                    } else {
                        this.innerHTML = '<i class="ri-bookmark-line"></i>';
                    }
                });
            });
        });
    </script>
@endpush