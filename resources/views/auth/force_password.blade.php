<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Cash Management System">
  <meta name="author" content="Creative Tim">
  <title>CMS BPD DIY</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/png">
  <!-- Fonts -->
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.1.0') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css?v=1.1.0') }}" type="text/css">
  {{-- google recaptcha v2 --}}
  {{-- <script src='https://www.google.com/recaptcha/api.js'></script> --}}
  {{-- google font --}}
  <link href="{{ asset('fonts/lexend_deca.css') }}" rel="stylesheet">
  <style>
    body{
      font-family: 'Lexend Deca', sans-serif !important;
    }
    .container{
      margin-top: -5rem !important;
    }

    .navbar-brand-img{
      width: 100%;
    }

    .footer-img{
      height: 5rem;
    }

    @media (min-width: 768px)
    {
      .container{
        margin-top: -3rem !important;
      }

      .navbar-brand-img{
        width: 100% !important;
        height: auto;
      }

      .footer-img{
        height: auto;
      }
    }
  </style>
</head>

<body class="bg-secondary">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-primary  py-6">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            {{-- <h1 class="text-white">Welcome!</h1> --}}
            </div>
          </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
          <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container pb-5">
      <div class="row justify-content-center">

        <div class="col-md-6">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5" >
              <div class="text-center">
                <img src="{{ asset('img/logo_digdaya_3.png') }}" class="navbar-brand-img" alt="BANK BPD DIY">
              </div>
              <div class="text-center text-muted mb-3">
              </div>

                 @if (session()->has('change_pas'))
                    @include('admin.alert')
                @endif
              <form role="form" method="post" action="{{ route('auth.force_password_process') }}">
                {{ csrf_field() }}
                  <div class="form-group">
                    <label class="text-responsive">Password Baru</label>
                    <div class="input-group input-group-merge" id="newpassword">
                        <input type="password" name="password_baru" class="form-control text-responsive" placeholder="Password Baru" value="" required oninvalid="this.setCustomValidity('Silakan Isi Password Baru Anda')" oninput="setCustomValidity('')">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash input-group-text text-primary" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="text-responsive">Konfirmasi Password Baru</label>
                    <div class="input-group input-group-merge" id="cpassword">
                        <input type="password" name="password_baru_confirmation" class="form-control text-responsive" placeholder="Konfirmasi Password Baru" value="" required oninvalid="this.setCustomValidity('Silakan Isi Konfirmasi Password Baru Anda')" oninput="setCustomValidity('')">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash input-group-text text-primary" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <div id="response_container"></div>


                    @if($errors->any())
                        {!! implode('', $errors->all('<i class="text-danger text-sm">:message</i>')) !!}
                    @endif
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-block btn-primary my-4 text-responsive">Ganti Password</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5" id="">
    <div class="container">
      <div class="row justify-content-xl-between justify-content-center">
        <div class="col-xl-5">
          {{-- <img class="footer-img" src="{{ asset('assets/img/brand/nortod_sample.png') }}" alt=""> --}}
        </div>
        <div class="col-xl-7" style="display: flex;align-items:center;">
          <div class="copyright text-center text-lg-right text-muted">
            {{-- Syarat & Ketentuan --}}
            <span class="text-responsive">Hak Cipta Dilindungi. Hak Cipta © 2023 PT. Bank BPD DIY.</span>
            <span class="text-responsive">Browser yang direkomendasikan adalah Mozilla Firefox 4.0 atau sesudahnya.</span>
            <div>v1.0.52</div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('assets/js/argon.js?v=1.1.0') }}"></script>
  <!-- Demo JS - remove this in your project -->
  {{-- <script src="{{ asset('assets/js/demo.min.js') }}"></script> --}}

      <script>
    $(document).ready(function() {
      $("#newpassword a").on('click', function(event) {
        event.preventDefault();
        if ($('#newpassword input').attr("type") == "text") {
          $('#newpassword input').attr('type', 'password');
          $('#newpassword i').addClass("fa-eye-slash");
          $('#newpassword i').removeClass("fa-eye");
        } else if ($('#newpassword input').attr("type") == "password") {
          $('#newpassword input').attr('type', 'text');
          $('#newpassword i').removeClass("fa-eye-slash");
          $('#newpassword i').addClass("fa-eye");
        }
      });

    });
  </script>

  <script>
    $(document).ready(function() {
      $("#cpassword a").on('click', function(event) {
        event.preventDefault();
        if ($('#cpassword input').attr("type") == "text") {
          $('#cpassword input').attr('type', 'password');
          $('#cpassword i').addClass("fa-eye-slash");
          $('#cpassword i').removeClass("fa-eye");
        } else if ($('#cpassword input').attr("type") == "password") {
          $('#cpassword input').attr('type', 'text');
          $('#cpassword i').removeClass("fa-eye-slash");
          $('#cpassword i').addClass("fa-eye");
        }
      });
    });
  </script>

</body>

</html>
