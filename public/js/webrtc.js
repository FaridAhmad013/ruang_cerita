class WebRTC {
  static getPermissionWebRTC() {
    navigator.mediaDevices.getUserMedia({ video: false, audio: true })
      .then(function (stream) {
        WebRTC.setIP()
      })
      .catch(function (error) {
        Swal.fire({
          title: 'Perlu Izin Audio',
          text: 'Silakan untuk hapus website dari daftar block, dan izinkan audio',
          // type: 'info',
          allowOutsideClick: false,
          showCancelButton: false,
          showConfirmButton: false,
        })
        console.error('Gagal mendapatkan akses ke perangkat webrtc:', error);
      });
  }

  static getLocalIP() {
    return new Promise((resolve, reject) => {
      // Buat peer connection tanpa menghubungkannya ke server sinyal
      const pc = new RTCPeerConnection();

      pc.onicecandidate = (e) => {
        if (e.candidate) {
          const ipAddress = this.parseIPAddress(e.candidate.candidate);
          if (ipAddress) {
            resolve(ipAddress);
          }
        }
      };

      pc.createDataChannel("");
      pc.createOffer()
        .then(offer => pc.setLocalDescription(offer))
        .catch(error => reject(error));
    });
  }

  static parseIPAddress(candidateStr) {
    const ipAddressRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3})/;
    const match = candidateStr.match(ipAddressRegex);
    if (match) {
      return match[0];
    }
    return null;
  }

  static setIP() {
      console.log( navigator.permissions)
    navigator.permissions.query({ name: 'microphone' })
      .then(permissionStatus => {
        if (permissionStatus.state === 'granted') {
          WebRTC.getLocalIP().then((ip) => {
            $('#ipz').val(ip);
            $('#wow').show();
          })
        }
      })
      .catch(error => {
          navigator.mediaDevices.getUserMedia( { audio: true } )
            .then( function ( stream ) {
                WebRTC.getLocalIP().then( ( ip ) => {
                    $( '#ipz' ).val( ip );
                    $( '#wow' ).show();
                } )
            } )
            .catch( function ( error ) {
                console.error( 'Error accessing the microphone:', error );
            } );
      });
  }
}
