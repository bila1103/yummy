<section class="recipe-creators-section py-4 container-fluid">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-transparent p-0 small">
            <li class="breadcrumb-item"><a href="#" class="text-warning">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pembuat Resep</li>
        </ol>
    </nav>

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <h4 class="fw-bold mb-0">Pembuat Resep Populer</h4>
                <form action="{{ route('user.recipes.all') }}" method="GET" class="d-flex creator-search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control filter-search-input"
                            placeholder="Cari pembuat resep" value="{{ request()->get('search') }}"
                            style="border-radius: 12px 0 0 12px;">
                        <button type="submit" class="btn btn-warning" style="border-radius: 0 12px 12px 0;">
                            <i class="ri-search-line"></i>
                        </button>
                    </div>

                    @if (request()->has('search') && !empty(request()->get('search')))
                        <a href="{{ route('user.recipes.all') }}" class="btn btn-outline-secondary ms-2">
                            <i class="ri-close-line"></i> Reset
                        </a>
                    @endif
                </form>
            </div>

            @if (request()->has('search') && !empty(request()->get('search')))
                <div class="search-result-info mt-2">
                    <p class="text-muted">Menampilkan hasil pencarian untuk: "{{ request()->get('search') }}"</p>
                </div>
            @endif
        </div>
    </div>

    @if ($creators->isEmpty())
        <div class="text-center py-5">
            <img src="{{ asset('assets/search-notfound.png') }}" alt="No results found" class="img-fluid mb-3"
                style="max-width: 250px;">
            <h4 class="mt-3">Tidak ada hasil</h4>
            <p class="text-muted">Tidak ada pembuat resep yang cocok dengan "{{ request()->get('search') }}"</p>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach ($creators as $creator)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 creator-card">
                        <div class="card-body p-4 text-center">
                            <a href="{{ route('user.recipes', $creator->username) }}" class="text-decoration-none">
                                <div class="position-relative mb-3">
                                    <img src="{{ $creator->avatar ?? asset('assets/default-avatar.png') }}"
                                        class="rounded-circle img-thumbnail creator-avatar" alt="{{ $creator->name }}"
                                        style="width: 110px; height: 110px; object-fit: cover;">

                                    @if ($creator->is_verified)
                                        <span
                                            class="position-absolute bottom-0 end-0 badge bg-primary rounded-circle p-2"
                                            style="transform: translate(10%, 10%);">
                                            <i class="ri-verified-badge-fill"></i>
                                        </span>
                                    @endif
                                </div>

                                <h5 class="fw-bold mb-1">{{ $creator->name }}</h5>
                                <p class="text-muted small mb-2">
                                    <i class="ri-at-line me-1"></i>{{ $creator->username }}
                                </p>
                            </a>

                            <div class="creator-stats d-flex justify-content-center gap-4 mb-3">
                                <div class="text-center">
                                    <div class="fw-bold">{{ number_format($creator->recipes_count) }}</div>
                                    <div class="text-muted small">Resep</div>
                                </div>
                                <div class="text-center">
                                    <div class="fw-bold">{{ number_format($creator->followers_count ?? 0) }}</div>
                                    <div class="text-muted small">Pengikut</div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <a href="{{ route('user.recipes', $creator->username) }}"
                                    class="btn btn-outline-warning rounded-pill">
                                    Lihat Resep
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $creators->links('components.user-recipes.pagination-custom') }}
        </div>
    @endif
</section>

@push('styles')
    <style>
        .filter-search-input {
            background: #f5f7fa;
            border: 1.5px solid #e5e8ee;
            font-size: 1rem;
            padding: 10px 14px;
        }

        .filter-search-input:focus {
            background: #fff;
            border-color: #ffaa2c;
            outline: none;
            box-shadow: 0 2px 10px rgba(255, 168, 44, 0.04);
        }

        .breadcrumb .text-warning {
            color: #ffaa2c !important;
        }

        .creator-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .creator-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .creator-avatar {
            transition: transform 0.3s ease;
            border: 3px solid #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .creator-card:hover .creator-avatar {
            transform: scale(1.05);
        }

        .creator-search-form {
            max-width: 400px;
        }

        @media (max-width: 768px) {
            .creator-search-form {
                margin-top: 1rem;
                width: 100%;
                max-width: 100%;
            }

            .featured-img {
                border-radius: 16px 16px 0 0 !important;
                height: 180px !important;
                width: 100%;
            }
        }

        @media (max-width: 767px) {
            .featured-creators .card .row {
                flex-direction: column;
            }

            .featured-creators .card .col-4 {
                width: 100%;
            }

            .featured-creators .card .col-8 {
                width: 100%;
            }
        }

        /* Category Pills */
        .category-pills {
            overflow-x: auto;
            flex-wrap: nowrap;
            padding-bottom: 10px;
            margin-bottom: 10px;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .category-pills::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }

        .category-pill {
            white-space: nowrap;
            font-size: 0.9rem;
            background: #f5f7fa;
            color: #495057;
            border: 1px solid #e5e8ee;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            margin-right: 8px;
            transition: all 0.2s ease;
        }

        .category-pill:hover {
            background: #ffaa2c;
            color: #fff;
            border-color: #ffaa2c;
        }

        .category-pill.active {
            background: #ffaa2c;
            color: #fff;
            border-color: #ffaa2c;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(255, 170, 44, 0.2);
        }

        /* Animation for page transitions */
        .custom-pagination .page-link {
            position: relative;
            overflow: hidden;
        }

        .custom-pagination .page-link::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }

        .custom-pagination .page-link:hover::before {
            width: 100%;
            height: 100%;
        }

        /* Top creator badge */
        .top-creator-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: linear-gradient(45deg, #FFD700, #FFA500);
            color: #fff;
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(255, 170, 44, 0.3);
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Horizontal scroll for category pills with mouse wheel
            const categoryPills = document.querySelector('.category-pills');
            if (categoryPills) {
                categoryPills.addEventListener('wheel', function(e) {
                    if (e.deltaY !== 0) {
                        e.preventDefault();
                        this.scrollLeft += e.deltaY;
                    }
                });
            }

            // Optional: Animation for creator cards
            const creatorCards = document.querySelectorAll('.creator-card');
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const cardObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            creatorCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition =
                    `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
                cardObserver.observe(card);
            });
        });
    </script>
@endpush
