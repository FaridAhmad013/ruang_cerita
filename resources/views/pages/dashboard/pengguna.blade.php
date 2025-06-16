@extends('admin.parent')

@section('title', 'Beranda')

@section('styles')

<style>
  .mini-calendar {
    font-size: 10px; /* Ukuran font kecil */
  }

  .mini-calendar .fc {
    font-size: 0.65rem;
  }

  .fc th{
    font-size: 0.6rem !important;
    padding: 2px !important;
  }
  .mini-calendar .fc-toolbar-title {
    font-size: 0.85rem;
  }

  .mini-calendar .fc-button {
    padding: 2px 6px;
    font-size: 0.65rem;
  }

  .mini-calendar .fc-daygrid-day-number {
    font-size: 0.6rem;
    padding: 2px;
  }

  .mini-calendar .fc-daygrid-day-frame {
    padding: 2px;
  }

  .fc .selected-circle {
    background: red;
    border-radius: 50% !important;
    opacity: 0.3;
  }
</style>
@endsection

@section('breadcrum')
<div>
  <h1 class="font-lora font-weight-bold tracking-wide" style="font-size: 3rem">{{ @$ucapan }}</h1>
</div>
@endsection

@section('page')

<div class="row">
  <div class="col-md-7">
    <div class="card card-new card-wrap-jurnal">
      <div class="card-body">

      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card card-new">
      <div class="card-body">
        <b> Kalender Progress</b>
        <div id="kalender-wrap" class="mini-calendar"></div>
      </div>
    </div>
     <div class="card card-new card-jejak-ceritamu">
      <div class="card-body">
        <b>Jejak Ceritamu</b>
        <br>
        <div id="jejak-ceritamu"></div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js "></script>

<script>
  let _url = {
    check_menulis_jurnal: `{{ route('dashboard.check_menulis_jurnal') }}`,
    get_kalender_progress: `{{ route('dashboard.get_kalender_progress') }}`,
    jejak_ceritamu: `{{ route('dashboard.get_jejak_ceritamu') }}`
  }

  $(() => {
    check_menulis_jurnal()
    get_kalender_progress()
    get_jejak_cerita()
  })
  $(document).ready(function() {


  })

  function check_menulis_jurnal(){
    Ryuna.blockElement('.card-wrap-jurnal')
    $.get(_url.check_menulis_jurnal).done((res) => {
      $('.card-wrap-jurnal .card-body').html(`
        <h2 class="font-lora"><b>Siap untuk cerita hari ini?</b></h2>
        <a href="{{ route('ruang_cerita.obrolan.halaman_obrolan') }}" class="btn btn-success mt-1">Mulai Jurnal Hari Ini</a>
      `)
      if(res?.data?.sudah_menulis_jurnal){
        $('.card-wrap-jurnal .card-body').html(`
          <h2 class="font-lora font-weight-bold">Ringkasan Harimu ❤️</h2>
          <br>
          <p class="font-lora leading-relaxed tracking-wide">${(res?.data?.kesimpulan).replace(/\n/g, "<br>")}</p>
        `)
      }

      Ryuna.unblockElement('.card-wrap-jurnal')
    }).fail((xhr) => {
      console.log('check menulis jurnal', xhr)
      Ryuna.unblockElement('.card-wrap-jurnal')
    })
  }

  function get_kalender_progress(){
    const calendarEl = document.getElementById('kalender-wrap')
    const calendar_ob = {
      initialView: 'dayGridMonth',
      height: 300,
      width: 300,
      locale: 'id',
    }
    $.get(_url.get_kalender_progress).done((res) => {
      const calendar = new FullCalendar.Calendar(calendarEl, {
        ...calendar_ob,
        events: res?.data?.map((item) => {
          return {
            start: moment(item?.tanggal).format('YYYY-MM-DD'),
            display: 'background',
            className: 'selected-circle'
          }
        })
      })
      calendar.render()
    }).fail((xhr) => {
      const calendar = new FullCalendar.Calendar(calendarEl, {
        ...calendar_ob,
        events: res?.data?.map((item) => {
          return {
            start: moment(item?.tanggal).format('YYYY-MM-DD'),
            display: 'background',
            className: 'selected-circle'
          }
        })
      })
      calendar.render()
    })
  }



  function get_jejak_cerita(){
    Ryuna.blockElement('.card-jejak-ceritamu')
    $('#jejak-ceritamu').html('')
    $.get(_url.jejak_ceritamu).done((res) => {
      res.data.map((item) => {
        $('#jejak-ceritamu').append(`
          <small>${Ryuna.format_tanggal_bahasa(item.tanggal)}</small>
          <p>${item.label_mood}</p>
        `)
      })
      Ryuna.unblockElement('.card-jejak-ceritamu')
    }).fail((xhr) => {
      Ryuna.unblockElement('.card-jejak-ceritamu')
    })
  }

</script>
@endsection
