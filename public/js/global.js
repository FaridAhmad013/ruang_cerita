class Ryuna {
  static modal(params) {
    let { title, body, footer } = params
    $('#myModal #modal_title').html(title)
    $('#myModal #modal_body').html(body)
    $('#myModal #modal_footer').html(footer)
    $('#myModal').modal('show')
  }

  static check_match_ip() {
    $.get(base_url + 'admin/check_match_ip').fail(() => {
      Swal.fire(
        'Logout',
        'Alamat IP Anda sudah terhubung dengan perangkat lain. Anda akan logout dari perangkat ini.',
        'info'
      ).then(() => {
        window.location.href = base_url + 'logout'
      });

      setTimeout(() => {
        window.location.href = base_url + 'logout'
      }, 10000);

    })
  }

  static close_modal() {
    $('#myModal').modal('hide')
  }

  static large_modal() {
    $('#myModal .modal-dialog').addClass('modal-xl')
    $('#myModal .modal-dialog').on('click', '[data-dismiss="modal"]', function () {
      setTimeout(() => {
        $('#myModal .modal-dialog').removeClass('modal-xl')
      }, 500)
    })
  }

  static blockUI(message) {
    $.blockUI({
      message: '<span class="text-semibold"><img src="' + base_url + 'img/loading2.gif' + '" style="height: 21px;">' + (message ? message : ' Please Wait') + '</span>',
      baseZ: 10000,
      overlayCSS: {
        backgroundColor: 'rgba(0, 0, 0, 0.17)',
        opacity: 1,
        cursor: 'wait',
        'backdrop-filter': 'blur(2px)'
      },
      css: {
        'z-index': 10020,
        'padding': '10px 5px',
        'margin': '0px',
        'width': '20%',
        'top': '40%',
        'left': '40%',
        'text-align': 'center',
        'color': 'rgba(82, 95, 127, 1)',
        'border': '0px',
        'background-color': 'rgb(255, 255, 255)',
        'cursor': 'wait',
        'border-radius': '10px',
        // 'border': '2px rgba(82, 95, 127, 1) solid',
        'font-size': '16px',
        'min-width': "95px",
      }
    })
  }

  static blockElement(element, message) {
    $(element).block({
      message: '<span class="text-semibold"><img src="' + base_url + 'img/loading2.gif' + '" style="height: 21px;">' + (message ? message : ' Please Wait') + '</span>',
      baseZ: 10000,
      overlayCSS: {
        backgroundColor: 'rgba(0, 0, 0, 0.1)',
        opacity: 1,
        cursor: 'wait',
        'backdrop-filter': 'blur(0.5px)',
        'border-radius': '.4375rem'
      },
      css: {
        'z-index': 10020,
        'padding': '10px 5px',
        'margin': '0px',
        'width': '20%',
        'top': '40%',
        'left': '40%',
        'text-align': 'center',
        'color': 'rgba(82, 95, 127, 1)',
        'border': '0px',
        'background-color': 'rgb(255, 255, 255)',
        'cursor': 'wait',
        'border-radius': '.4375rem',
        // 'border': '2px rgba(82, 95, 127, 1) solid',
        'font-size': '16px',
        'min-width': "95px",
      }
    })
  }

  static unblockUI() {
    $.unblockUI()
  }

  static showHiddenPassword( selInput ) {
      try {
          let group = $( selInput ).parent();

          if ( group.children().length === 2 ) {
              let input = group.children().eq( 0 );
              let btn = group.children().eq(1);

              btn.on("click", function(e) {
                  if ( input.attr("type") === "password" ) {
                      input.attr("type", "text" );
                      btn.children().eq( 0 ).removeClass( "fa-eye-slash" ).addClass( "fa-eye" );
                  } else {
                      input.attr( "type", "password");
                      btn.children().eq( 0 ).removeClass( "fa-eye" ).addClass( "fa-eye-slash" );
                  }
              } );
          } else {
              console.log( "Failed to initialize show-hide password" );
          }
      } catch ( error ) {
          console.log( "Failed to initialize show-hide password" );
      }
  }


  static unblockElement(element) {
    $(element).unblock()
  }

  static input_nominal(element) {
    return new AutoNumeric(element, {
      decimalCharacter: ",",
      digitGroupSeparator: ".",
      emptyInputBehavior: "min",
      minimumValue: "0"
    })
  }

  static input_nominal_multiple(element) {
    new AutoNumeric.multiple(element, {
      decimalCharacter: ",",
      digitGroupSeparator: ".",
      emptyInputBehavior: "min",
      minimumValue: "0"
    })
  }

  static input_percent(element) {
    new AutoNumeric(element, {
      decimalCharacter: ",",
      digitGroupSeparator: ".",
      emptyInputBehavior: "min",
      minimumValue: "0",
      maximumValue: "100"
    })
  }

  static input_percent_multiple(element) {
    new AutoNumeric.multiple(element, {
      decimalCharacter: ",",
      digitGroupSeparator: ".",
      emptyInputBehavior: "min",
      minimumValue: "0",
      maximumValue: "100"
    })
  }

  static input_number_fixed(element) {
    return new AutoNumeric(element, {
      decimalCharacter: ",",
      digitGroupSeparator: ".",
      emptyInputBehavior: "min",
      minimumValue: "0",
      decimalPlaces: "0",
      decimalPlacesRawValue: "0"
    })
  }

  static format_nominal(nominal) {
    return new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(nominal);
  }

  static format_percent(nominal) {
    return new Intl.NumberFormat("id-ID", { currency: "IDR" }).format(nominal) + ' %';
  }


  static leftpad(num, targetLength) {
    return String(num).padStart(targetLength, '0')
  }

  static getSaldo() {
    let url_get_saldo = base_url + 'admin/get_saldo'
    $('.saldo-value').html('menyinkronkan ...')

    $('.btn-saldo-refresh').addClass('loading')
    setTimeout(() => {
      $.get(url_get_saldo).done((res) => {
        let saldo = res?.data.saldo
        saldo = Ryuna.format_nominal(saldo)
        $('.btn-saldo-refresh').removeClass('loading')
        $('.saldo-value').html(saldo)
      }).fail((xhr) => {
        let saldo = 0
        saldo = Ryuna.format_nominal(saldo)
        $('.btn-saldo-refresh').removeClass('loading')
        $('.saldo-value').html(saldo)

        Swal.fire( {
            title: xhr?.responseJSON?.message ? xhr.responseJSON.message : 'Internal Server Error',
            type: 'error',
            confirmButtonColor: '#007bff'
        } )
      })
    }, 2000)
  }

  static noty(type, title, message) {
    title = (title && title != null) ? `<strong>${title}</strong><br>` : ''
    new Noty({
      type: type,
      theme: 'mint',
      timeout: 6000,
      progressBar: true,
      text: `${title}${message}`
    }).show();
  }

  static summernote(element) {
    return $(element).summernote({
      placeholder: 'Ketik Sesuatu',
      tabsize: 2,
      height: 100
    });
  }

  static isEmail(email) {
    let regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return regex.test(email);
  }

  static isUsernameValid(username) {
    // username is alphanumeric, underscore, dot, and dash
    let first_rule = /^[a-zA-Z0-9._-]+$/

    // username is not start with underscore, dot, and dash
    // username is not end with underscore, dot, and dash
    let second_rule = /^[a-zA-Z0-9]+[a-zA-Z0-9._-]*[a-zA-Z0-9]+$/

    // underscore, dot, and dash is not repeated more than 1 time
    // underscore, dot, and dash is not side by side
    let third_rule = /([._-])[._-]/

    // username length is 5-20
    let fourth_rule = /^.{5,20}$/

    return {
      first_rule: first_rule.test(username),
      second_rule: second_rule.test(username),
      third_rule: !third_rule.test(username),
      fourth_rule: fourth_rule.test(username),
    }
  }

  static isPasswordValid(password) {
    var regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])[a-zA-Z0-9@#$%^&+=]{8,}$/;
    return regex.test(password);
  }

  static helpModal(key) {
    Ryuna.blockUI()
    const version = 'v1'
    let url = base_url + 'admin/wiki_content/help/' + version + '/' + key
    $.get(url).done((res) => {
      Ryuna.large_modal()
      Ryuna.modal({
        title: res?.title,
        body: res?.body,
        footer: res?.footer,
      })

      Ryuna.unblockUI()
    }).fail((xhr) => {
      Ryuna.unblockUI()
    })
  }

  static heightWindow() {
    let body = document.body,
      html = document.documentElement;

    let height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);
    return height
  }

  static fixInvalidJson(text_kun_dayo) {
    return text_kun_dayo.split('\n').join('').split('\t').join('').split('"{').join('{').split('}"').join('}').split("'{").join('{').split("}'").join('}');
  }

  static getNamaBulanIndonesia(bulan) {
    const namaBulan = [
      'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember',
    ];

    // Pastikan bulan berada dalam rentang 1 hingga 12
    if (bulan >= 1 && bulan <= 12) {
      return namaBulan[bulan - 1];
    } else {
      return 'Bulan tidak valid';
    }
  }

  static modal_export(url, param){
    Ryuna.blockUI()
    $.ajax({
      url: url,
      type: "get",
      data: param
    }).done((res) => {
      Ryuna.modal({
        title: res?.title,
        body: res?.body,
        footer: res?.footer
      })
      Ryuna.unblockUI()
    }).fail((xhr) => {
      Ryuna.unblockUI()
      Swal.fire({
        title: 'Whoops!',
        text: xhr?.responseJSON?.message ? xhr.responseJSON.message : 'Terjadi Kesalahan Internal',
        type: 'error',
        confirmButtonColor: '#007bff'
      })
    })
  }

  static format_tanggal_bahasa(tanggal) {
    const hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    const bulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    let m = moment(tanggal); // Gunakan moment.js
    let hariText = hari[m.day()]; // Ambil nama hari
    let tgl = m.date(); // Ambil tanggal
    let blnText = bulan[m.month()]; // Ambil nama bulan
    let thn = m.year(); // Ambil tahun

    return `${hariText}, ${tgl} ${blnText} ${thn}`;
  }
}


class Stepper {
  position = 1;
  max_step = 3;

  constructor(props) {
    let { max_step } = props
    if (max_step) {
      this.max_step = max_step
    }
  }

  prev() {
    if (this.position > 1) {
      this.position--
    }
  }

  next() {
    if (this.position < this.max_step) {
      this.position++
    }
  }
}

class Doom {
  static createElement(tag, prop = {}) {
    let $__el = document.createElement(tag);

    if (prop.attributes) {
      for (let [key, value] of Object.entries(prop.attributes)) {
        if (typeof value === 'boolean') {
          value && $__el.setAttribute(key, value)
          continue
        }
        $__el.setAttribute(key, value);
      }
    }

    if (prop.events) {
      for (let [event, callback] of Object.entries(prop.events)) {
        $__el.addEventListener(event, callback);
      }
    }

    for (let child in prop.children) {
      $__el.appendChild(prop.children[child]);
    }

    return $__el;
  }

  static tr(prop = {}) {
    return Doom.createElement("tr", prop);
  }

  static td(prop = {}) {
    return Doom.createElement("td", prop);
  }

  static select(prop = {}) {
    return Doom.createElement("select", prop);
  }

  static input(prop = {}) {
    return Doom.createElement("input", prop);
  }

  static button(prop = {}) {
    return Doom.createElement("button", prop);
  }

  static text(value) {
    return document.createTextNode(value);
  }

  static icon(name) {
    return Doom.createElement('i', {
      attributes: {
        class: name
      }
    });
  }
}
