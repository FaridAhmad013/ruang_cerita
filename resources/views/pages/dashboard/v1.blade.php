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
  <h6 class="h2 d-inline-block mb-0 text-white">Beranda</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-light">
      <li class="breadcrumb-item"><a href="#"><i class="ni ni-tv-2"></i></a></li>
    </ol>
  </nav>
</div>
@endsection

@section('page')
<div class="row">
  <div class="col-xl-4 order-xl-1">
    <div class="card">
      <div class="card-body p-3 position-relative">
        <div class="row">
          <div class="col-10">
            <p class="text-sm mb-0 text-uppercase font-weight-bold">Dokumen BPR - Menunggu Persetujuan</p>
            <h2 id="jumlah_menunggu_persetujuan" class="my-2">0</h2>
          </div>
          <div class="text-end">
            <div class="icon icon-shape bg-warning shadow-primary text-center rounded-circle">
              <i class="ni ni-archive-2 text-lg opacity-10 text-white" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 order-xl-1">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-10">
            <p class="text-sm mb-0 text-uppercase font-weight-bold">Dokumen BPR - Ditolak</p>
            <h2 id="jumlah_ditolak" class="my-2">0</h2>
          </div>
          <div class="text-end">
            <div class="icon icon-shape bg-danger shadow-primary text-center rounded-circle">
              <i class="ni ni-fat-remove text-lg opacity-10 text-white" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 order-xl-1">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-10">
            <p class="text-sm mb-0 text-uppercase font-weight-bold">Dokumen BPR - Disetujui</p>
            <h2 id="jumlah_diterima" class="my-2">0</h2>
          </div>
          <div class="text-end">
            <div class="icon icon-shape bg-success shadow-primary text-center rounded-circle">
              <i class="ni ni-check-bold text-lg opacity-10 text-white" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card grafik_smki">
      <div class="card-header">
        <div class="row">
            <div class="col-md-6">
              <h3><i class="fas fa-chart-area"></i> Grafik Jumlah Upload </h3>
            </div>
            <div class="col-md-6 row">
              <div class="col-6">
                <div class="input-group">
                  <select class="form-control" name="tahun" id="tahun">
                    @foreach ($tahun as $val)
                      <option value="{{ $val }}" @if($val == date('Y')) selected @endif>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-6">
                <select class="form-control" name="bulan" id="bulan">
                  <option value="" selected>Pilih Bulan</option>
                  @foreach ($bulan as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                  @endforeach
                </select>
              </div>
            </div>
        </div>
      </div>
      <div class="card-body p-3 overflow-auto position-relative">
        <div id="chartContainer"></div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  @if(in_array($role->name, ['Web Admin', 'Admin', 'Admin SMKI', 'Web Admin Perbarindo', 'Konsultan SMKI']))
  <div class="col-6">
    <div class="card">
      <div class="card-header">
        <div class="row">
            <div class="col-md-12">
              <h3><i class="fas fa-history"></i> 10 Aktivasi Akun SMKI Terbaru </h3>
            </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">BPR</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Waktu</th>
            </tr>
          </thead>
          <tbody>
            @if (empty($last_log_bpr))
              <tr>
                <td colspan="3" class="text-center">Belum ada data</td>
              </tr>
            @else
              @foreach ($last_log_bpr as $item)
                <tr>
                  <td>{{ strtoupper($item['bpr_name']) }}</td>
                  <td>{{ strtoupper($item['activity']) }}</td>
                  <td>{{ strtoupper($item['activity_date']) }}</td>
                </tr>
              @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                  <h3><i class="fas fa-star"></i> Jumlah akun BPR teraktivasi di SMKI</h3>
                </div>
            </div>
          </div>
          <div class="card-body">
            <h1>{{ $smki_account }}/{{ $all_account }}</h1>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card grafik_pengajuan_dokumen">
          <div class="card-header">
            <div class="row">
              <div class="col-12">
                <h3><i class="fas fa-chart-area"></i> Grafik Dokumen BPR </h3>
              </div>
            </div>
          </div>
          <div class="card-header">
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control" name="filter_tahun_grafik_dokumen" id="filter_tahun_grafik_dokumen" autocomplete="off">
                    @foreach ($tahun as $val)
                      <option value="{{ $val }}" @if($val == date('Y')) selected @endif>{{ $val }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <select class="form-control" name="filter_bulan_grafik_dokumen" id="filter_bulan_grafik_dokumen" autocomplete="off">
                  <option value="" selected>Pilih Bulan</option>
                  @foreach ($bulan as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="card-body p-3 overflow-auto position-relative">
            <div id="chartPengajuanDokumenContainer"></div>
          </div>
        </div>
      </div>
    </div>

  </div>
  @endif
</div>


@endsection

@section('scripts')
<script src="{{ asset('js/apex.js') }}"></script>

<script>

  $(document).ready(function(){
    updateChart();
    getData();
    updateChartPengajuanDokumen();
    $('#tahun, #bulan, #filter_tahun_grafik_dokumen, #filter_bulan_grafik_dokumen').select2()
    $('[aria-labelledby="select2-tahun-container"]').addClass('d-flex align-items-center').prepend('<i class="fas fa-filter mr-4"></i>')
    $('[aria-labelledby="select2-bulan-container"]').addClass('d-flex align-items-center').prepend('<i class="fas fa-filter mr-4"></i>')

    $('#tahun, #bulan').on('change', function(item){
      setTimeout(() => {
        updateChart();
      }, 100);
    })

    $('#filter_tahun_grafik_dokumen, #filter_bulan_grafik_dokumen').on('change', function(item){
      setTimeout(() => {
        updateChartPengajuanDokumen();
      }, 100);
    })
  })
  $(() => {
    getTime()
    setInterval(getTime, 1000);
  })

  function getData(){
    $.ajax({
      url: `{{ route('dashboard.get_data') }}`,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
    }).done((res) => {
      if(res?.status){
        $('#jumlah_menunggu_persetujuan').html(res?.data?.jumlah_menunggu_persetujuan ?? 0)
        $('#jumlah_ditolak').html(res?.data?.jumlah_ditolak ?? 0)
        $('#jumlah_diterima').html(res?.data?.jumlah_diterima ?? 0)
      }
    })
  }

  function getTime() {
    var date = new Date();
    var day = addLeadingZero(date.getDate());
    var month = addLeadingZero(date.getMonth() + 1);
    var year = date.getFullYear();
    var hours = addLeadingZero(date.getHours());
    var minutes = addLeadingZero(date.getMinutes());
    var seconds = addLeadingZero(date.getSeconds());
    var dateTime = day + '-' + month + '-' + year + ' ' + hours + ':' + minutes + ':' + seconds;
    $('#waktu_setempat').html(dateTime);
  }

  function addLeadingZero(value) {
      return value < 10 ? '0' + value : value;
  }

  function updateChart() {
    Ryuna.blockElement('.grafik_smki')
    const tahun = $('#tahun').val();
    const bulan = $('#bulan').val();

    $.ajax({
      url: `{{ route('dashboard.grafik_smki') }}`,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: { tahun: tahun, bulan: bulan },
    }).done((res) => {
      Ryuna.unblockElement('.grafik_smki')
      if (res?.status) {
        const chartData = res.data;
        updateChartContainer(chartData);
      }
    }).fail(xhr => {
      Ryuna.unblockElement('.grafik_smki')
    });
  }

  function updateChartContainer(data) {
    $('#chartContainer').empty()
    const options = {
      chart: {
        type: 'area',
        height: 350,
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth'
      },
      series: data.datasets,
      xaxis: {
        categories: data.labels,
      },
    };

    const chart = new ApexCharts(document.querySelector('#chartContainer'), options);
    chart.render();
  }

  function updateChartPengajuanDokumen() {
    Ryuna.blockElement('.grafik_pengajuan_dokumen')
    const tahun = $('#filter_tahun_grafik_dokumen').val();
    const bulan = $('#filter_bulan_grafik_dokumen').val();

    $.ajax({
      url: `{{ route('dashboard.grafik_pengajuan_dokumen') }}`,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: { tahun: tahun, bulan: bulan },
    }).done((res) => {
      Ryuna.unblockElement('.grafik_pengajuan_dokumen')
      if (res?.status) {
        const chartData = res.data;
        updateChartPengajuanDokumenContainer(chartData);
      }
    }).fail(xhr => {
      Ryuna.unblockElement('.grafik_pengajuan_dokumen')
    });
  }

  function updateChartPengajuanDokumenContainer(data) {
    $('#chartPengajuanDokumenContainer').empty()
    const options = {
      chart: data.chart,
      colors: data.colors,
      series: data.series,
      labels: data.labels,
    };

    const chart = new ApexCharts(document.querySelector('#chartPengajuanDokumenContainer'), options);
    chart.render();
  }
</script>
@endsection
