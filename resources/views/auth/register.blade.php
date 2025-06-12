@extends('auth.parent')

@section('content')
  <div class="row justify-content-end align-items-center">
    <div class="col-md-5 p-3" style="margin-right: 3rem">
      <div class="card" style="background: rgba(255, 255, 255, 0.31)">
        <div class="card-body">

          <h1 class="text-center mb-3 font-lora" style="font-size: 2rem; font-weight: bold; color: white">Ruang Cerita</h1>
          <hr>
          <h4>Sign up</h4>
          <div id="response_container"></div>
          <form action="{{ route('auth.register_process') }}" method="post" id="myForm">
            @csrf

            <div class="row flex-wrap">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nama_depan">Nama Depan</label>
                  <input type="text" name="nama_depan" id="nama_depan" class="form-control" autocomplete="off">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nama_belakang">Nama Belakang</label>
                  <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" autocomplete="off">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" autocomplete="off">
            </div>

            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" autocomplete="off">
            </div>


            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" autocomplete="off">
            </div>

            <div class="form-group">
              <label for="password_confirmation">Ulangi Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="off">
            </div>
            <button type="button" class="btn btn-default btn-block" onclick="save()">Register</button>
          </form>
          <div class="form-group mt-3">
            <a href="{{ route('auth.login') }}" class="text-dark">Sudah Punya Akun?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    function save(){
      $('#response_container').empty();
      Ryuna.blockElement('.modal-content');
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
          let html = '<div class="alert alert-success alert-dismissible fade show">'
          html += `${res?.message}`
          html += '</div>'
          Ryuna.noty('success', '', res?.message)
          $('#response_container').html(html)
          Ryuna.unblockElement('.modal-content')

          if($('[name="_method"]').val() == undefined) el_form[0].reset()

          setTimeout(() => {
            window.location.href = `{{ route('auth.login') }}`
          }, 1000);
        }
      }).fail((xhr) => {
        if(xhr?.status == 422){
          let errors = xhr.responseJSON.errors
          let html = '<div class="alert alert-danger alert-dismissible fade show">'
          html += '<ul>';
          for(let key in errors){
            html += `<li>${errors[key]}</li>`;
          }
          html += '</ul>'
          html += '</div>'
          $('#response_container').html(html)
          Ryuna.unblockElement('.modal-content')
        }else{
          let html = '<div class="alert alert-danger alert-dismissible fade show">'
          html += `${xhr?.responseJSON?.message}`
          html += '</div>'
          Ryuna.noty('error', '', xhr?.responseJSON?.message)
          $('#response_container').html(html)
          Ryuna.unblockElement('.modal-content')
        }
      })
    }
  </script>
@endsection
