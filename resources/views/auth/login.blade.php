<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistem Manajemen Keamanan Informasi">
  <meta name="ip" content="{{  $_SERVER['REMOTE_ADDR'] }}">
  <meta name="author" content="Digital Amore Kriyanesia">
  <title>SMKI PERBARINDO</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/png">
  <!-- Fonts -->
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.1.0') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css?v=1.1.0') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
  {{-- google recaptcha v2 --}}
  @if (env('RECAPTCHA'))
    <script src='https://www.google.com/recaptcha/api.js'></script>
  @endif
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

    .height-responsive{
      min-height: 25vh;
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

      .height-responsive{
        min-height: 50vh;
      }
    }
  </style>
</head>

<body style="background-color: rgb(243 244 246)">
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
            <polygon style="fill: rgb(243 244 246)" points="2560 0 2560 100 0 100"></polygon>
          </svg>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container pb-5">
      <div class="row justify-content-center">
        <div class="col-md-11">
          <div class="card bg-secondary border-0 mb-0 overflow-hidden">
            <div class="card-body row" style="margin: 0; padding: 0; overflow: hidden">
              {{-- IMFORMASI --}}
              <div class="col-md-6 px-lg-5 py-lg-5 position-relative height-responsive" style="background-color: #00a54f">
                <div>
                  <header class="text-lg-right text-center text-white"><h1 class="text-white font-weight-bold">Sistem Manajemen Keamanan Informasi</h1></header>
                  <p class="text-lg-right text-center text-white">Sharing Bandwidth Perbarindo</p>
                  <div class="position-absolute bottom-0 right-0 py-lg-5 py-1 px-3 px-lg-5">
                    <span class="text-muted text-light">ISO 27001:2022</span>
                  </div>
                </div>
              </div>
              {{-- LOGIN --}}
              <div class="px-lg-5 py-lg-5 col-md-6">
                <div class="text-center">
                  <img src="{{ asset('img/logo_perbarindo-1.png') }}" class="navbar-brand-img" alt="Perbarindo">
                </div>
                <div class="text-center text-muted mb-3">
                </div>
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{session('error')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @endif
                @error('login_failed')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <span class="alert-inner--text"><strong>Warning!</strong> {{ $message }}</span>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                @enderror
                <form role="form" method="post" action="{{ route('auth.login_process') }}" id="form-login">
                  {{ csrf_field() }}
                  <input type="hidden" class="form-control" id="ipz" name="ip_address">
                  <div class="form-group mb-3">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                      </div>
                      <input class="form-control text-responsive" name="username" placeholder="Username" type="text">
                    </div>
                    @if($errors->has('username'))
                    <span class="text-danger text-sm">{{ $errors->first('username') }}</span>
                    @endif
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                      <div class="input-group-append">
                        <span class="input-group-text" id="showPasswordToggle">
                          <i class="far fa-eye"></i>
                        </span>
                      </div>
                    </div>
                    @if($errors->has('password'))
                    <span class="text-danger text-sm">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                  @if(env('RECAPTCHA'))
                  <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                    @if ($errors->has('g-recaptcha-response'))
                    <span class="text-danger text-sm">{{ $errors->first('g-recaptcha-response') }}</span>
                    @endif
                  </div>
                  @endif
                  <div class="text-center">
                    <button type="submit" class="btn btn-block btn-success my-4 position-relative" id="btn-submit">
                      MASUK
                    </button>
                  </div>
                </form>
              </div>
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
        <div class="col-xl-7" style="">
          <div class="copyright text-center text-lg-right text-muted">
            {{-- Detail Footer --}}
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script>
     document.getElementById('showPasswordToggle').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    });
  </script>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('assets/js/argon.js?v=1.1.0') }}"></script>
  <!-- Demo JS - remove this in your project -->
  {{-- <script src="{{ asset('assets/js/demo.min.js') }}"></script> --}}

  <script>
    $('#form-login').submit(function(event) {
      event.preventDefault();

      $('#btn-submit').attr('disabled', 'disabled');
      $('#btn-submit').html(`
        <i class="fas fa-circle-notch spinner"></i> SEDANG PROSES ...
      `);
      $('#form-login').off('submit').submit();
    });
  </script>
</body>

</html>
