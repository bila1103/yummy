@php $paginatorArr = $paginator->toArray(); @endphp
@if ($paginator->hasPages())
  <nav class="d-flex gap-2 justify-content-center justify-content-lg-between align-items-center"
    aria-label="Page navigation example">
    <div class="d-none d-lg-block">
      <p class="small text-muted mb-0">Showing
        <span class="fw-semibold">{{ $paginatorArr['from'] }}</span> to
        <span class="fw-semibold">{{ $paginatorArr['to'] }}</span> of
        <span class="fw-semibold">{{ $paginatorArr['total'] }}</span> results
      </p>
    </div>

    <ul class="pagination mb-0">
      @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-label="Previous" aria-disabled="true">
          <a href="javascript:void(0)" class="page-link">
            <i class="ri-arrow-left-s-line"></i>
            <span class="d-inline d-md-none">Previous</span>
          </a>
        </li>
      @else
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous" rel="prev">
            <i class="ri-arrow-left-s-line"></i>
            <span class="d-inline d-md-none">Previous</span>
          </a>
        </li>
      @endif

      @foreach ($elements as $element)
        @if (is_string($element))
          <li class="page-item d-none d-md-block disabled">
            <span class="page-link">{{ $element }}</span>
          </li>
        @endif
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li class="page-item d-none d-md-block active" aria-current="page">
                <a href="javascript:void(0)" class="page-link fw-bold">{{ $page }}</a>
              </li>
            @else
              <li class="page-item d-none d-md-block"><a class="page-link"
                  href="{{ $url }}">{{ $page }}</a></li>
            @endif
          @endforeach
        @endif
      @endforeach

      @if ($paginator->hasMorePages())
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
            <span class="d-inline d-md-none">Next</span>
            <i class="ri-arrow-right-s-line"></i>
          </a>
        </li>
      @else
        <li class="page-item disabled" aria-disabled="true">
          <a class="page-link" href="javascript:void(0)">
            <span class="d-inline d-md-none">Next</span>
            <i class="ri-arrow-right-s-line"></i>
          </a>
        </li>
      @endif
    </ul>
  </nav>
@endif
