<section class="official-accounts-section py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">Resep dari Akun Official</h2>
            <a href="{{ route('user.recipes.all') }}" class="view-all text-decoration-none">Lihat Semua <i class="ri-arrow-right-line"></i></a>
        </div>

        <div class="splide official-accounts-slider">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($officialAccounts as $account)
                        <li class="splide__slide">
                            <div class="card account-card border-0 shadow-sm h-100">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="account-avatar me-3">
                                            <img loading="lazy" src="{{ $account['avatar'] }}" alt="{{ $account['name'] }}"
                                                class="rounded-circle">
                                        </div>
                                        <div class="account-info">
                                            <div class="d-flex align-items-center">
                                                <h5 class="account-name mb-0">{{ $account['name'] }}</h5>
                                                <div class="verified-badge ms-2">
                                                    <i class="ri-verified-badge-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="recipe-grid">
                                        <div class="row g-2">
                                            @foreach ($account->recipes as $index => $recipe)
                                                <div class="col-4">
                                                    <div
                                                        class="recipe-thumbnail {{ $index === 2 ? 'position-relative' : '' }}">
                                                        <img loading="lazy" src="{{ $recipe['image'] }}" alt="Recipe"
                                                            class="img-fluid rounded">
                                                        @if ($index === 2)
                                                            <div class="recipe-overlay">
                                                                <div class="new-badge">
                                                                    {{ $account['recipes_count'] }}</div>
                                                                <div class="recipe-label">Resep</div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .official-accounts-section {
            background-color: #ffffff;
            padding-bottom: 2rem;
            margin-bottom: 50px;
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

        .account-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .account-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
        }

        .account-avatar img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border: 2px solid #f0f0f0;
        }

        .account-name {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }

        .account-stats {
            font-size: 0.8rem;
            line-height: 1.2;
            margin-top: 2px;
        }

        .verified-badge {
            color: #007bff;
        }

        .recipe-thumbnail {
            width: 100%;
            height: 90px;
            overflow: hidden;
            position: relative;
        }

        .recipe-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .recipe-thumbnail:hover img {
            transform: scale(1.05);
        }

        .recipe-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border-radius: 0.25rem;
        }

        .new-badge {
            font-weight: 600;
            font-size: 1.2rem;
        }

        .recipe-label {
            font-size: 0.8rem;
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

            .account-avatar img {
                width: 40px;
                height: 40px;
            }

            .account-name {
                font-size: 1rem;
            }

            .recipe-thumbnail {
                height: 70px;
            }

            .new-badge {
                font-size: 1rem;
            }

            .recipe-label {
                font-size: 0.7rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('.official-accounts-slider', {
                perPage: 3,
                perMove: 1,
                gap: 20,
                pagination: false,
                breakpoints: {
                    992: {
                        perPage: 2,
                    },
                    576: {
                        perPage: 1,
                        gap: 10
                    }
                }
            }).mount();
        });
    </script>
@endpush
