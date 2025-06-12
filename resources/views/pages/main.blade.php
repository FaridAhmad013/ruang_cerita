<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Ruang Cerita by Farid Ahmad Fadhilah">
  <meta name="author" content="Farid Ahmad Fadhilah">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Ruang Cerita</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/png">
  <!-- Fonts -->
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
  <!-- Page plugins -->
  <style>
    @keyframes example {
        0%   {background-color: red;}
        25%  {background-color: yellow;}
        50%  {background-color: blue;}
        100% {background-color: green;}
    }

  </style>
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/vendor/datatable-extensions/fixedColumns.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
  <!-- Custom css -->
  <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('assets/vendor/wizard/bd-wizard.css') }}"> -->
  <!-- <link rel="stylesheet" href="{{ asset('assets/vendor/wizard/materialdesignicons.min.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('css/apexcharts/apexcharts.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
  <!-- Custom wizard css -->
  <link rel="stylesheet" href="{{ asset('assets/wizard/css/bd-wizard.css') }}">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.1.0') }}" type="text/css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css?'.date('Ym')) }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/datatables-searchbuilder.min.css') }}" type="text/css">
  {{-- Date CSS --}}
  <link href="{{ asset('assets/vendor/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/flatpickr/material_blue.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/flatpickr/monthSelect.css') }}" rel="stylesheet">

  {{-- Noty --}}
  <link href="{{ asset('assets/vendor/noty/noty.css') }}" rel="stylesheet">
  <link href="{{ asset('fonts/lexend_deca.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  {{-- check app debug false --}}
  @if(config('app.debug') == false)
    @laravelPWA
  @endif
  <script>
    var base_url = "{{ url('').'/' }}"
  </script>
</head>

<body style="background-color: #fff">

  <!-- Main content -->
  <div class="main-content" id="panel">

    @include('pengguna.navbar')

    <div class="position-relative">
      @include('pengguna.hero')
    </div>
    <!-- Page content -->
    <div class="container-fluid mt-3">

      <section class="container">
        <div class="p-3 position-relative">
          <div class="position-absolute left-0 top-0" style="z-index: 1;">
            <img class="jedag-jedug" src="{{ asset('assets/img/theme/question-2.png') }}" style="object-fit: cover; height: 50px; width: 100%" alt="" srcset="">
          </div>
          <div class="card card-new">
            <div class="card-body">
              <h1 class="font-lora font-weight-bold tracking-wide text-center">Bagaimana Caranya?</h1>
              <div class="row justify-content-around mt-3">
                <div class="col-3" data-aos="fade-right" data-aos-duration="800">
                  <img src="{{ asset('assets/img/icons/calendar.png')}}" style="width: 80px; object-fit: cover">
                  <h3 class="leading-relaxed tracking-wide font-lora my-2 font-weight-bold">Sapaan Harian</h3>
                  <p class="leading-relaxed tracking-wide font-lora text-justify">
                    Setiap hari, kamu akan ditemani 10 pertanyaan ringan untuk membantumu memulai cerita.
                  </p>
                </div>
                <div class="col-3" data-aos="fade-up" data-aos-duration="800">
                  <img src="{{ asset('assets/img/icons/chat.png')}}" style="width: 80px; object-fit: cover">
                  <h3 class="leading-relaxed tracking-wide font-lora my-2 font-weight-bold">Tuang Isi Hati</h3>
                  <p class="leading-relaxed tracking-wide font-lora text-justify">
                    Ceritamu adalah milikmu seutuhnya. Kami menjaga privasimu dengan serius. Ruang hatimu aman bersama kami.
                  </p>
                </div>
                <div class="col-3" data-aos="fade-left" data-aos-duration="800">
                  <img src="{{ asset('assets/img/icons/idea.png')}}" style="width: 80px; object-fit: cover">
                  <h3 class="leading-relaxed tracking-wide font-lora my-2 font-weight-bold">Temukan Pola Perasaanmu</h3>
                  <p class="leading-relaxed tracking-wide font-lora text-justify">
                    Dapatkan kesimpulan hangat tentang perasaanmu dan lihat bagaimana mood-mu bertumbuh dari waktu ke waktu.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="container">
        <div class="p-3 position-relative">
          <div class="position-absolute left-0 top-0" style="z-index: 1;">
            <img src="{{ asset('assets/img/theme/lock.png') }}" class="zig-zag" style="object-fit: cover; height: 50px; width: 100%;" alt="" srcset="">
          </div>
          <div class="card card-new">
            <h1 class="font-lora font-weight-bold tracking-wide text-center my-4">Ruang yang Benar-Benar Aman.</h1>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-md-4" data-aos="fade-right" data-aos-duration="800">
                  <div class="card card-new overflow-hidden mt-4">
                    <img class="card-img-top" src="{{ asset('assets/img/theme/chatingan.jpg') }}">
                    <div class="card-body">
                      <b class="card-title text-center d-block">Partner, Bukan Robot.</b>
                      <p class="card-text text-justify leading-relaxed tracking-wide font-lora">
                        AI kami dirancang untuk memahami nuansa perasaanmu. Ia belajar untuk menjadi pendengar yang lebih baik, bukan sekadar program penjawab.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-duration="800">
                  <div class="card card-new overflow-hidden">
                    <img class="card-img-top" src="{{ asset('assets/img/theme/personal-data-2.png') }}">
                    <div class="card-body">
                      <b class="card-title text-center d-block">Privasi Adalah Janji.</b>
                      <p class="card-text text-justify leading-relaxed tracking-wide font-lora">
                        AI kami dirancang untuk memahami nuansa perasaanmu. Ia belajar untuk menjadi pendengar yang lebih baik, bukan sekadar program penjawab.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4" data-aos="fade-left" data-aos-duration="800">
                  <div class="card card-new overflow-hidden mt-4">
                    <img class="card-img-top" src="{{ asset('assets/img/theme/design(2).png') }}">
                    <div class="card-body">
                      <b class="card-title text-center d-block mb-2">Desain yang Menenangkan</b>
                      <p class="card-text text-justify leading-relaxed tracking-wide font-lora">
                        Tidak ada notifikasi yang mengganggu, tidak ada fitur yang membingungkan. Semua dirancang untuk memberimu ketenangan.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <!-- The Modal -->
  <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal_body"></div>
        <div class="modal-footer" id="modal_footer"></div>
      </div>
    </div>
  </div>

  <!-- Fab Button -->
  {{-- <button class="btn btn-fab btn-info" title="Panduan" onclick="Ryuna.helpModal(`{{ isset($help_key) ? $help_key: '' }}`)">
    <i class="fas fa-question"></i>
  </button> --}}

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>

  <!-- Optional JS -->
  <script src="{{ asset('js/jszip.js') }}"></script>
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-block-ui/jquery-block-ui.js') }}"></script>
  <script src="{{ asset('js/autoNumeric.js') }}"></script>
  <script src="{{ asset('js/numeral.js') }}"></script>
  <script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/flatpickr/flatpickr.js') }}"></script>
  <script src="{{ asset('vendor/flatpickr/monthSelect.js') }}"></script>

  <!-- Custom js -->
  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/wizard/jquery.steps.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/wizard/bd-wizard.js') }}"></script>
  <script src="{{ asset('js/apexcharts/apexcharts.js') }}"></script>
  {{-- Noty JS --}}
  <script src="{{ asset('assets/vendor/noty/noty.js') }}" type="text/javascript"></script>
  <!-- Argon JS -->
  <script src="{{ asset('assets/js/argon.js?v=1.1.0') }}"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="{{ asset('assets/js/demo.min.js') }}"></script>
  {{-- Global js --}}
  <script src="{{ asset('js/global.js') }}"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
  <script>
    AOS.init();
    var typed = new Typed('.hero-title', {
      strings: ['Ada hari yang rasanya berat untuk dilewati sendirian?'],
      typeSpeed: 50,
      onComplete: function(self) {
        $('.typed-cursor.typed-cursor--blink').hide()
        new Typed('.hero-subtitle', {
          strings: ['Ruang Cerita adalah ruang aman untuk membantumu mengurai pikiran dan memahami perasaan.'],
          typeSpeed: 50,
          onComplete: function(){
            $('.typed-cursor.typed-cursor--blink').hide()
          }
        });
      }
    });

  </script>
</body>

</html>
