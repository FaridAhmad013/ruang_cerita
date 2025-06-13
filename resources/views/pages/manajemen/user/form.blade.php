<div class="row flex-wrap">
  <div class="col-md-6">
    <div class="form-group">
      <label for="nama_depan">Nama Depan</label>
      <input type="text" name="nama_depan" id="nama_depan" class="form-control" value="{{ @$data->nama_depan }}" autocomplete="off">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label for="nama_belakang">Nama Belakang</label>
      <input type="text" name="nama_belakang" id="nama_belakang" class="form-control" value="{{ @$data->nama_belakang }}" autocomplete="off">
    </div>
  </div>
</div>

@if (!@$data)
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" class="form-control" autocomplete="off">
  </div>
@endif


<div class="form-group">
  <label for="email">Email</label>
  <input type="email" name="email" id="email" class="form-control" autocomplete="off" value="{{ @$data->email }}">
</div>

@if (!@$data)
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control" autocomplete="off" value="{{ @$data->password }}">
  </div>

  <div class="form-group">
    <label for="password_confirmation">Ulangi Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="off" value="{{ @$data->password }}">
  </div>
@endif

<div class="form-group">
  <label for="select2-role">Role</label>
  <select name="role_id" id="select2-role" class="form-control">
    @isset($data)
      <option value="{{ $data->role->id }}">{{ $data->role->role }}</option>
    @endisset
  </select>
</div>

<script>
  $(`#select2-role`).select2({
    ajax: {
      url: _url_select2.role,
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          term: params.term,
          page: params.page || 0,
          limit: _limit
        };
      },
      processResults: function (data, params) {
        params.page = params.page || 0;
        let check = params.page+1;
        return {
          results: data.items,
          pagination: {
            more: (data.total - (check * _limit)) > 0
          }
        };
      },
      cache: true
    },
    templateResult: (res) => {
      if (res.loading) {
        return res.text;
      }
      return res.role
    },
    templateSelection: (res) => {
      return res.role ? res.role : res.text
    },
    placeholder: "Pilih Salah Satu"
  })
</script>
