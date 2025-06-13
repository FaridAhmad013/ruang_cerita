@extends('admin.parent')

@section('title', 'Beranda')

@section('styles')

<style>
  .mini-calendar {
    font-size: 10px; /* Ukuran font kecil */
    max-width: 300px; /* Batasi lebar */
  }

  .mini-calendar .fc {
    font-size: 0.7rem;
  }

  .mini-calendar .fc-toolbar-title {
    font-size: 0.9rem;
  }

  .mini-calendar .fc-button {
    padding: 2px 6px;
    font-size: 0.7rem;
  }

  .mini-calendar .fc-daygrid-day-number {
    font-size: 0.7rem;
    padding: 2px;
  }
</style>
@endsection

@section('breadcrum')
<div>
  <h1 class="font-lora font-weight-bold tracking-wide" style="font-size: 3rem">{{ @$ucapan }}</h1>
  <h3 class="font-lora">Siap untuk cerita hari ini? <a href="" class="font-weight-bold text-primary">Mulai Jurnal Hari Ini</a></h3>
</div>
@endsection

@section('page')

<div class="row">
  <div class="col-md-7">
    <div class="card card-new">
      <div class="card-body">

      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card card-new">
      <div class="card-body">
        <b> Kalender Progress</b>
        <div id="kalender-wrap"></div>
      </div>
    </div>
     <div class="card card-new">
      <div class="card-body">
        <b>Jejak Ceritamu</b>
        <br>
        <small>Selasa, 11 Juni</small>
        <p>Merasa Bersyukur & Lelah</p>
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script src=" https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js "></script>

<script>
  $(document).ready(function() {
    const calendarEl = document.getElementById('kalender-wrap')
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      height: 'auto',
      locale: 'id',
       events: [
        {
          title: 'Meeting Tim',
          start: '2025-06-14',
          url: 'https://google.com/?q=Farid Ganteng'
        },
        {
          title: 'Deadline Proyek',
          start: '2025-06-16'
        },
        {
          title: 'Review Bulanan',
          start: '2025-06-17',
        }
      ]
    })
    calendar.render()

  })
</script>
@endsection
