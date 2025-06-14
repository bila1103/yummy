@if ($paginator->hasPages())
    <nav aria-label="Page navigation" class="custom-pagination">
        <ul class="pagination pagination-custom mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link page-link-prev" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <i class="ri-arrow-left-s-line"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link page-link-prev" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="ri-arrow-left-s-line"></i>
                    </a>
                </li>
            @endif

            {{-- First Page + Ellipsis --}}
            @if($paginator->currentPage() > 3)
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                </li>
                @if($paginator->currentPage() > 4)
                    <li class="page-item disabled">
                        <span class="page-link page-dots">...</span>
                    </li>
                @endif
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link page-dots">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @php
                            // Only show pages near the current page
                            if ($page < $paginator->currentPage() - 2 || $page > $paginator->currentPage() + 2) {
                                continue;
                            }
                        @endphp
                        
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Last Page + Ellipsis --}}
            @if($paginator->currentPage() < $paginator->lastPage() - 2)
                @if($paginator->currentPage() < $paginator->lastPage() - 3)
                    <li class="page-item disabled">
                        <span class="page-link page-dots">...</span>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-link-next" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="ri-arrow-right-s-line"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link page-link-next" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <i class="ri-arrow-right-s-line"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif

@push('styles')
<style>
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
</style>
@endpush