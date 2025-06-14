<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand shadow-lg bg-dark" href="{{ route('dashboard') }}">
      <div class="d-flex align-items-center gap-2">
        <img src="{{ asset('apple-touch-icon.png') }}"height="42" width="42">
        <span style="font-size: 1rem;">Yummy App</span>
      </div>
    </a>

    <div class="sidebar-user mt-3">
      <div class="d-flex gap-2 align-items-center justify-content-center">
        <div class="flex-shrink-0">
          <img height="42" width="42" src="{{ auth()->user()->getProfilePicture() }}"
            class="avatar img-fluid rounded me-1" alt="{{ auth()->user()->name }}">
        </div>
        <div class="flex-grow-1">
          <a class="sidebar-user-title fw-medium" href="{{ route('dashboard.profile.index') }}">
            {{ auth()->user()->name }}
          </a>
          <div class="sidebar-user-subtitle">{{ auth()->user()->username }}</div>
        </div>
      </div>
    </div>

    <ul class="sidebar-nav">
      <li class="sidebar-header">Dashboard</li>
      <li class="sidebar-item {{ Request::route()->named('dashboard') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('dashboard') }}">
          <i class="align-middle ri-lg ri-dashboard-line"></i> <span class="align-middle">Dashboard</span>
        </a>
      </li>

      {{-- Recipe --}}
      <li class="sidebar-header">Recipe</li>
      <li class="sidebar-item {{ Request::route()->named('dashboard.recipe.*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('dashboard.recipe.index') }}">
          <i class="align-middle ri-lg ri-restaurant-line"></i> <span class="align-middle">Recipe</span>
        </a>
      </li>

      @role('admin')
        <li class="sidebar-header">Food</li>
        <li class="sidebar-item {{ Request::route()->named('dashboard.food-ingredient.*') ? 'active' : '' }}">
          <a class="sidebar-link" href="{{ route('dashboard.food-ingredient.index') }}">
            <i class="align-middle ri-lg ri-bowl-line"></i> <span class="align-middle">Food Ingredient</span>
          </a>
        </li>
        <li class="sidebar-item {{ Request::route()->named('dashboard.food-info.*') ? 'active' : '' }}">
          <a class="sidebar-link" href="{{ route('dashboard.food-info.index') }}">
            <i class="align-middle ri-lg ri-info-i"></i> <span class="align-middle">Food Info</span>
          </a>
        </li>
        <li class="sidebar-item {{ Request::route()->named('dashboard.food-tag.*') ? 'active' : '' }}">
          <a class="sidebar-link" href="{{ route('dashboard.food-tag.index') }}">
            <i class="align-middle ri-lg ri-price-tag-3-line"></i> <span class="align-middle">Food Tag</span>
          </a>
        </li>
      @endrole

      {{-- Profile --}}
      <li class="sidebar-header">Profile</li>
      <li class="sidebar-item {{ Request::route()->named('dashboard.profile.*') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('dashboard.profile.index') }}">
          <i class="align-middle ri-lg ri-user-3-line"></i> <span class="align-middle">Profile</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
