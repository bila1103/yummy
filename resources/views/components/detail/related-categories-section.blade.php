<section class="related-categories-section py-4">
    <div class="container">
        <h2 class="section-title mb-4">Resep Kategori Terkait</h2>
        <div class="splide related-categories-slider">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($relatedCategories as $recipe)
                        <li class="splide__slide">
                            <a href="{{ route('detail', $recipe->slug) }}" class="card border-0 shadow-sm h-100 text-decoration-none">
                                <div class="card-header bg-white border-0 pt-3 pb-0 px-3">
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2">
                                            <img loading="lazy" src="{{ $recipe->user->avatar }}" alt="{{ $recipe->user->name }}"
                                                class="rounded-circle" width="40" height="40"
                                                style="object-fit:cover;">
                                        </div>
                                        <div class="user-name fw-semibold">{{ $recipe->user->name }}</div>
                                        @if ($recipe->user->is_verified)
                                            <i class="ri-verified-badge-fill text-primary ms-2"></i>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body p-3 position-relative">
                                    <img loading="lazy" src="{{ $recipe->image }}" alt="{{ $recipe->title }}"
                                        class="card-img rounded mb-2 w-100" style="object-fit:cover;height:180px;">
                                    <h5 class="card-title mb-0 mt-2"
                                        style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                        {{ $recipe->title }}</h5>
                                    <div class="recipe-meta d-flex align-items-center mt-2 justify-content-between">
                                        <div class="rating me-3">
                                            <i class="ri-star-fill text-warning"></i>
                                            <span class="rating-value">({{ $recipe->rating}})</span>
                                        </div>
                                        <div class="cooking-time me-3">
                                            <i class="ri-time-fill text-secondary"></i>
                                            <span>{{ $recipe->cooking_time }} menit</span>
                                        </div>
                                    </div>
                                    <div
                                        class="recipe-views-bookmark d-flex align-items-center justify-content-between mt-3">
                                        <div class="recipe-views">
                                            <i class="ri-eye-fill"></i> {{ $recipe->visited_count }}
                                        </div>
                                        <button class="btn btn-light bookmark-btn rounded-circle">
                                            <i class="ri-bookmark-line"></i>
                                        </button>
                                    </div>
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
        .related-categories-section {
            background-color: #f8f9fa;
            margin-bottom: 50px;
        }

        .section-title {
            font-weight: 700;
            color: #222;
        }

        .card {
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .user-avatar img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .user-name {
            font-size: 1rem;
        }

        .bookmark-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border-radius: 50%;
            background-color: #f8f9fa;
            color: #000000;
            font-weight: 500;
            border: none;
        }

        .bookmark-btn:hover {
            background-color: #ffc107;
            color: #343a40;
        }

        .rating i {
            color: #ffc107;
        }

        .cooking-time,
        .recipe-views {
            color: #6c757d;
            font-size: 15px;
        }

        .card-img {
            object-fit: cover;
            border-radius: 14px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('.related-categories-slider', {
                perPage: 4,
                perMove: 1,
                gap: 16,
                pagination: false,
                arrows: true,
                breakpoints: {
                    1200: {
                        perPage: 3
                    },
                    992: {
                        perPage: 2
                    },
                    576: {
                        perPage: 1
                    }
                }
            }).mount();
        });
    </script>
@endpush
