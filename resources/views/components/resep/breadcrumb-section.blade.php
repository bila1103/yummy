<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb bg-transparent p-0">
        <li class="breadcrumb-item"><a href="" class="text-warning fw-semibold">Home</a></li>
        <li class="breadcrumb-item"><a href="" class="text-warning fw-semibold">{{ $breadcrumbs['sub'] }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumbs['title'] }}</li>
    </ol>
</nav>

<div class="description">
  <div class="recipe-title fw-bold mb-3">
    {{ $breadcrumbs['title'] }}
  </div>
  <p>{{ $breadcrumbs['description'] }}</p>
</div>