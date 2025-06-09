
<div class="form-group">
  <label class="text-responsive">Passsword Lama</label>
  <div class="input-group input-group-merge">
    <input type="password" name="password_lama" class="form-control text-responsive" placeholder="Passsword Lama" value="" required oninvalid="this.setCustomValidity('Silakan Isi Password Lama Anda')" oninput="setCustomValidity('')">
    <div class="input-group-addon"><i class="fa fa-eye-slash input-group-text text-primary" aria-hidden="true"></i></div>
  </div>
</div>

<div class="form-group">
  <label class="text-responsive">Password Baru</label>
  <div class="input-group input-group-merge">
    <input type="password" name="password_baru" class="form-control text-responsive" placeholder="Password Baru" value="" required oninvalid="this.setCustomValidity('Silakan Isi Password Baru Anda')" oninput="setCustomValidity('')">
    <div class="input-group-addon">
      <i class="fa fa-eye-slash input-group-text text-primary" aria-hidden="true"></i>
    </div>
  </div>
</div>


<div class="form-group">
  <label class="text-responsive">Konfirmasi Password Baru</label>
  <div class="input-group input-group-merge">
    <input type="password" name="password_baru_confirmation" class="form-control text-responsive" placeholder="Konfirmasi Password Baru" value="" required oninvalid="this.setCustomValidity('Silakan Isi Konfirmasi Password Baru Anda')" oninput="setCustomValidity('')">
    <div class="input-group-addon">
      <i class="fa fa-eye-slash input-group-text text-primary" aria-hidden="true"></i>
    </div>
  </div>

  @if($errors->any())
    {!! implode('', $errors->all('<i class="text-danger text-sm">:message</i>')) !!}
  @endif
</div>

<button type="submit" class="btn btn-success text-responsive">Simpan</button>
<div id="response_container"></div>
