function beforeSend() {
  resetTimer()
}

$.ajaxSetup({
  beforeSend: beforeSend
});


let idleTimeout;
let idleTime = 5 * 60 * 1000;
let remaining;
let counting;
let notif1 = 2 * 60 * 1000;
let notif2 = 1 * 60 * 1000;
const warning1 = "<strong>Peringatan! </strong> :message"
const hnotif = $('#hnotif')

function resetTimer() {
  hnotif.hide()
  clearTimeout(idleTimeout);
  clearInterval(counting);
  remaining = idleTime;
  idleTimeout = setTimeout(logout, idleTime);
  counting = setInterval(() => {
    if (remaining >= 1000) {
      remaining = remaining - 1000;
      sisadetik = remaining / 1000;
      // console.log("yeah ", remaining, "oh ", notif1, "oh ", notif2)
      if (remaining <= notif1 && remaining > notif2) {
        hnotif.html(warning1.replace(':message', `sisa ${notif1 / 1000} detik lagi sebelum logout otomatis`))
        hnotif.show()
      } else if (remaining <= notif2) {
        hnotif.html(warning1.replace(':message', `sisa ${notif2 / 1000} detik lagi sebelum logout otomatis`))
        hnotif.show()
      }
    } else {
      clearInterval(counting)
    }
  }, 1000)
}

function logout() {
  Swal.fire({
    title: 'Lanjutkan Sesi?',
    html: 'Auto logout dalam <span id="swal2-timer">10</span> detik',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Ya, Lanjutkan!',
    cancelButtonText: 'Tidak, Logout',
    allowOutsideClick: false,
    timer: 10000, // Timer dalam milidetik (10 detik)
    timerProgressBar: true, // Menampilkan progress bar timer
    onBeforeOpen: () => {
      const timerSpan = document.getElementById('swal2-timer');
      let timerCount = 10;

      const countdown = setInterval(() => {
        timerSpan.textContent = timerCount;
        timerCount--;

        if (timerCount < 0) {
          clearInterval(countdown);
        }
      }, 1000);
    },
  }).then((result) => {
    if (result.dismiss === Swal.DismissReason.timer) {
      Swal.fire(
        'Logout Otomatis',
        'Anda telah logout dari akun Anda secara otomatis.',
        'info'
      );

      setTimeout(() => {
        window.location.href = "/logout"
      }, 500);
    } else if (result.value) {
      hnotif.empty();
      hnotif.hide();
      resetTimer();

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
        window.location.href = "/logout"
      }, 500);
    }
  });


}

document.addEventListener('mousemove', resetTimer);
document.addEventListener('keypress', resetTimer);
resetTimer();
