<nav class="navbar navbar-expand navbar-light navbar-bg">
  <a class="sidebar-toggle js-sidebar-toggle">
    <i class="hamburger align-self-center"></i>
  </a>

  <div class="navbar-collapse collapse text-light">
    <ul class="navbar-nav navbar-align">
      <li class="nav-item dropdown">
        <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
          <i class="align-middle" data-feather="settings"></i>
        </a>

        <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
          <img src="{{ auth()->user()->getProfilePicture() }}"
            class="avatar img-fluid rounded-2 me-1 shadow rounded-pill" />
          <span class="d-none">{{ auth()->user()->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-end rounded">
          <a class="dropdown-item" href="{{ route('dashboard.profile.index') }}">
            <i class="align-middle me-1 text-dark" data-feather="user"></i>
            <span class="text-dark">Profile</span>
          </a>
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="dropdown-item text-danger">
              <i class="align-middle me-1" data-feather="log-out"></i> Log out
            </button>
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>
