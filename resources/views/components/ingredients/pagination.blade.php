{{-- Pagination Component --}}
@props(['currentPage' => 1, 'totalPages' => 12, 'url' => '#'])

<section class="pagination-section py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <nav aria-label="Page navigation" class="custom-pagination">
                    <ul class="pagination pagination-custom mb-0">
                        {{-- Previous Button --}}
                        <li class="page-item {{ $currentPage <= 1 ? 'disabled' : '' }}">
                            <a class="page-link page-link-prev"
                                href="{{ $currentPage > 1 ? $url . '?page=' . ($currentPage - 1) : '#' }}"
                                aria-label="Previous" {{ $currentPage <= 1 ? 'tabindex=-1 aria-disabled=true' : '' }}>
                                <i class="ri-arrow-left-s-line"></i>
                            </a>
                        </li>

                        {{-- First Page --}}
                        @if ($currentPage > 3)
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}?page=1">1</a>
                            </li>
                            @if ($currentPage > 4)
                                <li class="page-item disabled">
                                    <span class="page-link page-dots">...</span>
                                </li>
                            @endif
                        @endif

                        {{-- Page Numbers --}}
                        @php
                            $start = max(1, $currentPage - 2);
                            $end = min($totalPages, $currentPage + 2);
                        @endphp

                        @for ($i = $start; $i <= $end; $i++)
                            <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                <a class="page-link"
                                    href="{{ $url }}?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Last Page --}}
                        @if ($currentPage < $totalPages - 2)
                            @if ($currentPage < $totalPages - 3)
                                <li class="page-item disabled">
                                    <span class="page-link page-dots">...</span>
                                </li>
                            @endif
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $url }}?page={{ $totalPages }}">{{ $totalPages }}</a>
                            </li>
                        @endif

                        {{-- Next Button --}}
                        <li class="page-item {{ $currentPage >= $totalPages ? 'disabled' : '' }}">
                            <a class="page-link page-link-next"
                                href="{{ $currentPage < $totalPages ? $url . '?page=' . ($currentPage + 1) : '#' }}"
                                aria-label="Next"
                                {{ $currentPage >= $totalPages ? 'tabindex=-1 aria-disabled=true' : '' }}>
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <style>
        .pagination-section {
            background: transparent;
        }

        .custom-pagination .pagination-custom {
            gap: 8px;
            justify-content: center;
            align-items: center;
        }

        .custom-pagination .page-item {
            margin: 0;
        }

        .custom-pagination .page-link {
            border: none;
            background: #f8f9fa;
            color: #6c757d;
            font-weight: 500;
            font-size: 1rem;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .custom-pagination .page-link:hover {
            background: #ffaa2c;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 170, 44, 0.3);
        }

        .custom-pagination .page-link:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 170, 44, 0.25);
            background: #ffaa2c;
            color: #fff;
        }

        .custom-pagination .page-item.active .page-link {
            background: #ffaa2c;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(255, 170, 44, 0.3);
            transform: translateY(-1px);
        }

        .custom-pagination .page-item.active .page-link:hover {
            background: #e89929;
            transform: translateY(-2px);
        }

        .custom-pagination .page-item.disabled .page-link {
            background: #e9ecef;
            color: #adb5bd;
            cursor: not-allowed;
            pointer-events: none;
        }

        .custom-pagination .page-item.disabled .page-link:hover {
            background: #e9ecef;
            color: #adb5bd;
            transform: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }

        .custom-pagination .page-link-prev,
        .custom-pagination .page-link-next {
            background: #fff;
            border: 2px solid #e9ecef;
            color: #6c757d;
        }

        .custom-pagination .page-link-prev:hover,
        .custom-pagination .page-link-next:hover {
            background: #ffaa2c;
            border-color: #ffaa2c;
            color: #fff;
        }

        .custom-pagination .page-link-prev i,
        .custom-pagination .page-link-next i {
            font-size: 1.2rem;
            line-height: 1;
        }

        .custom-pagination .page-dots {
            background: transparent !important;
            color: #6c757d;
            cursor: default;
            pointer-events: none;
            box-shadow: none !important;
            font-weight: 600;
        }

        .custom-pagination .page-dots:hover {
            background: transparent !important;
            color: #6c757d;
            transform: none;
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .custom-pagination .page-link {
                width: 36px;
                height: 36px;
                font-size: 0.9rem;
            }

            .custom-pagination .pagination-custom {
                gap: 4px;
            }
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

        .custom-pagination .page-item.active .page-link::before {
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced pagination functionality
            const paginationLinks = document.querySelectorAll('.custom-pagination .page-link');

            // Add click effects
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Don't prevent default for actual navigation
                    if (!this.closest('.page-item').classList.contains('disabled') &&
                        !this.closest('.page-item').classList.contains('active')) {

                        // Add a small loading state
                        this.style.opacity = '0.7';
                        this.style.transform = 'scale(0.95)';

                        // Reset after short delay (for visual feedback)
                        setTimeout(() => {
                            this.style.opacity = '';
                            this.style.transform = '';
                        }, 150);
                    }
                });

                // Add hover sound effect (optional)
                link.addEventListener('mouseenter', function() {
                    if (!this.closest('.page-item').classList.contains('disabled')) {
                        this.style.transform = 'translateY(-2px) scale(1.05)';
                    }
                });

                link.addEventListener('mouseleave', function() {
                    if (!this.closest('.page-item').classList.contains('active')) {
                        this.style.transform = '';
                    }
                });
            });

            // Keyboard navigation support
            document.addEventListener('keydown', function(e) {
                const currentPage = parseInt(document.querySelector('.page-item.active .page-link')
                    ?.textContent || '1');
                const totalPages = 12; // You can make this dynamic

                if (e.ctrlKey || e.metaKey) {
                    switch (e.key) {
                        case 'ArrowLeft':
                            e.preventDefault();
                            if (currentPage > 1) {
                                const prevLink = document.querySelector('.page-link-prev');
                                if (prevLink && !prevLink.closest('.page-item').classList.contains(
                                        'disabled')) {
                                    prevLink.click();
                                }
                            }
                            break;
                        case 'ArrowRight':
                            e.preventDefault();
                            if (currentPage < totalPages) {
                                const nextLink = document.querySelector('.page-link-next');
                                if (nextLink && !nextLink.closest('.page-item').classList.contains(
                                        'disabled')) {
                                    nextLink.click();
                                }
                            }
                            break;
                        case 'Home':
                            e.preventDefault();
                            const firstPageLink = document.querySelector('.page-link[href*="page=1"]');
                            if (firstPageLink) {
                                firstPageLink.click();
                            }
                            break;
                        case 'End':
                            e.preventDefault();
                            const lastPageLink = document.querySelector(
                                `.page-link[href*="page=${totalPages}"]`);
                            if (lastPageLink) {
                                lastPageLink.click();
                            }
                            break;
                    }
                }
            });

            // URL update function for AJAX pagination (optional)
            window.updatePaginationUrl = function(newUrl) {
                const paginationLinks = document.querySelectorAll('.custom-pagination .page-link');
                paginationLinks.forEach(link => {
                    const href = link.getAttribute('href');
                    if (href && href !== '#') {
                        const url = new URL(href, window.location.origin);
                        const page = url.searchParams.get('page');
                        if (page) {
                            link.setAttribute('href', `${newUrl}?page=${page}`);
                        }
                    }
                });
            };

            // Smooth scroll to top when page changes (optional)
            paginationLinks.forEach(link => {
                if (!link.closest('.page-item').classList.contains('disabled') &&
                    !link.closest('.page-item').classList.contains('active')) {

                    link.addEventListener('click', function(e) {
                        // Only for same-page navigation
                        if (this.getAttribute('href').includes(window.location.pathname)) {
                            setTimeout(() => {
                                window.scrollTo({
                                    top: 0,
                                    behavior: 'smooth'
                                });
                            }, 100);
                        }
                    });
                }
            });
        });
    </script>
@endpush
