@php
  $auth = \App\Helpers\AuthCommon::user();
@endphp
@isset($auth->group)

@if($auth->group == 'approver' || $auth->group == 'maker')
<li class="nav-item">
  <div class="box-saldo">
    <div class="text-bold text-white">
      <button class="btn-saldo-refresh" title="sinkronisasi">
        <i class="fas fa-sync-alt"></i>
      </button>
      <span class="info-saldo">
        <span class="saldo-value text-sm">menyinkronkan ...</span>
      </span>
    </div>
  </div>
</li>
@endif
@endisset
