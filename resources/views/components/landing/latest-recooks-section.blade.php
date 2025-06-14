@php
    $recooks = [
        [
            'avatar' => 'https://picsum.photos/seed/avatar1/50',
            'user' => 'Dapur Mama Lia',
            'image' => 'https://picsum.photos/seed/recook1/600/400',
            'difficulty' => 'Simpel',
            'rating' => 'Mantap',
            'comment' => 'Resepnya enak banget, jadi favorit keluarga!',
            'source' => 'Ayam Kecap Pedas Manis',
            'liked' => true,
            'likes' => 3,
        ],
        [
            'avatar' => 'https://picsum.photos/seed/avatar2/50',
            'user' => 'Chef Andra',
            'image' => 'https://picsum.photos/seed/recook2/600/400',
            'difficulty' => 'Sedang',
            'rating' => 'Lezat',
            'comment' => 'Masakan ini cocok buat makan siang, thanks resepnya!',
            'source' => 'Soto Betawi',
            'liked' => false,
            'likes' => 0,
        ],
        [
            'avatar' => 'https://picsum.photos/seed/avatar3/50',
            'user' => 'Foodie Rani',
            'image' => 'https://picsum.photos/seed/recook3/600/400',
            'difficulty' => 'Susah',
            'rating' => 'Luar biasa',
            'comment' => 'Ribet tapi worth it banget hasilnya enak maksimal!',
            'source' => 'Rendang Minang Autentik',
            'liked' => true,
            'likes' => 5,
        ],
        [
            'avatar' => 'https://picsum.photos/seed/avatar4/50',
            'user' => 'Koki Cinta',
            'image' => 'https://picsum.photos/seed/recook4/600/400',
            'difficulty' => 'Simpel',
            'rating' => 'Enak',
            'comment' => 'Resepnya mudah diikuti, hasilnya enak banget!',
            'source' => 'Nasi Goreng Spesial',
            'liked' => false,
            'likes' => 1,
        ],
        [
            'avatar' => 'https://picsum.photos/seed/avatar5/50',
            'user' => 'Dapoer Kita',
            'image' => 'https://picsum.photos/seed/recook5/600/400',
            'difficulty' => 'Sedang',
            'rating' => 'Mantap',
            'comment' => 'Rasa dan bumbunya pas, enak banget!',
            'source' => 'Ayam Penyet',
            'liked' => true,
            'likes' => 2,
        ],
    ];
@endphp

<section class="latest-recooks-section py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title mb-0">Recook Terbaru</h2>
            <a href="#" class="view-all text-decoration-none">Lihat Semua <i class="ri ri-arrow-right-line"></i></a>
        </div>

        <div class="splide latest-recooks-slider">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($recooks as $recook)
                    <li class="splide__slide">
                        <div class="card recook-card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="user-avatar me-2">
                                        <img src="{{ $recook['avatar'] }}" alt="{{ $recook['user'] }}" class="rounded-circle" width="50" height="50">
                                    </div>
                                    <h5 class="user-name mb-0">{{ $recook['user'] }}</h5>
                                </div>

                                <div class="recook-image mb-3">
                                    <img src="{{ $recook['image'] }}" alt="Recipe Image" class="img-fluid rounded">
                                </div>

                                <div class="recook-meta d-flex mb-3">
                                    <div class="difficulty me-4">
                                        <div class="d-flex align-items-center">
                                            <i class="ri-bowl-line me-1 text-secondary"></i>
                                            <span class="text-secondary">Pembuatan Resep</span>
                                        </div>
                                        <strong>{{ $recook['difficulty'] }}</strong>
                                    </div>
                                    <div class="rating">
                                        <div class="d-flex align-items-center">
                                            <i class="ri-star-fill me-1 text-secondary"></i>
                                            <span class="text-secondary">Penilaian Resep</span>
                                        </div>
                                        <strong>{{ $recook['rating'] }}</strong>
                                    </div>
                                </div>

                                <p class="recook-comment mb-2">{{ $recook['comment'] }}</p>

                                <div class="recook-source d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <div class="text-secondary small">Sumber Resep</div>
                                        <strong>{{ $recook['source'] }}</strong>
                                    </div>
                                    <div class="like-count d-flex align-items-center">
                                        <button class="btn like-btn {{ $recook['liked'] ? 'active' : '' }}">
                                            <i class="bi {{ $recook['liked'] ? 'ri-thumb-up-fill' : 'ri-thumb-up-line' }}"></i>
                                        </button>
                                        @if ($recook['likes'] > 0)
                                            <span class="ms-1">{{ $recook['likes'] }}</span>
                                        @endif
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

    <div class="scroll-to-top">
        <button class="btn rounded-circle shadow">
            <i class="ri-arrow-up-line"></i>
        </button>
    </div>
</section>


@push('styles')
<style>
    .latest-recooks-section {
        background-color: #f8f9fa;
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
    
    .recook-card {
        transition: transform 0.3s, box-shadow 0.3s;
        background-color: #ffffff;
        margin: 0 5px;
        height: 100%;
    }
    
    .recook-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    .user-avatar img {
        width: 40px;
        height: 40px;
        object-fit: cover;
    }
    
    .user-name {
        font-size: 1rem;
        font-weight: 500;
        color: #333;
    }
    
    .recook-image {
        border-radius: 8px;
        overflow: hidden;
    }
    
    .recook-image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s;
    }
    
    .recook-card:hover .recook-image img {
        transform: scale(1.05);
    }
    
    .recook-meta {
        font-size: 0.85rem;
    }
    
    .recook-meta strong {
        display: block;
        font-size: 0.9rem;
        color: #333;
    }
    
    .recook-comment {
        color: #333;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }
    
    .read-more {
        color: #ff8a00;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .like-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #f0f0f0;
        color: #666;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        transition: all 0.2s;
    }
    
    .like-btn:hover, .like-btn.active {
        background-color: #e6f4ff;
        color: #007bff;
    }
    
    .like-btn.active {
        color: #007bff;
    }
    
    .like-count {
        display: flex;
        align-items: center;
    }
    
    .like-count span {
        margin-left: 5px;
        color: #666;
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
    
    .scroll-to-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 999;
    }

    .scroll-to-top button {
        width: 45px;
        height: 45px;
        background-color: #ff8a00;
        color: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .scroll-to-top button:hover {
        background-color: #e67e00;
        transform: translateY(-3px);
    }
    
    @media (max-width: 767.98px) {
        .section-title {
            font-size: 1.5rem;
        }
        
        .recook-image img {
            height: 180px;
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
        new Splide('.latest-recooks-slider', {
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
        
        // Scroll to top button functionality
        const scrollToTopBtn = document.querySelector('.scroll-to-top button');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.style.opacity = '1';
            } else {
                scrollToTopBtn.style.opacity = '0';
            }
        });
        
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Initially hide the button
        scrollToTopBtn.style.opacity = '0';
        
        // Like button functionality
        const likeButtons = document.querySelectorAll('.like-btn');
        likeButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');
                
                if (this.classList.contains('active')) {
                    this.innerHTML = '<i class="ri-thumb-up-line"></i>';
                    
                    // If there's a count next to the button, increment it
                    const countSpan = this.nextElementSibling;
                    if (countSpan && countSpan.tagName === 'SPAN') {
                        countSpan.textContent = parseInt(countSpan.textContent) + 1;
                    }
                } else {
                    this.innerHTML = '<i class="ri-thumb-up-fill"></i>';
                    
                    // If there's a count next to the button, decrement it
                    const countSpan = this.nextElementSibling;
                    if (countSpan && countSpan.tagName === 'SPAN') {
                        const currentCount = parseInt(countSpan.textContent);
                        countSpan.textContent = currentCount > 0 ? currentCount - 1 : 0;
                    }
                }
            });
        });
    });
</script>
@endpush
