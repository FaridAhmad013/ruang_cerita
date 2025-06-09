<div class="row">
  <div class="form-group col-md-6">
    <label>Username</label>
    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ @$data->username }}" required oninvalid="this.setCustomValidity('Please fill your username field')" oninput="setCustomValidity('')">
  </div>

  <div class="form-group col-md-6">
    <label>Email</label>
    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ @$data->email }}" required oninvalid="this.setCustomValidity('Please fill your email field')" oninput="setCustomValidity('')">
  </div>

  <div class="form-group col-md-6">
    <label>Firstname</label>
    <input type="text" name="firstname" class="form-control" placeholder="Firstname" value="{{ @$data->firstname }}" required oninvalid="this.setCustomValidity('Please fill your firstname ')" oninput="setCustomValidity('')">
  </div>

  <div class="form-group col-md-6">
    <label>Lastname</label>
    <input type="text" name="lastname" class="form-control" placeholder="Lastname" value="{{ @$data->lastname }}" required oninvalid="this.setCustomValidity('Please fill your lastname ')" oninput="setCustomValidity('')">
  </div>

  <div class="form-group col-md-6" style="display:none;">
    <input type="hidden" name="password" class="form-control" placeholder="Password" value="">
  </div>

  <div class="form-group col-md-6" style="display:none;">
    <label>User Group</label>
    {{-- <input type="text" name="role" class="form-control" placeholder="User Group" value="{{ @$data->role }}"> --}}
    <select class="form-control" name="role" id="select2-role" hidden>
      @if(isset($data->roles[0]->id))
        <option value="{{ $data->roles[0]->id }}">{{ $data->roles[0]->name }}</option>
      @endif
    </select>
  </div>

  <div class="form-group col-md-6" style="display:none;">
    <label>Job Position</label>
    <select class="form-control" name="jobposition" id="select2-jobposition">
      @if(isset($data->jobposition->id))
        <option value="{{ $data->jobposition->id }}">{{ $data->jobposition->name }}</option>
      @endif
    </select>
  </div>

  <div class="form-group col-md-6" style="display:none;">
    <select class="form-control" type="hidden"name="branch" id="select2-branch">
      @if(isset($data->branch->id))
        <option type="hidden" value="{{ $data->branch->id }}">{{ $data->branch->name }}</option>
      @endif
    </select>
  </div>
</div>

<button type="submit" class="btn btn-success">Simpan</button>
<div id="response_container"></div>


