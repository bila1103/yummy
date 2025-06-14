@php
    $chunkedRecipes = $recipes->chunk(4);
    $current = 1;
    $total = 9;
    $pages = [];
    if ($total <= 7) {
        for ($i = 1; $i <= $total; $i++) {
            $pages[] = $i;
        }
    } else {
        $pages = [1, 2, 3, '...', $total - 1, $total];
    }
@endphp

<!-- Recipe Cards Grid Section -->
<section class="recipe-card-grid-section py-5">
    <div class="row">
        @foreach ($recipes as $recipe)
            <div class="col-md-6 col-lg-3 mb-4">
                <a href="{{ route('detail', $recipe->slug) }}" class="card border-0 shadow-sm h-100 text-decoration-none">
                    <div class="card-header bg-white border-0 pt-3 pb-0 px-3">
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-2">
                                <img loading="lazy" src="{{ $recipe->user->avatar ?? '/default-avatar.jpg' }}" 
                                     alt="{{ $recipe->user->name ?? 'User' }}"
                                     class="rounded-circle" width="40" height="40" style="object-fit:cover;">
                            </div>
                            <div class="user-name fw-semibold">{{ $recipe->user->name ?? 'Anonymous' }}</div>
                            @if ($recipe->user->is_verified ?? false)
                                <i class="ri-verified-badge-fill text-primary ms-2"></i>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <img loading="lazy" src="{{ $recipe->image ?? '/default-recipe.jpg' }}" 
                             alt="{{ $recipe->title }}"
                             class="card-img rounded mb-2 w-100" style="object-fit:cover;height:180px;">
                        <h5 class="card-title mb-0 mt-2">{{ $recipe->title }}</h5>

                        <div class="recipe-meta d-flex align-items-center mt-2">
                            <div class="rating me-3">
                                <i class="ri-star-fill text-warning"></i>
                                <span class="rating-value">({{ number_format($recipe->rating, 1) }})</span>
                            </div>
                            <div class="cooking-time me-3">
                                <i class="ri-time-fill text-secondary"></i>
                                <span>{{ $recipe->cooking_time }} mnt</span>
                            </div>
                        </div>
                        <div class="recipe-actions d-flex align-items-center mt-3 justify-content-between">
                            <div class="recipe-views">
                                <i class="ri-eye-fill text-secondary"></i> 
                                <span class="recipe-views">{{ $recipe->visited_count ?? 0 }}</span>
                            </div>
                            <button class="btn btn-light bookmark-btn rounded-circle">
                                <i class="ri-bookmark-line"></i>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>

<!-- Pagination Section -->
<section class="recipe-pagination-section mb-5">
    <div class="container d-flex justify-content-center">
        <nav>
            <ul class="custom-pagination d-flex align-items-center list-unstyled m-0 p-0">
                <li>
                    <a class="pagination-arrow {{ $recipes->onFirstPage() ? 'disabled' : '' }}" 
                        href="{{ $recipes->onFirstPage() ? '#' : $recipes->previousPageUrl() }}" tabindex="-1">
                        <i class="ri-arrow-left-line"></i>
                    </a>
                </li>

                @php
                    $start = max($recipes->currentPage() - 2, 1);
                    $end = min($recipes->currentPage() + 2, $recipes->lastPage());
                    if ($recipes->currentPage() <= 3) {
                        $end = min(5, $recipes->lastPage());
                    }
                    if ($recipes->currentPage() > $recipes->lastPage() - 3) {
                        $start = max($recipes->lastPage() - 4, 1);
                    }
                @endphp

                @if($start > 1)
                    <li>
                        <a class="pagination-number" href="{{ $recipes->url(1) }}">1</a>
                    </li>
                    @if($start > 2)
                        <li>
                            <span class="pagination-ellipsis">...</span>
                        </li>
                    @endif
                @endif

                @for($i = $start; $i <= $end; $i++)
                    <li>
                        <a class="pagination-number {{ $recipes->currentPage() == $i ? 'active' : '' }}" 
                           href="{{ $recipes->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if($end < $recipes->lastPage())
                    @if($end < $recipes->lastPage() - 1)
                        <li>
                            <span class="pagination-ellipsis">...</span>
                        </li>
                    @endif
                    <li>
                        <a class="pagination-number" href="{{ $recipes->url($recipes->lastPage()) }}">{{ $recipes->lastPage() }}</a>
                    </li>
                @endif

                <li>
                    <a class="pagination-arrow {{ !$recipes->hasMorePages() ? 'disabled' : '' }}" 
                        href="{{ !$recipes->hasMorePages() ? '#' : $recipes->nextPageUrl() }}">
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>

@push('styles')
    <style>
        .card {
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07) !important;
        }

        .user-avatar img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .gallery-thumb {
            width: 28px;
            height: 28px;
            object-fit: cover;
            margin-right: -8px;
            border: 2px solid #fff;
            background: #fff;
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

        .custom-pagination {
            gap: 18px;
            font-size: 1.1rem;
            user-select: none;
        }

        .custom-pagination .pagination-arrow {
            border: 1px solid #ced6de;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #b1bbc8;
            background: #fff;
            font-size: 1rem;
            transition: box-shadow 0.2s, border-color 0.15s, color 0.15s;
        }

        .custom-pagination .pagination-arrow:not(.disabled):hover {
            box-shadow: 0 3px 8px rgba(255, 152, 0, 0.08);
            color: #ff9800;
            border-color: #ff9800;
        }

        .custom-pagination .pagination-arrow.disabled {
            pointer-events: none;
            color: #ced6de;
            border-color: #ced6de;
            opacity: 0.7;
            background: #fff;
        }

        .custom-pagination .pagination-number {
            color: #222;
            text-decoration: none;
            border: none;
            background: transparent;
            font-weight: 500;
            padding: 0 2px;
            transition: color 0.15s;
            font-size: 1.08rem;
        }

        .custom-pagination .pagination-number.active,
        .custom-pagination .pagination-number:hover {
            color: #ff9800;
            font-weight: 700;
            cursor: pointer;
        }

        .custom-pagination .pagination-ellipsis {
            pointer-events: none;
            color: #888;
            font-size: 1.08rem;
            font-weight: 500;
        }
    </style>
@endpush
