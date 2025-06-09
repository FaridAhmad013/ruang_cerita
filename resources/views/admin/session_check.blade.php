{{-- <script>
  var statusLogin = '00';
  const warning1 = "<strong>Peringatan! </strong> :message"
  const hnotif = $('#hnotif')

  if(typeof(EventSource) !== "undefined"){
    let source = new EventSource("{{ route('session.stream') }}")
    source.onmessage = function(event) {
      if(event?.data){
        let json = JSON.parse(event.data);

        if(json?.action == "01"){
          if(statusLogin != '01'){
            // alert(json?.action)
            hnotif.html(warning1.replace(':message', json?.message))
            hnotif.show()
          }
        }else if(json?.action == "02"){
          if(statusLogin != '02'){
            // alert(json?.action)
            hnotif.html(warning1.replace(':message', json?.message))
            hnotif.show()
          }
        }else if(json?.action == "03"){
          if(statusLogin != '03'){
            // alert(json?.action)
            Swal.fire({
              title: 'Lanjutkan Sesi?',
              text: 'Apakah Anda ingin melanjutkan sesi Anda?',
              type: 'question',
              showCancelButton: true,
              confirmButtonText: 'Ya, Lanjutkan!',
              cancelButtonText: 'Tidak, Logout',
              allowOutsideClick: false,
            }).then((result) => {
              if (result) {
                hnotif.empty()
                hnotif.hide()
                Ryuna.refreshSession()

                Swal.fire(
                  'Sesi Dilanjutkan',
                  'Sesi Anda berhasil dilanjutkan.',
                  'success'
                );
              } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                  'Logout',
                  'Anda telah logout dari akun Anda.',
                  'info'
                );

                setTimeout(() => {
                  window.location.href = "{{ route('auth.logout') }}"
                }, 500);
              }
            });
          }
        }

        statusLogin = json?.action
      }
    }

    source.onerror = function(event) {
      console.log(event)
      if(event.readyState == EventSource.CLOSED){
        console.log('Event was closed');
        console.log(EventSource)
      }
    }
  } else {
    console.log("Sorry, your browser does not support server sent events ....")
  }
</script> --}}
