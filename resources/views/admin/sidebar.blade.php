<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">

  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header d-flex align-items-center">
      <a class="navbar-brand" style="flex:1" href="{{ route('dashboard.index') }}">
        <img src="{{ asset('assets/img/icons/ruang-cerita.png') }}" class="navbar-brand-img" alt="..." style="width: 100%;scale:2;object-fit:contain;">
      </a>
      <div class="ml-auto">
        <!-- Sidenav toggler -->
        <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar-inner">
      @php
        use App\Helpers\Menu;
        $menu = '';

        $obj_menu = new Menu();
        $obj_menu
            ->init()
            ->start_group()
            ->item('Dashboard', 'ni ni-tv-2', 'admin', Request::is('admin'), ['Admin','Pengguna'])
            ->end_group();

        $obj_menu
            ->divinder('Manajemen', [
                'Admin',
            ])
            ->start_group()
            ->item('Pengguna', 'fas fa-user', 'admin/manajemen/user', Request::is('admin/manajemen/user'), ['Admin'])
            ->item('Role', 'fas fa-building', 'admin/manajemen/role', Request::is('admin/manajemen/role'), ['Admin'])
            ->end_group();

        $obj_menu
            ->divinder('Master', [
                'Admin',
            ])
            ->start_group()
            ->item('Kategori Pertanyaan', 'fas fa-th-large', 'admin/master/kategori_pertanyaan', Request::is('admin/master/kategori_pertanyaan'), ['Admin'])
            ->item('Pertanyaan', 'fas fa-comments', 'admin/master/pertanyaan', Request::is('admin/master/pertanyaan'), ['Admin'])
            ->end_group();

        $obj_menu
            ->divinder('Ruang Cerita', [
                'Pengguna',
            ])
            ->start_group()
            ->item('Obrolan', 'fas fa-comments', 'admin/ruang_cerita/obrolan', Request::is('admin/ruang_cerita/obrolan'), ['Pengguna'])
            ->item('Riwayat Obrolan', 'fas fa-history', 'admin/ruang_cerita/riwayat_obrolan', Request::is('admin/ruang_cerita/riwayat_obrolan'), ['Pengguna'])
            ->end_group();

        $menu = $obj_menu->to_html();

      @endphp
      {!! $menu !!}
    </div>
  </div>
</nav>
