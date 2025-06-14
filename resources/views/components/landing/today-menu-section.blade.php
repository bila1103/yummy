<section class="favorites-section py-4 container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="section-title mb-0">Menu Yummy Hari Ini!</h3>
    </div>

    <div class="splide todaymenu-slider">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($todayMenus as $todaymenu)
                    <li class="splide__slide">
                        <a href="{{ route('detail', $todaymenu->slug) }}" class="card border-0 shadow-sm h-100 text-decoration-none">
                            <div class="card-header bg-white border-0 pt-3 pb-0 px-3">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2">
                                        <img loading="lazy" src="{{ $todaymenu->user->avatar }}" alt="{{ $todaymenu->user->name }}"
                                            class="rounded-circle" width="40">
                                    </div>
                                    <div class="user-name">{{ $todaymenu->user->name }}</div>
                                    @if ($todaymenu->user['is_verified'])
                                        <div class="ms-2 verified">
                                            <i class="ri-verified-badge-fill"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body p-3 position-relative">
                                <img loading="lazy" src="{{ $todaymenu['image'] }}" alt="{{ $todaymenu['title'] }}"
                                    class="card-img rounded mb-2 w-100">
                                <div class="recipe-number">{{ $loop->iteration }}</div>
                                <h5 class="card-title mb-0 mt-2">{{ $todaymenu['title'] }}</h5>

                                <div class="recipe-meta d-flex align-items-center mt-2">
                                    <div class="rating me-auto">
                                        <i class="ri-star-fill text-warning"></i>
                                        <span class="rating-value">({{ $todaymenu['rating'] }})</span>
                                    </div>
                                    <div class="cooking-time">
                                        <i class="ri-time-fill text-secondary"></i>
                                        <span>{{ $todaymenu['cooking_time'] }}</span>
                                    </div>
                                </div>

                                <div class="recipe-actions d-flex align-items-center mt-3">
                                    <div class="page-views me-auto">
                                        <div class="d-flex justify-content-center align items-center gap-1">
                                            <div><i class="ri-eye-fill text-secondary"></i></div>
                                            <div>
                                                <span class="recipe-views">100</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-light bookmark-btn rounded-circle">
                                        <i class="ri-bookmark-line fs-5"></i>
                                    </button>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>


@push('styles')
    <style>
        .favorites-section {
            background-color: #f8f9fa;
        }

        .section-title {
            font-weight: 600;
            color: #333;
        }

        .view-all {
            color: #ff8a00;
            font-weight: 500;
        }

        .card {
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .recipe-number {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ffc107;
            color: white;
            font-weight: bold;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .verified i {
            color: #007bff;
        }

        .gallery-thumb {
            width: 25px;
            height: 25px;
            object-fit: cover;
            margin-right: -8px;
            border: 1px solid white;
        }

        .gallery-more {
            width: 25px;
            height: 25px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            margin-left: 0;
            border: 1px solid white;
        }

        .bookmark-btn {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 4px;
            background-color: #f8f9fa;
            color: #000000;
            font-weight: 500;
        }

        .bookmark-btn:hover {
            background-color: #ffc107;
            color: #343a40;
        }

        .rating i {
            color: #ffc107;
        }

        .cooking-time {
            color: #6c757d;
            font-size: 14px;
        }

        .recipe-views {
            color: #6c757d;
            font-size: 14px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('.todaymenu-slider', {
                perPage: 4,
                perMove: 1,
                gap: 16,
                pagination: false,
                arrows: true,
                breakpoints: {
                    1200: {
                        perPage: 3,
                    },
                    992: {
                        perPage: 2,
                    },
                    576: {
                        perPage: 1,
                    }
                }
            }).mount();
        });
    </script>
@endpush
