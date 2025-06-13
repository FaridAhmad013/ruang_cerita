<!-- Hero -->
<div class="p-5 text-center bg-image rounded-3" style="
    background-image: url('{{ asset('assets/img/theme/wallpaper-3.jpg') }}');
    background-size: cover;
    background-position: inherit;
    background-repeat: no-repeat;
    height: 650px;
  ">
  {{-- <div class="mask"> --}}
  <div class="mask" style="background-color: rgba(0, 0, 0, 0.1);">
    <div class="d-flex justify-content-center align-items-center h-100">
      <div class="text-white">
        <h1 class="mb-3 font-lora hero-title"></h1>
        <h2 class="mb-3 font-lora hero-subtitle"></h2>
        <a data-mdb-ripple-init class="btn btn-default btn-lg" href="{{ route('dashboard.index')}}" role="button">Coba Sekarang</a>
      </div>
    </div>
  </div>
</div>
<!-- Hero -->
