<section class="user-recipes-section py-4 container-fluid">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-transparent p-0 small">
            <li class="breadcrumb-item"><a href="#" class="text-warning">Home</a></li>
            <li class="breadcrumb-item"><a href="#" class="text-warning">Resep</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- User Profile Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="profile-sidebar rounded-4 shadow-sm p-4 bg-white">
                <div class="text-center mb-3">
                    <img loading="lazy" src="{{ $user->avatar ?? asset('assets/default-avatar.png') }}"
                        alt="{{ $user->name }}" class="rounded-circle img-thumbnail"
                        style="width: 120px; height: 120px; object-fit: cover;">
                </div>

                <h4 class="text-center fw-bold mb-1">{{ $user->name }}</h4>
                <p class="text-center text-muted small mb-3">
                    <i class="ri-map-pin-line me-1"></i>{{ $user->location ?? 'Indonesia' }}
                </p>

                <div class="d-flex justify-content-center gap-4 mb-4">
                    <div class="text-center">
                        <div class="fw-bold">{{ number_format($recipesCount) }}</div>
                        <div class="text-muted small">Resep</div>
                    </div>
                    <div class="text-center">
                        <div class="fw-bold">{{ number_format($user->followers_count ?? 0) }}</div>
                        <div class="text-muted small">Pengikut</div>
                    </div>
                    <div class="text-center">
                        <div class="fw-bold">{{ number_format($user->following_count ?? 0) }}</div>
                        <div class="text-muted small">Mengikuti</div>
                    </div>
                </div>

                @if (!auth()->check() || auth()->id() !== $user->id)
                    <button class="btn btn-warning w-100 mb-3 rounded-pill fw-semibold">
                        <i class="ri-user-follow-line me-1"></i>Ikuti
                    </button>
                @endif

                @if ($user->bio)
                    <div class="bio-section mt-3">
                        <h6 class="fw-bold">Bio</h6>
                        <p class="small text-muted">{{ $user->bio }}</p>
                    </div>
                @endif

                <div class="search-recipe p-2 mt-3">
                    <form action="{{ route('user.recipes', $user->username) }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control filter-search-input"
                                placeholder="Cari Resep {{ $user->name }}" value="{{ request()->get('search') }}"
                                style="border-radius: 12px 0 0 12px;">
                            <button type="submit" class="btn btn-warning" style="border-radius: 0 12px 12px 0;">
                                <i class="ri-search-line"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Recipes Area -->
        <div class="col-lg-9">
            <div class="mb-3 d-flex flex-wrap align-items-center justify-content-between">
                <h4 class="fw-bold mb-0">Resep oleh {{ $user->name }}</h4>

                @if (request()->has('search') && !empty(request()->get('search')))
                    <div class="d-flex align-items-center">
                        <span class="me-2">Hasil pencarian: "{{ request()->get('search') }}"</span>
                        <a href="{{ route('user.recipes', $user->username) }}"
                            class="btn btn-sm btn-outline-secondary">
                            <i class="ri-close-line"></i> Reset
                        </a>
                    </div>
                @endif
            </div>

            @if ($recipes->isEmpty())
                <div class="text-center py-5">
                    @if (request()->has('search') && !empty(request()->get('search')))
                        <h4 class="mt-3">Tidak ada hasil</h4>
                        <p class="text-muted">Tidak ada resep yang cocok dengan "{{ request()->get('search') }}"</p>
                    @else
                        <img loading="lazy" src="{{ asset('assets/empty-recipe.png') }}" alt="No recipes yet"
                            class="img-fluid mb-3" style="max-width: 250px;">
                        <h4 class="mt-3">Belum ada resep</h4>
                        <p class="text-muted">{{ $user->name }} belum membuat resep apapun</p>
                    @endif
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach ($recipes as $recipe)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-4">
                                <div class="position-relative">
                                    <img loading="lazy" src="{{ $recipe->image }}" class="card-img-top card-img"
                                        alt="{{ $recipe->title }}" loading="lazy"
                                        style="height: 180px; object-fit: cover; border-radius: 16px 16px 0 0;">

                                    @if ($recipe->is_premium)
                                        <span class="position-absolute top-0 start-0 mt-2 ms-2 badge-tes">Premium</span>
                                    @endif

                                    <button class="position-absolute top-0 end-0 mt-2 me-2 bookmark-btn">
                                        <i class="ri-bookmark-line"></i>
                                    </button>
                                </div>

                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="rating me-2">
                                            <i class="ri-star-fill text-warning"></i>
                                            <span>{{ number_format($recipe->rating, 1) }}</span>
                                        </div>
                                        <div class="kalori ms-auto">
                                            <i class="ri-fire-fill text-danger"></i>
                                            <span>{{ $recipe->calories ?? '-' }} </span>
                                        </div>
                                    </div>

                                    <h5 class="card-title mb-2">
                                        <a href="{{ route('detail', $recipe->slug) }}"
                                            class="text-dark text-decoration-none">
                                            {{ $recipe->title }}
                                        </a>
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <img loading="lazy"
                                            src="{{ $user->avatar ?? asset('assets/default-avatar.png') }}"
                                            class="rounded-circle me-2" width="24" height="24"
                                            alt="{{ $user->name }}" loading="lazy">

                                        <span class="small text-muted">{{ $user->name }}</span>

                                        <span class="ms-auto small text-muted">
                                            <i class="ri-time-line"></i> {{ $recipe->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-5">
                    {{ $recipes->links('components.user-recipes.pagination-custom') }}
                </div>
            @endif
        </div>
    </div>
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

        .badge-tes {
            background: #ff4d4f;
            color: #fff;
            font-size: 0.89rem;
            font-weight: 600;
            border-radius: 12px;
            padding: 3.5px 16px;
            z-index: 2;
            box-shadow: 0 3px 8px rgba(255, 77, 79, 0.06);
        }

        .card-img {
            object-fit: cover;
            border-radius: 16px;
        }

        .bookmark-btn {
            width: 38px;
            height: 38px;
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

        .rating i,
        .kalori i {
            font-size: 1.1rem;
        }

        .breadcrumb .text-warning {
            color: #ffaa2c !important;
        }

        .profile-sidebar {
            border: 1.5px solid #e5e8ee;
            background: #fff;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .profile-sidebar {
                margin-bottom: 2rem;
                max-width: 100%;
            }
        }

        /* Animation for hover effects */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }
    </style>
@endpush
