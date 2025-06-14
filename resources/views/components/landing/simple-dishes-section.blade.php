<section class="simple-dishes-section py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">Masakan Sederhana</h2>
            <a href="{{ route('kategori', 'cemilan-sederhana') }}" class="view-all text-decoration-none">Lihat Semua <i class="ri ri-arrow-right-line"></i></a>
        </div>

        <div class="splide simple-dishes-slider">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($simpleDishes as $dish)
                    <li class="splide__slide">
                        <div class="card recipe-card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-0 pt-3 pb-0 px-3">
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2">
                                        <img loading="lazy" src="{{ $dish->user['avatar'] }}" alt="{{ $dish->user['name'] }}" class="rounded-circle" width="40">
                                    </div>
                                    <div class="user-name">{{ $dish->user['name'] }}</div>
                                    @if($dish->user['is_verified'])
                                    <div class="ms-auto verified">
                                        <i class="ri-verified-badge-fill text-primary"></i>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="recipe-image position-relative mb-3">
                                    <img loading="lazy" src="{{ $dish['image'] }}" alt="{{ $dish['title'] }}" class="card-img rounded">
                                </div>
                                <h5 class="recipe-title">{{ $dish['title'] }}</h5>
                                
                                <div class="recipe-meta d-flex align-items-center mt-2">
                                    <div class="rating me-auto">
                                        <i class="ri-star-fill text-warning"></i>
                                        <span class="rating-value">({{ $dish['rating'] }})</span>
                                    </div>
                                    <div class="cooking-time">
                                        <i class="ri-time-fill text-secondary"></i>
                                        <span>{{ $dish['cooking_time'] }} menit</span>
                                    </div>
                                </div>
                                
                                <div class="recipe-actions d-flex align-items-center mt-3">
                                    <div class="recipe-views me-auto">
                                        <i class="ri-eye-fill"></i>
                                        <span>{{ $dish['visited_count'] }}</span>
                                    </div>
                                    <button class="btn btn-light bookmark-btn">
                                        <i class="ri-bookmark-line"></i>
                                    </button>
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
    .simple-dishes-section {
        background-color: #f8f9fa;
        padding-bottom: 2rem;
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
    }
    
    .recipe-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    .user-avatar img {
        width: 40px;
        height: 40px;
        object-fit: cover;
    }
    
    .user-name {
        font-weight: 500;
        font-size: 0.95rem;
        color: #333;
    }
    
    .verified i {
        color: #007bff;
        font-size: 1.1rem;
    }
    
    .recipe-image {
        overflow: hidden;
        border-radius: 8px;
    }
    
    .recipe-image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s;
    }
    
    .recipe-card:hover .recipe-image img {
        transform: scale(1.05);
    }
    
    .recipe-watermark {
        position: absolute;
        bottom: 10px;
        right: 10px;
        opacity: 0.7;
        width: 70px;
    }
    
    .recipe-watermark img {
        width: 100%;
        height: auto;
    }
    
    .recipe-title {
        font-weight: 600;
        font-size: 1.1rem;
        color: #333;
        height: 2.2rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    .recipe-meta {
        font-size: 0.85rem;
    }
    
    .rating i {
        color: #ffc107;
        margin-right: 3px;
    }
    
    .cooking-time {
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .gallery-thumbs {
        display: flex;
        margin-right: 5px;
    }
    
    .gallery-thumb {
        width: 25px;
        height: 25px;
        object-fit: cover;
        margin-right: -8px;
        border: 1px solid white;
    }
    
    .gallery-more {
        font-size: 0.75rem;
        color: #6c757d;
    }
    
    .recipe-views {
        color: #6c757d;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 5px;
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
        
        .recipe-image img {
            height: 180px;
        }
        
        .recipe-title {
            font-size: 1rem;
            height: 2rem;
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
        new Splide('.simple-dishes-slider', {
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