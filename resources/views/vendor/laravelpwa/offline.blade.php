@extends('admin.parent')
@section('title', 'Disbursement Detail')
@section('page')
<div class="row">
  <div class="col-xl-12 order-xl-1">
    <div class="card">
      <div class="card-header border-1">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">You are currently not connected to any networks.</h3>
          </div>
        </div>
      </div>
      <div class="card-body text-center">
        <img style="height: 200px;" src="{{ asset('img/empty.png') }}"> <h4>Offline</h4>
      </div>
    </div>
  </div>
</div>
@endsection