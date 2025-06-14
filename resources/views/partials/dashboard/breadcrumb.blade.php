@if (isset($breadcrumbs))
  <div>
    <h1 class="h4 mb-2 text-dark fw-medium">{{ $title ?? '' }}</h1>
    @if (count($breadcrumbs) > 1)
      <ul class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
          <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}" style="font-size: .83rem;">
            @if (isset($breadcrumb['url']) && !$loop->last)
              <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
            @else
              {{ $breadcrumb['label'] }}
            @endif
          </li>
        @endforeach
      </ul>
    @endif
  </div>
@endif
