

<nav class="navbar navbar-horizontal navbar-expand-lg navbar-light bg-white">
  <div class="container">
    <a class="navbar-brand font-weight-bold" href="#"><img src="{{ asset('assets/img/icons/ruang-cerita.png') }}" class="navbar-brand-img" alt="..." style="width: 100%;scale:2;object-fit:contain;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-default">
      <div class="navbar-collapse-header">
        <div class="row">
          <div class="col-6 collapse-brand">
            <a href="javascript:void(0)">

            </a>
          </div>
          <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>

      <ul class="navbar-nav ml-lg-auto">
        {{-- <li class="nav-item">
          <a class="nav-link nav-link-icon" href="#">
            <i class="ni ni-favourite-28"></i>
            <span class="nav-link-inner--text d-lg-none">Discover</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-icon" href="#">
            <i class="ni ni-notification-70"></i>
            <span class="nav-link-inner--text d-lg-none">Profile</span>
          </a>
        </li> --}}
        @if ($user)
          <li class="nav-item dropdown">
            <a class="nav-link nav-link-icon" href="#" id="navbar-profile-icon" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-circle"> </i> {{ @$user->nama_depan }} {{ @$user->nama_belakang }}
              <span class="nav-link-inner--text d-lg-none">{{ @$user->nama_depan }} {{ @$user->nama_belakang }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-profile-icon">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link nav-link-icon font-weight-bold" href="{{ route('auth.login') }}">
              Login
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon font-weight-bold" href="{{ route('auth.register') }}">
              Register
            </a>
          </li>
        @endif
      </ul>

    </div>
  </div>
</nav>

