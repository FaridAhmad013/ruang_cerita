<li class="nav-item dropdown">
  <a class="nav-link pr-0 get-saldo" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
    aria-expanded="false">
    <div class="media align-items-center">
      <span>
        @php
          $avatar = asset('img/default-avatar.png');
        @endphp
        <img class="avatar avatar-sm rounded-circle" style="object-fit: cover" alt="Image placeholder"
          src="{{ $avatar }}">
      </span>
      <div class="media-body ml-2 d-none d-lg-block">
        @php
            use App\Helpers\AuthCommon;
            $auth = AuthCommon::user();
        @endphp
        <span class="mb-0 text-sm  font-weight-bold text-white" style="white-space: nowrap">{{ @$auth->nama_depan ?? ' ' }} {{ @$auth->nama_belakang ?? ' ' }}</span>
      </div>
    </div>
  </a>

    <div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-header noti-title">
      <h6 class="text-overflow m-0">Selamat Datang!</h6>
    </div>
    <a href="{{ route('profile.index') }}" class="dropdown-item">
      <i class="ni ni-single-02"></i>
      <span>Profile Saya</span>
    </a>
    <div class="dropdown-divider"></div>
    <a href="{{ route('auth.logout') }}" class="dropdown-item">
      <i class="fas fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </div>
</li>
