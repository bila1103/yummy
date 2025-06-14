<section class="all-recipes-section py-4 container-fluid">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-transparent p-0 small">
            <li class="breadcrumb-item"><a href="#" class="text-warning">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Semua Resep</li>
        </ol>
    </nav>
    
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <h4 class="fw-bold mb-3 mb-md-0">Semua Resep</h4>
                <div class="recipe-search-form">
                    <form action="{{ route('all.recipes') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control filter-search-input" 
                                placeholder="Cari resep..."
                                value="{{ request()->get('search') }}"
                                style="border-radius: 12px 0 0 12px;">
                            <button type="submit" class="btn btn-warning" style="border-radius: 0 12px 12px 0;">
                                <i class="ri-search-line"></i>
                            </button>
                        </div>
                        
                        @if(request()->has('search') && !empty(request()->get('search')))
                            <a href="{{ route('all.recipes') }}" class="btn btn-outline-secondary ms-2">
                                <i class="ri-close-line"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>
            </div>
            
            @if(request()->has('search') && !empty(request()->get('search')))
                <div class="search-result-info mt-2">
                    <p class="text-muted">Menampilkan hasil pencarian untuk: "{{ request()->get('search') }}"</p>
                </div>
            @endif
        </div>
    </div>
    
    @if($recipes->isEmpty())
        <div class="text-center py-5">
            <img src="{{ asset('assets/search-notfound.png') }}" alt="No results found" class="img-fluid mb-3" style="max-width: 250px;">
            <h4 class="mt-3">Tidak ada hasil</h4>
            <p class="text-muted">Tidak ada resep yang cocok dengan pencarian Anda</p>
        </div>
    @else
        <!-- All Recipes Grid -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
            @foreach($recipes as $recipe)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 recipe-card">
                        <div class="position-relative">
                            <img src="{{ $recipe->image }}" class="card-img-top card-img" alt="{{ $recipe->title }}" loading="lazy"
                                style="height: 180px; object-fit: cover; border-radius: 16px 16px 0 0;">
                                
                            @if($recipe->premium_content)
                                <span class="position-absolute top-0 start-0 mt-2 ms-2 badge-tes">Premium</span>
                            @endif
                        </div>
                        
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="rating me-2">
                                    <i class="ri-star-fill text-warning"></i> 
                                    <span>{{ number_format($recipe->rating, 1) }}</span>
                                </div>
                                <div class="kalori ms-auto">
                                    <i class="ri-fire-fill text-danger"></i> 
                                    <span>{{ $recipe->calories ?? '-' }} Kcal</span>
                                </div>
                            </div>
                            
                            <h5 class="card-title mb-2">
                                <a href="{{ route('detail', $recipe->slug) }}" class="text-dark text-decoration-none">
                                    {{ $recipe->title }}
                                </a>
                            </h5>
                            
                            <div class="d-flex align-items-center">
                                <img src="{{ $recipe->user->avatar ?? asset('assets/default-avatar.png') }}" 
                                     class="rounded-circle me-2" 
                                     width="24" height="24" 
                                     alt="{{ $recipe->user->name }}" loading="lazy">
                                     
                                <a href="{{ route('user.recipes', $recipe->user->username) }}" class="small text-muted text-decoration-none">
                                    {{ $recipe->user->name }}
                                </a>
                                
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
            {{ $recipes->withQueryString()->links('components.user-recipes.pagination-custom') }}
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

    /* Recipe Card Styles */
    .recipe-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .recipe-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
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
        border-radius: 16px 16px 0 0;
    }

    .rating i,
    .kalori i {
        font-size: 1.1rem;
    }
    
    /* Responsive search form */
    @media (max-width: 768px) {
        .recipe-search-form {
            width: 100%;
            margin-top: 1rem;
        }
    }
</style>
@endpush