@extends('admin.parent')

@section('title', 'Beranda')

@section('styles')

<style>
  .card{
    min-height: 125px
  }

  .text-end{
    text-align: right
  }
</style>
@endsection

@section('breadcrum')
<div class="col-lg-6 col-7">
  <h6 class="h2 d-inline-block mb-0 text-white">Dashboard</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-light">
      <li class="breadcrumb-item"><a href="#"><i class="ni ni-tv-2"></i></a></li>
    </ol>
  </nav>
</div>
@endsection

@section('page')

<div class="row">
</div>


@endsection

@section('scripts')

<script>

</script>
@endsection
