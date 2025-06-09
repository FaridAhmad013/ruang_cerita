@php
  $auth = \App\Helpers\AuthCommon::user();
  $mitra = $auth->mitra ?? null;
@endphp

@if(!$mitra)
<li class="nav-item">
  <div class="box-saldo">
    <div class="text-bold text-white" style="text-transform: uppercase">
      {{ $auth?->cabang?->kode }} - {{ $auth?->cabang?->cabang }}
    </div>
  </div>
</li>
@endif
