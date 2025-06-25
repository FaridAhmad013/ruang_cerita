@extends('admin.parent')

@section('title', $module_name)

@section('styles')
<style>
  .avatar{
    object-fit: cover;
  }


  .chat {
    /* width: 300px; */
    /* border: solid 1px #EEE; */
    display: flex;
    flex-direction: column;
    height: 400px;
    overflow-y: auto;
    overflow-x: hidden;
    /* padding: 10px; */


    .messages {
      margin-top: 30px;
      display: flex;
      flex-direction: column;
    }

    .message {
      border-radius: 20px;
      padding: 8px 15px;
      margin-top: 5px;
      margin-bottom: 5px;
      display: inline-block;
    }

    .yours {
      align-items: flex-start;
    }

    .yours .message {
      margin-right: 25%;
      background-color: #eee;
      position: relative;
    }

    .yours .message.last:before {
      content: "";
      position: absolute;
      z-index: 0;
      bottom: 0;
      left: -7px;
      height: 20px;
      width: 20px;
      background: #eee;
      border-bottom-right-radius: 15px;
    }
    .yours .message.last:after {
      content: "";
      position: absolute;
      z-index: 1;
      bottom: 0;
      left: -10px;
      width: 10px;
      height: 20px;
      background: white;
      border-bottom-right-radius: 10px;
    }

    .mine {
      align-items: flex-end;
    }

    .mine .message {
      color: white;
      margin-left: 25%;
      background: linear-gradient(to bottom, #00D0EA 0%, #0085D1 100%);
      background-attachment: fixed;
      position: relative;
    }

    .mine .message.last:before {
      content: "";
      position: absolute;
      z-index: 0;
      bottom: 0;
      right: -8px;
      height: 20px;
      width: 20px;
      background: linear-gradient(to bottom, #00D0EA 0%, #0085D1 100%);
      background-attachment: fixed;
      border-bottom-left-radius: 15px;
    }

    .mine .message.last:after {
      content: "";
      position: absolute;
      z-index: 1;
      bottom: 0;
      right: -10px;
      width: 10px;
      height: 20px;
      background: white;
      border-bottom-left-radius: 10px;
    }
  }
</style>
@endsection

@section('breadcrum')
<div class="col-lg-6 col-7">
  <h6 class="h2 text-white d-inline-block mb-0">{{ $group }}</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
      <li class="breadcrumb-item"><a href="{{ route($module.'.halaman_obrolan') }}"><i class="{{ $icon }}"></i></a></li>
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route($module.'.halaman_obrolan') }}">{{ $module_name }}</a></li>
    </ol>
  </nav>
</div>
@endsection

@section('page')
<div class="row">
  <div class="col-xl-12 order-xl-1">
    <div class="card">
      <div class="card-header">
        <h3>Jurnal untuk {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</h3>
      </div>
      <div class="card-body p-3" id="box-aw">
        <form action="{{ route('ruang_cerita.obrolan.kirim_pesan') }}" method="post" id="myForm">
          @csrf
          <div class="chat">
            <div class="yours messages">
              <div class="message last">
                Hai! Siap untuk cerita sedikit tentang harimu? Kita mulai pelan-pelan ya...
                <b><a href="javascript:mulai_sesi_journal()">Mulai Jurnal Hari Ini</a></b>
              </div>
            </div>
          </div>
          <div class="form-group mt-5 wrap-input-jawaban" style="display: none">
            <div class="input-group">
              <input type="hidden" name="sesi_jurnal_id" id="sesi_jurnal_id" autocomplete="off">
              <input type="hidden" name="pertanyaan_label" id="pertanyaan_label" autocomplete="off">
              <textarea name="jawaban_user" id="jawaban_user" placeholder="Tulis jawabanmu di sini..." class="form-control" rows="1" style="resize: none; overflow-y: hidden;" autocomplete="off" oninput="autoResize(this)"></textarea>
              <a href="javascript:kirim_jawaban()" class="input-group-text align-self-stretch d-flex align-items-center justify-content-center" style="padding: 0 12px;">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')

<script>
  let _url = {
    mulai_sesi_journal: `{{ route('ruang_cerita.mulai_sesi_journal') }}`,
    check_status_sesi_journal: `{{ route('ruang_cerita.check_status_sesi_journal') }}`,
    get_pertanyaan_jawaban: `{{ route('ruang_cerita.get_pertanyaan_jawaban', ':id') }}`,
    generate_kesimpulan: `{{ route('ruang_cerita.generate_kesimpulan', ':id') }}`
  }

  let pertanyaan_terakhir = '';
  let sesi_jurnal_id = null;

  $(() => {
    check_status_sesi_journal()
  })

  function mulai_sesi_journal(){
    generate_message_loading()
    $('.wrap-input-jawaban').hide()
    $.get(_url.mulai_sesi_journal).done((res) => {
      sesi_jurnal_id = res?.id
      $('#sesi_jurnal_id').val(sesi_jurnal_id)

      $('#message_loading').remove()
      $('.wrap-input-jawaban').show()
      get_pertanyaan_jawaban(sesi_jurnal_id)
    }).fail((xhr) => {
      $('#message_loading').remove()
      $('.wrap-input-jawaban').hide()
      Ryuna.noty('error', '', xhr?.responseJSON?.message ?? 'Terjadi Kesalahan Internal')
    })
  }

  function autoResize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';

    // Juga sesuaikan tinggi input-group-text (ikon)
    const sendButton = textarea.nextElementSibling;
    sendButton.style.height = textarea.style.height;
  }

  function check_status_sesi_journal(){
    $.get(_url.check_status_sesi_journal).done((res) => {
      generate_mine_message('Mulai Jurnal Hari Ini')
      if(res.data.status_sesi_journal != 'BELUM_DIMULAI'){
        sesi_jurnal_id = res?.data?.id
        $('#sesi_jurnal_id').val(sesi_jurnal_id)
        get_pertanyaan_jawaban(sesi_jurnal_id, () => {
        //   $('#message_loading').remove()
        })
      }
    }).fail((xhr) => {
      Ryuna.noty('error', '', xhr?.responseJSON?.message ?? 'Terjadi Kesalahan Internal')
      $('#message_loading').remove()
    })
  }

  function get_pertanyaan_jawaban(id, callback){
    $('.wrap-input-jawaban').hide()
    $.get(_url.get_pertanyaan_jawaban.replace(':id', id)).done((res) => {

      const jawaban = res?.data?.jawaban;
      const pertanyaan = res?.data.pertanyaan
      for(let i = 0; i < (jawaban.length) + 1; i++){
        //pertanyaan
        if(pertanyaan[i]){
          generate_your_message(pertanyaan[i])
        }

        if(jawaban[i]){

          generate_mine_message(jawaban[i]?.jawaban_user ?? '')
        }
      }

      $('#pertanyaan_label').val(pertanyaan[jawaban.length])
      $('.wrap-input-jawaban').show()

      if(jawaban.length == 10){
        generate_your_message(`Terima kasih banyak sudah mau berbagi, {{ @$user->nama_depan }} {{ $user->nama_belakang }}. Semua ceritamu sudah kusimpan dengan aman. Beri aku waktu sebentar untuk merangkai kesimpulannya ya...`)
        $('.wrap-input-jawaban').hide()

        generate_kesimpulan(id)
      }

      var chatContainer = $('.chat');
      chatContainer.animate({ scrollTop: chatContainer.prop('scrollHeight') }, 500);
      callback()


    }).fail((xhr) => {
      Ryuna.noty('error', '', xhr?.responseJSON?.message ?? 'Terjadi Kesalahan Internal')
    })
  }

  function generate_kesimpulan(sesi_jurnal_id){
    generate_message_loading()

    $.get(_url.generate_kesimpulan.replace(':id', sesi_jurnal_id)).done((res) => {

      generate_your_message((res?.data?.kesimpulan).replace(/\n/g, "<br>"))
      $('#message_loading').remove()

      var chatContainer = $('.chat');
      chatContainer.animate({ scrollTop: chatContainer.prop('scrollHeight') }, 500)
    }).fail((xhr) => {
      Ryuna.noty('error', '', xhr?.responseJSON?.message ?? 'Terjadi Kesalahan Internal')
      $('#message_loading').remove()
    })
  }



  function generate_message_loading(){
    $('.chat').append(`
      <div class="yours messages" id="message_loading">
        <div class="message last">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><circle cx="18" cy="12" r="0" fill="currentColor"><animate attributeName="r" begin=".67" calcMode="spline" dur="1.5s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite" values="0;2;0;0"/></circle><circle cx="12" cy="12" r="0" fill="currentColor"><animate attributeName="r" begin=".33" calcMode="spline" dur="1.5s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite" values="0;2;0;0"/></circle><circle cx="6" cy="12" r="0" fill="currentColor"><animate attributeName="r" begin="0" calcMode="spline" dur="1.5s" keySplines="0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8;0.2 0.2 0.4 0.8" repeatCount="indefinite" values="0;2;0;0"/></circle></svg>
        </div>
      </div>
    `)
  }

  function generate_your_message(message){
    $('.chat').append(`
      <div class="yours messages">
        <div class="message last">
          ${message}
        </div>
      </div>
    `)
  }

  function generate_mine_message(message){
    $('.chat').append(`
      <div class="mine messages">
        <div class="message last">
          ${message}
        </div>
      </div>
    `)
  }


  function kirim_jawaban(){
    generate_message_loading();
    let el_form = $('#myForm')
    let target = el_form.attr('action')
    let formData = new FormData(el_form[0])

    $.ajax({
      url: target,
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
    }).done((res) => {
      if(res?.status == true){
        $('#jawaban_user').val('')
        get_pertanyaan_jawaban(res?.data?.sesi_jurnal_id, () => {
          $('#message_loading').remove()
        })

      }
    }).fail((xhr) => {
      if(xhr?.status == 422){
        for(let key in errors){
          Ryuna.noty('error', '', errors[key]);
        }
        $('#message_loading').remove()
      }else{
        Ryuna.noty('error', '', xhr?.responseJSON?.message)
      }
    })
  }
</script>
@endsection
