<section class="premium-recipes-section py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="section-title mb-0">Resep Premium Antigagal</h2>
            <a href="{{ route('resep-teruji') }}" class="view-all text-decoration-none">Lihat Semua <i class="ri ri-arrow-right-line"></i></a>
        </div>

        <div class="splide premium-recipes-slider">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($premiumRecipes as $recipe)
                        <li class="splide__slide">
                            <a href="{{ route('detail', $recipe['slug']) }}" class="card recipe-card border-0 shadow-sm h-100 text-decoration-none">
                                <div class="position-relative">
                                    <img loading="lazy" src="{{ $recipe['image'] }}" class="card-img-top" alt="{{ $recipe['title'] }}">
                                    <div class="recipe-badge">Resep Teruji</div>
                                </div>
                                <div class="card-body p-3">
                                    <h5 class="card-title">{{ $recipe['title'] }}</h5>
                                    <div class="recipe-meta d-flex align-items-center mt-2">
                                        <div class="d-flex align-items-center">
                                            <i class="ri-star-fill text-warning me-1"></i>
                                            <span
                                                class="rating-value">({{ $recipe['rating']}})</span>
                                        </div>
                                        <div class="d-flex align-items-center ms-3">
                                            <i class="ri-time-fill text-secondary me-1"></i>
                                            <span>{{ $recipe['cooking_time']  }} menit</span>
                                        </div>
                                        <div class="d-flex align-items-center ms-3">
                                            <i class="ri-fire-fill text-secondary me-1"></i>
                                            <span>100 Kj</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-0 p-3 pt-0">
                                    <button class="btn bookmark-btn float-end">
                                        <i class="ri-bookmark-line"></i>
                                    </button>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .premium-recipes-section {
            background-color: #ffffff;
            padding-bottom: 2rem;
            margin-bottom: 50px
        }

        .section-title {
            font-weight: 600;
            color: #333;
            font-size: 1.75rem;
        }

        .view-all {
            color: #ff8a00;
            font-weight: 500;
        }

        .recipe-card {
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }

        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .recipe-badge {
            position: absolute;
            top: 15px;
            left: 0;
            background-color: #ff3a3a;
            color: white;
            padding: 5px 15px;
            border-radius: 0 4px 4px 0;
            font-weight: 500;
            font-size: 0.9rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }


        .card-title {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0;
            color: #333;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 2.8rem;
        }

        .recipe-meta {
            font-size: 0.85rem;
        }

        .rating-value {
            color: #333;
        }

        .bookmark-btn {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 50%;
            background-color: #f8f9fa;
            color: #000000;
            font-weight: 500;
        }

        .bookmark-btn:hover {
            background-color: #ffc107;
            color: #343a40;
        }

        /* Splide slider custom styles */
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

        @media (max-width: 768px) {
            .section-title {
                font-size: 1.5rem;
            }

            .card-img-top {
                height: 180px;
            }

            .card-title {
                font-size: 1rem;
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
            new Splide('.premium-recipes-slider', {
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
                        arrows: true,
                        gap: 10
                    }
                }
            }).mount();

        });
    </script>
@endpush
