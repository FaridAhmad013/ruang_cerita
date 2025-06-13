@extends('admin.parent')

@section('title', 'Data Saya')

@section('styles')
  <style>
    .avatar {
      object-fit: cover;
    }

    .bold {
      font-weight: bold;
    }
  </style>
@endsection

@section('breadcrum')
  <div class="col-lg-6 col-7">
    <h6 class="h2  d-inline-block mb-0">Data Saya</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="ni ni-single-02"></i></a></li>
      </ol>
    </nav>
  </div>
@endsection

@section('page')
  @php
    $auth = \App\Helpers\AuthCommon::user();
  @endphp
  <div class="row">
    <div class="col-xl-6">
      <div class="card">
        <div class="card-header">
          <h2 class="text-responsive">Profile Saya</h2>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-sm-6 text-responsive">ID Pengguna</div>
            <div class="col-sm-6 text-responsive bold">{{ $auth->username ?? '-' }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-6 text-responsive">Nama</div>
            <div class="col-sm-6 text-responsive bold">{{ @$auth->nama_depan ?? '-' }} {{ @$auth->nama_belakang ?? '-' }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-6 text-responsive">Email</div>
            <div class="col-sm-6 text-responsive bold"> {{ @$auth->email ?? '-' }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-6 text-responsive">Peran</div>
            <div class="col-sm-6 text-responsive bold">{{ @$auth->role?->role ?? '-' }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-6 text-responsive">Status Pengguna</div>
            <div class="col-sm-6 text-responsive bold">Aktif</div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header border-1">
          <div class="row align-items-center">
            <div class="col">
              <h2 class="mb-0 text-responsive">Ganti Password</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          @include('admin.alert')
          @if (session()->has('reset_password'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <span class="alert-inner--text">{{ session('reset_password') }}</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <form action="{{ route('profile.updatepassword') }}" method="POST" id="myForm1">
            @csrf
            @method('PUT')
            @include('pages.user.profile.password')
          </form>
        </div>
      </div>
    </div>

    <div class="col-xl-6 ">
      <div class="card">
        <div class="card-header border-1">
          <div class="row align-items-center">
            <div class="col">
              <h2 class="mb-0 text-responsive">Edit Profile</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form id="form_edit_profile">
            <div class="form-group row">
              <div class="col-md-6">
                <label for="first_name">Nama Depan</label><input type="text" name="first_name" id="first_name" class="form-control" value="{{ @$auth->nama_depan }}">
              </div>
              <div class="col-md-6">
                <label for="last_name">Nama Belakang</label><input type="text" name="last_name" id="last_name" class="form-control" value="{{ @$auth->nama_belakang }}">
              </div>
            </div>

            <div class="form-group">
              <label class="text-responsive">Username</label>
              <input type="text" id="username" name="username" class="form-control text-responsive" placeholder="Nomor HP"
                value="{{ @$data->username }}" disabled="true">
            </div>
            <div class="form-group">
              <label class="text-responsive">Email</label>
              <input type="text" id="email" name="email" class="form-control text-responsive" placeholder="Email"
                value="{{ @$auth->email ?? '-' }}" oninvalid="this.setCustomValidity('Field ini wajib diisi')"
                oninput="setCustomValidity('')">
            </div>

            <button type="button" class="btn btn-success text-responsive" id="btn_submit_profile">Simpan</button>
            <div id="response_container_edit_profile" class="mt-2"></div>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection



@section('scripts')
  <script>
    $(document).ready(function() {
      Ryuna.showHiddenPassword('[name="password_lama"]')
      Ryuna.showHiddenPassword('[name="password_baru"]')
      Ryuna.showHiddenPassword('[name="password_baru_confirmation"]')
      $("#btn_submit_profile").on('click', function(event) {
        let formData = new FormData($('#form_edit_profile')[0]);
        event.preventDefault();
        $.ajax({
          url: "{{ route('profile.edit_profile') }}",
          data: formData,
          processData: false,
          contentType: false,
          type: "POST",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: function() {
            $("#response_container_edit_profile").html(
              '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
            );
            $('#response_container_edit_profile').hide();
          },
          success: function(data) {
            let msg = data.message
            html = '<div class="alert alert-success">' + msg + '</div>';
            $('#response_container_edit_profile').html(html);
            $('#response_container_edit_profile').show();
            Ryuna.noty('success', '', data.message)
          },
          error: function(xhr) {
            if (xhr?.status == 422) {
              let errors = xhr.responseJSON.errors
              let html = '<div class="alert alert-danger alert-dismissible fade show">'
              html += '<ul>';
              for (let key in errors) {
                html += `<li>${errors[key]}</li>`;
              }
              html += '</ul>'
              html += '</div>'
              $('#response_container_edit_profile').html(html)
              Ryuna.unblockElement('.modal-content')
            } else {
              let html = '<div class="alert alert-danger alert-dismissible fade show">'
              html += `${xhr?.responseJSON?.message ?? 'Terjadi Kesalahan Internal'}`
              html += '</div>'
              Ryuna.noty('error', '', xhr?.responseJSON?.message ?? 'Terjadi Kesalahan Internal')
              $('#response_container_edit_profile').html(html)
              Ryuna.unblockElement('.modal-content')
            }
            $('#response_container_edit_profile').show();
          }
        })
      });
    });
  </script>

@endsection
