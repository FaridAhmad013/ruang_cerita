<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Cash Management System">
  <meta name="author" content="Creative Tim">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>SMKI Perbarindo</title>
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

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none !important;
      margin: 0;
    }
    input[type="number"] {
      -moz-appearance: textfield !important;
    }

    body{
      font-family: 'Lexend Deca', sans-serif !important;
    }
    .container{
      margin-top: -5rem !important;
    }

    .navbar-brand-img{
      height: 2rem;
    }

    .footer-img{
      height: 5rem;
    }

    .digit-group input {
      width: 2rem;
      height: 2rem;
      background-color: #ffffff;
      border: solid 1px #000;
      line-height: 50px;
      text-align: center;
      font-size: 24px;
      font-family: "Raleway", sans-serif;
      font-weight: 200;
      color: black;
      margin: 0 2px;
      border-radius: 5px;
      -webkit-appearance: none;
    }

    .digit-group .splitter {
      padding: 0 5px;
      color: black;
      font-size: 24px;
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

      .digit-group input {
        width: 50px;
        height: 50px;
        background-color: #ffffff;
        border: solid 1px #000;
        line-height: 50px;
        text-align: center;
        font-size: 24px;
        font-family: "Raleway", sans-serif;
        font-weight: 200;
        color: black;
        margin: 0 2px;
        border-radius: 5px;
      }

      .card{
        min-height: 50vh
      }

      .min-h-50{
        min-height: 35vh;
      }
    }
  </style>

 <script>
    var base_url = "{{ url('').'/' }}"
  </script>
</head>
<body class="bg-secondary">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-primary  py-4">
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
    <div class="container pb-3">
      <div class="row justify-content-center">
        <div class="col-md-11">
          <div class="card overflow-hidden">
            <div class="card-body row" style="margin: 0; padding: 0">
              {{-- IMFORMASI --}}
              <div class="col-md-6 px-lg-3 py-lg-5 position-relative height-responsive" style="background-color: #00a54f">
                <header class="text-lg-right text-center text-white"><h1 class="text-white font-weight-bold">Sistem Manajemen Keamanan Informasi</h1></header>
                <p class="text-lg-right text-center text-white">Sharing Bandwidth Perbarindo</p>
                <div class="position-absolute bottom-0 right-0 py-lg-5 py-1 px-3 px-lg-3">
                  <span class="text-muted text-light">ISO 27001:2022</span>
                </div>
              </div>
              {{-- LOGIN --}}
              <div class="px-lg-3 py-lg-5 col-md-6">
                <div class="text-center">
                  <img src="{{ asset('img/logo_perbarindo-1.png') }}" class="navbar-brand-img" alt="Perbarindo">
                </div>
                @if(session('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                <form role="form" id="myForm" method="post" action="{{ route('auth.login2Fa_process') }}">
                  {{ csrf_field() }}
                  <input type="hidden" name="bumbu" value="{{ $bumbu }}"><input type="hidden" name="mie" value="{{ $mie }}">
                  @if($data != null)
                  <p>
                    <div class="alert alert-info">Silakan Scan QR dibawah ini dengan aplikasi Google Authenticator</div>
                  </p>
                  <center class="mb-3">{!! QrCode::format('svg')->size(200)->generate($data['qr']) !!}</center>
                  @endif

                  <div id="response_container"></div>
                  <div class="form-group">
                    <label for="totp">Masukan OTP yang muncul dari aplikasi Google Authenticator</label>
                    <div class="input-group">
                      <input type="text" name="totp" id="totp" class="form-control">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-block btn-success text-responsive">Verifikasi</button>
                      </div>
                    </div>
                  </div>

                  @if ($data == null)
                    <div class="alert alert-info">Silakan kirim QR ke email anda, jika web belum tertaut pada Authenticator</div>
                    <button type="button" class="btn btn-block btn-success send_qr_to_email">Kirim QR Ke Email</button>
                  @endif

                  <div class="response_send_qr my-3"></div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <div class="row justify-content-xl-between justify-content-center">
        <div class="col-xl-5">
          {{-- <img class="footer-img" src="{{ asset('assets/img/brand/nortod_sample.png') }}" alt=""> --}}
        </div>
        <div class="col-xl-7" style="display: flex;align-items:center;">
          <div class="copyright text-center text-lg-right text-muted">
            {{-- Syarat & Ketentuan --}}
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
  <script src="{{ asset('js/global.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-block-ui/jquery-block-ui.js') }}"></script>
  <script src="{{ asset('js/jquery.mask.js') }}"></script>


  <script>
    $('#myForm').on('submit', function(e){
      e.preventDefault()
      $('#response_container').empty();
      $('[type="submit"]').attr('disabled', 'disabled')
      $('[type="submit"]').html(`<i class="fas fa-circle-notch spinner"></i>`)
      let el_form = $('#myForm')
      let target = el_form.attr('action')
      let formData = new FormData(el_form[0])
      $.ajax({
        url: target,
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
      }).done((res) => {
        if(res?.status == true){
         window.location.href = `{{ route('dashboard.index') }}`
        }
      }).fail((xhr) => {
        $('[type="submit"]').removeAttr('disabled')
        $('[type="submit"]').html(`Verifikasi`)
        if(xhr?.status == 422){
          let errors = xhr.responseJSON.errors
          let html = '<div class="alert alert-danger alert-dismissible fade show">'
          html += '<ul style="margin: 0; padding: 0">';
          for(let key in errors){
            html += `<li>${errors[key]}</li>`;
          }
          html += '</ul>'
          html += '</div>'
          $('#response_container').html(html)
        }else{
          let html = '<div class="alert alert-danger alert-dismissible fade show">'
          html += `${xhr?.responseJSON?.message ?? 'Terjadi Kesalahan Internal'}`
          html += '</div>'
          $('#response_container').html(html)
        }
      })
    })

    $('.send_qr_to_email').click(function(){
      $('.send_qr_to_email').attr('disabled', 'disabled')
      $('.send_qr_to_email').html(`<i class="fas fa-circle-notch spinner"></i> SEDANG PROSES ...`)
      $.ajax({
        url: `{{ route('auth.send_qr_to_email') }}`,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: {
          mie: $('[name="mie"]').val(),
          bumbu: $('[name="bumbu"]').val()
        }
      }).done((res) => {
        $('.send_qr_to_email').removeAttr('disabled')
        $('.send_qr_to_email').html('Kirim QR Ke Email')
        $('.response_send_qr').html(`
          <div class="alert alert-success alert-dismissible fade show">
              <div>
                  Silakan cek QR yang dikirim ke email anda.
                  <ul>
                      <li>Buka QR yang ada di email</li>
                      <li>Pindai QR menggunakan aplikasi Authenticator Digdaya</li>
                  </ul>
              </div>
            </div>
        `)
      }).fail((xhr) => {
        $('.send_qr_to_email').removeAttr('disabled')
        $('.send_qr_to_email').html('Kirim QR Ke Email')
        if(xhr?.status == 422){
            let errors = xhr.responseJSON.errors
            let html = '<div class="alert alert-danger alert-dismissible fade show">'
            html += '<ul>';
            for(let key in errors){
            html += `<li>${errors[key]}</li>`;
            }
            html += '</ul>'
            html += '</div>'
            $('.response_send_qr').html(html)
        }else{
            let html = '<div class="alert alert-danger alert-dismissible fade show">'
            html += `${xhr?.responseJSON?.message ?? 'Terjadi Kesalahan Internal'}`
            html += '</div>'
            $('.response_send_qr').html(html)
        }
      })
    })
  </script>
</body>

</html>
