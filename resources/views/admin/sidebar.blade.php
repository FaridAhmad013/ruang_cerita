<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">

  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header d-flex align-items-center">
      <a class="navbar-brand" style="flex:1" href="{{ route('dashboard.index') }}">
        <img src="{{ asset('img/logo_perbarindo-1.png') }}" class="navbar-brand-img" alt="..."
          style="width: 100%;scale:2;object-fit:contain;">
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
            ->item('Beranda', 'ni ni-tv-2', 'admin/dashboard', Request::is('admin/dashboard'), ['Admin','Admin SMKI', 'Admin Bpr', 'Web Admin Perbarindo', 'Konsultan SMKI'])
            ->end_group();

        $obj_menu
            ->divinder('Master', [
                'Admin',
                'Web Admin SMKI',
                'Admin SMKI',
                'Konsultan SMKI'
            ])
            ->start_group()
            ->item('Kelengkapan Dokumen', 'fas fa-file-alt', route('kelengkapan_dokumen_smki.index'), Request::is('admin/master/kelengkapan_dokumen_smki') ,['Admin', 'Web Admin SMKI', 'Admin SMKI', 'Konsultan SMKI'])
            ->item('Pengajuan Dokumen', 'fas fa-file-upload', route('pengajuan_dokumen.index'), Request::is('admin/master/pengajuan_dokumen') ,['Admin', 'Web Admin SMKI', 'Admin SMKI', 'Konsultan SMKI'])
            ->end_group();

        $obj_menu
            ->divinder('Manajemen', [
                'Admin',
                'Admin SMKI',
                'Admin Bpr',
                'Web Admin Perbarindo',
                'Konsultan SMKI'
            ])
            ->start_group()
            ->item('Kelola Dokumen', 'fas fa-folder-open', route('kelola_dokumen.index'), Request::is('admin/manajemen/kelola_dokumen', 'admin/manajemen/kelola_dokumen/*') , ['Admin Bpr', 'Admin','Admin SMKI', 'Web Admin Perbarindo', 'Konsultan SMKI'])
            ->item('Pengguna', 'fas fa-user', 'admin/manajemen/user', Request::is('admin/manajemen/user', 'admin/manajemen/user/list/trash'), ['Admin', 'Admin SMKI', 'Web Admin Perbarindo', 'Konsultan SMKI'])
            ->end_group();

        $obj_menu
            ->divinder('Otorisasi', [
              'Web Admin Perbarindo',
              'Admin',
              'Admin SMKI',
            ])
            ->start_group()
            ->item('Otorisasi Dokumen', 'fas fa-folder-open', route('otorisasi_dokumen.index'), Request::is('admin/otorisasi/otorisasi_dokumen*') ,['Web Admin Perbarindo', 'Admin', 'Admin SMKI'])
            ->end_group();

        $obj_menu
            ->divinder('Log', [
                'Admin',
                'Admin SMKI',
                'Web Admin Perbarindo',
                'Konsultan SMKI'
            ])
            ->start_group()
            ->item('Aktivitas BPR', 'fas fa-globe', route('log_activity_smki.index'), Request::is('admin/log/activity_smki') ,['Admin','Admin SMKI', 'Web Admin Perbarindo', 'Konsultan SMKI'])
            ->end_group();

        $menu = $obj_menu->to_html();

      @endphp
      {!! $menu !!}
    </div>
  </div>
</nav>
