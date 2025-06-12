@extends('auth.parent')

@section('content')
  <div class="row justify-content-end align-items-center" style="height: 100vh">
    <div class="col-md-4 p-3" style="margin-right: 3rem">
      <div class="card" style="background: rgba(255, 255, 255, 0.31)">
        <div class="card-body">
          <h1 class="text-center mb-3 font-lora" style="font-size: 2rem; font-weight: bold; color: white">Ruang Cerita</h1>
          <hr>
          <h4>Sign in to account</h4>
          <p>Enter your username & password to login</p>
          <div id="response_container"></div>
          <form action="{{ route('auth.login_process') }}" method="post" id="myForm">
            @csrf

            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="username">Password</label>
              <input type="password" name="password" id="password" class="form-control" autocomplete="off">
            </div>
            <button type="button" class="btn btn-default btn-block" onclick="save()">Login</button>
          </form>
          <div class="form-group mt-3">
            <a href="{{ route('auth.register') }}" class="text-dark">Belum Punya Akun?</a>
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
            window.location.href = `{{ route('dashboard.index') }}`
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
