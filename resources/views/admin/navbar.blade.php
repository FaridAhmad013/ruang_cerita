<style>
  .logo-digdaya{
    width: 100%;
    max-width:225px;
  }

  @media (max-width: 768px){
    .logo-digdaya{
      width: 100%;
      max-width:100px;
    }
  }

</style>

<nav class="navbar navbar-top navbar-expand navbar-dark border-bottom bg-primary">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div style="width: 100%;display: flex;">
        <!-- Search form -->
        {{-- @include('admin.searchform') --}}
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center">
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </li>
        </ul>
    </div>
    @include('admin.userbar')

    </div>
  </div>
</nav>
