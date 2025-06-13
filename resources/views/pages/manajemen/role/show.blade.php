<div class="table-responsive">
  <table class="table table-borderless">
    <tr>
      <td class="bg-secondary" style="width: 30%">Role</td>
      <th>{{ @$data->role }}</th>
    </tr>
    <tr>
      <td class="bg-secondary" style="width: 30%">Deskripsi</td>
      <th>{{ @$data->deskripsi }}</th>
    </tr>
    <tr>
      <td class="bg-secondary" style="width: 30%">Status</td>
      <th>{!! App\Helpers\Util::status($data->status) !!}</th>
    </tr>
    <tr>
      <td class="bg-secondary" style="width: 30%">Created At</td>
      <th>{{ @$data->created_at ? \Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s') : '-' }}</th>
    </tr>
    <tr>
      <td class="bg-secondary" style="width: 30%">Updated At</td>
      <th>{{ @$data->updated_at ? \Carbon\Carbon::parse($data->updated_at)->format('d-m-Y H:i:s') : '-' }}</th>
    </tr>
  </table>
</div>
