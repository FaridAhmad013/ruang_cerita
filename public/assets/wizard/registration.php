<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Billing | Registrasi</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/registration/css/bd-wizard.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/wait-me/waitMe.min.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/jquery-validation-engine/css/validationEngine.jquery.css">
  <link rel="stylesheet" href="<?= base_url('assets') ?>/css/font-awesome.css">
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-sm navbar-light bg-white">
      <div class="container">
        <a class="navbar-brand" href="<?= base_url();?>"><img src="<?= base_url('assets') ?>/images/logo/logo.png" alt="logo"></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
          aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url();?>">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main class="d-flex align-items-center" style="background-color: #eeeff1;">
    <div class="container">
        <form id="frm-registration">
            <div id="wizard">

                <input type="hidden" id="s_service_id" name="service_id" value="">
                <input type="hidden" id="s_service_plan_id" name="service_plan_id" value="">
                <input type="hidden" id="s_voucher_amount" name="voucher_amount" value="0">
                <input type="hidden" id="s_total_amount" name="total_amount" value="">
                <input type="hidden" id="s_grand_total_amount" name="grand_total_amount" value="">
                <input type="hidden" id="s_voucher_total_amount" name="voucher_total_amount" value="0">
                <input type="hidden" id="s_voucher_code" name="voucher_code" value="">
                <input type="hidden" id="s_cut_off_date" name="cut_off_date" value="<?= invoice('CUT_OFF'); ?>">
                <input type="hidden" id="s_diff_day" name="diff_day" value="">
                <input type="hidden" id="s_payment_method" name="payment_method" value="">
                <input type="hidden" id="s_is_adjustment" name="is_adjustment" value="0">
                <input type="hidden" id="s_total_adjustment" name="total_adjustment" value="0">
                <input type="hidden" id="s_application_document" name="application_document" value="">
                <input type="hidden" id="s_sender" name="sender" value="<?= $sender; ?>">

                <h3>Step 1 Title</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Step 1</h5>
                    <h2 class="section-heading">Formulir Pendaftaran</h2>
                    <p>Silahkan isi formulir pendaftaran berikut :</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Jenis Pendaftaran
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Daftar sebagai :</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="customer_type" id="rumahan_option" value="1" checked>
                                            <label class="form-check-label" for="rumahan_option">
                                                Pelanggan Rumahan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="customer_type" id="mitra_option" value="0">
                                            <label class="form-check-label" for="mitra_option">
                                                Mitra
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="card" id="form-rumahan">
                                <div class="card-header">
                                    Formulir Pendaftaran Pelanggan Rumahan
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="fullname_1">Nama Lengkap</label>
                                        <input type="text" name="fullname_1" id="fullname_1" class="form-control validate[required]" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="form-group">
                                        <label for="address_1">Alamat</label>
                                        <textarea name="address_1" id="address_1" class="form-control validate[required]" placeholder="Alamat"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="area_1">Area</label>
                                        <select class="form-control validate[required]" name="area_1" id="area_1">
                                            <option value="">[PILIH AREA]</option>
                                            <?php foreach($area as $a){ ?>
                                                <option value="<?= $a['id']; ?>"><?= $a['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email_1">Email</label>
                                        <input type="text" name="email_1" id="email_1" class="form-control validate[required]" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="whatsapp_1">No Whatsapp</label>
                                        <input type="text" name="whatsapp_1" id="whatsapp_1" class="form-control validate[required]" value="<?= (is_numeric($ref)) ? $ref : ''; ?>" <?= (is_numeric($ref)) ? 'readonly' : ''; ?> placeholder="No Whatsapp">
                                    </div>
                                    <div class="form-group">
                                        <label for="upload_ktp_1">Upload Foto KTP</label>
                                        <input type="file" name="upload_ktp_1" id="upload_ktp_1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="upload_selfie_photo">Upload Foto Selfie</label>
                                        <input type="file" name="upload_selfie_photo" id="upload_selfie_photo" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="upload_house_photo">Upload Foto Rumah</label>
                                        <input type="file" name="upload_house_photo" id="upload_house_photo" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="upload_signature_photo">Upload Tanda Tangan</label>
                                        <input type="file" name="upload_signature_photo" id="upload_signature_photo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card" style="display:none;" id="form-mitra">
                                <div class="card-header">
                                    Formulir Pendaftaran Mitra
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="fullname_2">Nama Lengkap</label>
                                        <input type="text" name="fullname_2" id="fullname_2" class="form-control validate[required]" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="form-group">
                                        <label for="address_2">Alamat</label>
                                        <textarea name="address_2" id="address_2" class="form-control validate[required]" placeholder="Alamat"></textarea>
                                    </div>
                                     <div class="form-group">
                                        <label for="area_2">Area</label>
                                        <select class="form-control validate[required]" name="area_2" id="area_2">
                                            <option value="">[PILIH AREA]</option>
                                            <?php foreach($area as $a){ ?>
                                                <option value="<?= $a['id']; ?>"><?= $a['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email_2">Email</label>
                                        <input type="text" name="email_2" id="email_2" class="form-control validate[required]" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="whatsapp_2">No Whatsapp</label>
                                        <input type="text" name="whatsapp_2" id="whatsapp_2" class="form-control validate[required]" value="<?= (is_numeric($ref)) ? $ref : ''; ?>"  <?= (is_numeric($ref)) ? 'readonly' : ''; ?> placeholder="No Whatsapp">
                                    </div>
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" id="nik" class="form-control validate[required]" placeholder="NIK">
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile_phone">No HP</label>
                                        <input type="text" name="mobile_phone" id="mobile_phone" class="form-control validate[required]" placeholder="Nomor HP">
                                    </div>
                                    <div class="form-group">
                                        <label for="telp">Telp</label>
                                        <input type="text" name="telp" id="telp" class="form-control" placeholder="Telp">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_sector">Nama Usaha</label>
                                        <input type="text" name="company_sector" id="company_sector" class="form-control validate[required]" placeholder="Nama Usaha">
                                    </div>
                                    <div class="form-group">
                                        <label for="jobposition">Jabatan</label>
                                        <input type="text" name="jobposition" id="jobposition" class="form-control" placeholder="Jabatan">
                                    </div>
                                    <div class="form-group">
                                        <label for="company_npwp">No NPWP</label>
                                        <input type="text" name="company_npwp" id="company_npwp" class="form-control" placeholder="No NPWP">
                                    </div>
                                    <div class="form-group">
                                        <label for="share_location">Share Lokasi</label>
                                        <input type="text" name="share_location" id="share_location" class="form-control" placeholder="Share Lokasi">
                                    </div>
                                    <div class="form-group">
                                        <label for="upload_ktp_2">Upload Foto KTP</label>
                                        <input type="file" name="upload_ktp_2" id="upload_ktp_2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="upload_npwp">Upload NPWP</label>
                                        <input type="file" name="upload_npwp" id="upload_npwp" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="upload_nib">Upload NIB/Akta Notaris</label>
                                        <input type="file" name="upload_nib" id="upload_nib" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="upload_server_photo">Upload Foto Server Usaha</label>
                                        <input type="file" name="upload_server_photo" id="upload_server_photo" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section>
                <h3>Step 2 Title</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Step 2</h5>
                    <h2 class="section-heading">Pilih Layanan & Paket</h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="purpose-radios-wrapper" id="product_services"></div>
                        </div>
                    </div>
                    <br>
                    <div class="service_product_detail">
                    <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets')?>/images/bg-login.jpg" class="card-img">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title" id="selected_product_title"></h5>
                            <p class="card-text" id="selected_product_description"></p>
                            <table class="table">
                                <tbody id="selected_product_price_detail"></tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </section>
                <h3>Step 3 Title</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Step 3</h5>
                    <h2 class="section-heading mb-5">Akun Billing</h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">Nama Depan</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control validate[required]" placeholder="Nama Depan">
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Nama Belakang</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control validate[required]" placeholder="Nama Belakang">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control validate[required,custom[email]]" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control validate[required,minSize[5]]" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control validate[required,minSize[5]]" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Konfirmasi Password</label>
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control validate[required,equals[password]]" placeholder="Konfirmasi Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <h3>Step 4 Title</h3>
                <section>
                        <h5 class="bd-wizard-step-title">Step 4</h5>
                        <h2 class="section-heading mb-5">Checkout</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Informasi Pelanggan
                                    </div>
                                    <div class="card-body">
                                        
                                        <table style="width:100%;">
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td>:</td>
                                                <td id="summary_fullname">-</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:</td>
                                                <td id="summary_address">-</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td id="summary_email">-</td>
                                            </tr>
                                            <tr>
                                                <td>No Whatsapp</td>
                                                <td>:</td>
                                                <td id="summary_whatsapp">-</td>
                                            </tr>
                                            <tr class="summary_mitra">
                                                <td>NIK</td>
                                                <td>:</td>
                                                <td id="summary_nik">-</td>
                                            </tr>
                                            <tr class="summary_mitra">
                                                <td>No HP</td>
                                                <td>:</td>
                                                <td id="summary_mobile_phone">-</td>
                                            </tr>
                                            <tr class="summary_mitra">
                                                <td>No Telp</td>
                                                <td>:</td>
                                                <td id="summary_telp">-</td>
                                            </tr>
                                            <tr class="summary_mitra">
                                                <td>Nama Usaha</td>
                                                <td>:</td>
                                                <td id="summary_company_sector">-</td>
                                            </tr>
                                            <tr class="summary_mitra">
                                                <td>Jabatan</td>
                                                <td>:</td>
                                                <td id="summary_jobposition">-</td>
                                            </tr>
                                            <tr class="summary_mitra">
                                                <td>No NPWP</td>
                                                <td>:</td>
                                                <td id="summary_company_npwp">-</td>
                                            </tr>
                                            <tr class="summary_mitra">
                                                <td>Share Lokasi</td>
                                                <td>:</td>
                                                <td id="summary_share_location">-</td>
                                            </tr>
                                        </table>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Informasi Layanan
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title" id="summary_service_name">-</h5>
                                        <p class="card-text" id="summary_service_desc">-</p>
                                        <table style="width:100%;">
                                            <tbody id="summary_detail_fee">
                                                
                                            </tbody>
                                            <tfoot style="border-top: solid 1px #ddd;">
                                                <tr>
                                                    <td>Voucher</td>
                                                    <td id="summary_voucher_amount">-</td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td id="summary_grand_total">-</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <br>
                                        <div class="alert alert-danger outline" role="alert" style="display:none" id="alert-penyesuaian">
                                            <p>Nominal biaya langganan per bulan : <span id="original_monthly_fee"></span>, namun karena penyesuaian duedate setiap tanggal <?= invoice('CUT_OFF'); ?> maka biaya langganan bulan ini menjadi <span id="total_monthly_fee"></span></p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="card">
                                    <div class="card-header">
                                        Voucher
                                    </div>
                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Kode Voucher" id="voucher" aria-label="Kode Voucher" aria-describedby="btn-voucher">
                                            <button class="btn btn-outline-secondary" type="button" id="btn-voucher">Terapkan</button>
                                        </div>
                                        <div class="voucher-container" style="display:none">
                                            <img src="" class="voucher" id="voucher-banner">
                                            <div class="voucher-label">
                                            <p class="voucher-name"></p>
                                            <p class="voucher-amount"></p>
                                            </div>
                                            <button class="btn btn-danger" type="button" id="delete-voucher">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="card" id="payment_method_card">
                                    <div class="card-header">
                                        Metode Pembayaran
                                    </div>
                                    <div class="card-body" style="max-height: 300px;overflow-y: auto;">
                                        <?php foreach($payment_methods as $pm){ ?>
                                        <label class="service">
                                            <input type="radio" name="payment_method" value="<?= $pm['channel_id']; ?>" class="card-input-element d-none">
                                            <div class="card bg-light">
                                                <div class="card-body flex-row d-flex justify-content-between align-items-center">
                                                <h6><?= $pm['channel']; ?></h6>
                                                </div>
                                            </div>
                                        </label>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
                <h3>Step 5 Title</h3>
                <section>
                    <h5 class="bd-wizard-step-title">Step 5</h5>
                    <h2 class="section-heading mb-5">Informasi Pembayaran</h2>
                    <div class="card">
                        <div class="card-body">

                            <div class="free_registration_success" style="display:none;">
                                <div class="alert alert-success outline alert-dismissible fade show" role="alert">
                                    <i class="fa fa-check" style="float: left;margin-right: 10px;margin-top: 5px;"></i>
                                    <p style="margin:0px;"><b> Well done! </b>Proses checkout sukses</p>
                                </div>
                                
                                <p>Yey! Proses pendaftaran layanan kali ini tanpa dikenai biaya atau gratis.</p>
                                <p>Klik Login untuk untuk masuk ke halaman billing anda</p>   
                                <br>
                                <a href="<?= base_url(); ?>" class="btn btn-danger">Login ke Billing</a>   
                            </div>

                            <div class="inquiry_success" style="display:none;">
                                <div class="alert alert-success outline alert-dismissible fade show" role="alert">
                                    <i class="fa fa-check" style="float: left;margin-right: 10px;margin-top: 5px;"></i>
                                    <p style="margin:0px;"><b> Well done! </b>Proses checkout sukses</p>
                                </div>

                                <p>Silahkan lakukan pembayaran melalui link pembayaran berikut :</p>
                                <div class="alert alert-primary inverse fade show" role="alert">
                                    <i class="fa fa-link" style="float: left;margin-right: 10px;margin-top: 5px;"></i>
                                    <p style="margin:0px;"><a id="payment_link" href="#" target="_blank">https://google.com</a></p>
                                </div>
                                
                                <p>Link pembayaran diatas masih bisa anda akses lewat menu Invoice.</p>
                                <p>Klik Login untuk untuk masuk ke halaman billing anda</p>   
                                <br>
                                <a href="<?= base_url(); ?>" class="btn btn-danger">Login ke Billing</a>   
                            </div>

                            <div class="va_inquiry_success" style="display:none;">
                                <div class="alert alert-success outline alert-dismissible fade show" role="alert">
                                    <i class="fa fa-check" style="float: left;margin-right: 10px;margin-top: 5px;"></i>
                                    <p style="margin:0px;"><b> Well done! </b>Proses checkout sukses</p>
                                    
                                </div>

                                <p>Silahkan lakukan pembayaran melalui kode virtual account berikut :</p>
                                <div class="alert alert-primary inverse fade show" role="alert">
                                    <i class="fa fa-credit-card" style="float: left;margin-right: 10px;margin-top: 5px;"></i>
                                    <p style="margin:0px;"><a id="btn_virtual_account" href="javascript:copyText('virtual_account');" data-clipboard-text="" class="va_number"><span id="virtual_account">753787387873777788</span></a></p>
                                </div>
                                
                                <p>Kode Virtual Account diatas masih bisa anda lihat lewat menu Invoice.</p>
                                <p>Klik Login untuk untuk masuk ke halaman billing anda</p> 
                                <br>
                                <a href="<?= base_url(); ?>" class="btn btn-danger">Login ke Billing</a>
                            </div>
                            <br>
                            <div class="inquiry_failed" style="display:none;">
                                <div class="alert alert-danger outline alert-dismissible fade show" role="alert">
                                    <i class="fa fa-close" style="float: left;margin-right: 10px;margin-top: 5px;"></i>
                                    <p style="margin: 0px;"><b> Oops! </b>Proses checkout gagal</p>
                                </div>

                                <p>Mohon maaf telah terjadi kesalahan saat inquiry pembayaran. Silahkan coba lagi nanti</p>
                                <br>
                                <a href="<?= base_url(); ?>register" class="btn btn-danger">Ok</a>
                            </div>
                        </div>
                    </div>
                </section>
            
            </div>
        </form>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/moment-timezone/moment.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/moment-timezone/moment-timezone.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/wait-me/waitMe.min.js"></script>
  <script src="<?= base_url('assets') ?>/registration/js/jquery.steps.min.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/jquery-validation-engine/js/languages/jquery.validationEngine-en.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/jquery-validation-engine/js/jquery.validationEngine.js"></script>
  <script src="<?= base_url('assets') ?>/plugins/clipboard/clipboard.min.js"></script>
 
  <script type="text/javascript">
    var base_url = '<?= base_url(); ?>';
    
    var step3_valid = false;
    var step4_valid = false;

    $(document).ready(function(){
        
        changeProductService(1);
        $(".summary_mitra").hide();

        $.fn.steps.setStep = function (step)
        {
            var currentIndex = $(this).steps('getCurrentIndex');
            for(var i = 0; i < Math.abs(step - currentIndex); i++){
                if(step > currentIndex) {
                $(this).steps('next');
                }
                else{
                $(this).steps('previous');
                }
            } 
        };

        $("#wizard").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "none",
            stepsOrientation: "vertical",
            titleTemplate: '<span class="number">#index#</span>',
            onStepChanging: function(e, currentIndex, newIndex) {
                
                if (newIndex < currentIndex) {
                    return true;
                }

                if(newIndex == 1){

                    if($('#rumahan_option').is(':checked')){
                        if(!$("#fullname_1").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#address_1").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#area_1").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#email_1").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#whatsapp_1").validationEngine('validate') == true){
                            return false;
                        }
                    }

                    if($('#mitra_option').is(':checked')){
                        if(!$("#fullname_2").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#address_2").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#area_2").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#email_2").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#whatsapp_2").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#nik").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#mobile_number").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#company_sector").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#jobposition").validationEngine('validate') == true){
                            return false;
                        }
                        if(!$("#company_npwp").validationEngine('validate') == true){
                            return false;
                        }
                    }

                    return true;
                }else if(newIndex == 2){
                    return true;
                }else if(newIndex == 3){

                    if(step3_valid){
                        return true;
                    }

                    if(!$("#first_name").validationEngine('validate') == true){
                        return false;
                    }
                    if(!$("#last_name").validationEngine('validate') == true){
                        return false;
                    }
                    if(!$("#email").validationEngine('validate') == true){
                        return false;
                    }
                    if(!$("#username").validationEngine('validate') == true){
                        return false;
                    }
                    if(!$("#password").validationEngine('validate') == true){
                        return false;
                    }
                    if(!$("#confirm_password").validationEngine('validate') == true){
                        return false;
                    }

                    $('body').waitMe({
                        effect : 'pulse',
                        text : 'Checking Existing Account ...',
                        bg : 'rgba(255,255,255,0.7)',
                        color : '#000',
                        maxSize : '',
                        waitTime : -1,
                        textPos : 'vertical'
                    });
                    $.post(base_url + 'register/check_account', { username : $("#username").val() , email : $("#email").val() }, (res) => {
                        console.log(res);
                        $('body').waitMe('hide');
                        if(res.exist != "0"){

                            alert("Username atau Email sudah terdaftar !");
                            
                        }else{
                           
                            step3_valid = true;

                            $("#wizard").steps("setStep", 3);

                        }
                        
                    },'json').fail((err)=>{
                        console.log(err);
                        $('body').waitMe('hide');
                    });

                }else if(newIndex == 4){

                    if(step4_valid){
                        return true;
                    }

                    let grand_total = $("#s_grand_total_amount").val();
                    let payment_method = $("input[name='payment_method']:checked").val();

                    if(grand_total != "0"){
                        if(!payment_method) {
                        
                            alert('Mohon pilih metode pembayaran!');

                            return false;

                        }else{
                            
                            
                            $("#s_payment_method").val(payment_method);
                            
                            submitRegistration();

                        }

                    }else{
                        
                        submitFreeRegistration();
            
                    }
                
                }
               
            },
            onFinishing: function(e, currentIndex) {
                
            },
            onFinished: function(e, currentIndex) {
                
            }
        });

        numeral.register('locale', 'id', {
            delimiters: {
                thousands: '.',
                decimal: ','
            },
            abbreviations: {
                thousand: 'k',
                million: 'm',
                billion: 'b',
                trillion: 't'
            },
            ordinal : function (number) {
                return number === 1 ? 'er' : 'ème';
            },
            currency: {
                symbol: 'Rp'
            }
        });
        numeral.locale('id');

        $("#fullname_1").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_fullname").text(value);
        
        });

        $("#fullname_2").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_fullname").text(value);
        
        });

        $("#address_1").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_address").text(value);
        
        });

        $("#address_2").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_address").text(value);
        
        });

        $("#email_1").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_email").text(value);
        
        }); 

        $("#email_2").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_email").text(value);
        
        });
        
        $("#whatsapp_1").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_whatsapp").text(value);
        
        }); 

        $("#whatsapp_2").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_whatsapp").text(value);
        
        }); 


        $("#nik").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_nik").text(value);
        
        });

        $("#mobile_phone").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_mobile_phone").text(value);
        
        });

        $("#telp").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_telp").text(value);
        
        });

        $("#jobposition").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_jobposition").text(value);
        
        });

        $("#company_npwp").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_company_npwp").text(value);
        
        });

        $("#company_sector").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_company_sector").text(value);
        
        });


        $("#share_location").on("keyup", function(){
            
            let value = $(this).val();
            $("#summary_share_location").text(value);
        
        });
    
        $('input:radio[name="customer_type"]').change(
        function(){
            if ($(this).is(':checked') && $(this).val() == '1') {
                
                $("#rumahan_option").attr("checked","checked");
                $("#form-rumahan").show();
                $("#form-mitra").hide();
                $(".summary_mitra").hide();

                changeProductService(1);

            }else{
                
                $("#mitra_option").attr("checked","checked");
                $("#form-rumahan").hide();
                $("#form-mitra").show();
                $(".summary_mitra").show();

                changeProductService(2);
            }
        });
       
        $("#btn-voucher").click(function(){

            var voucher_code = $("#voucher").val();

            $('body').waitMe({
                effect : 'pulse',
                text : 'Loading',
                bg : 'rgba(255,255,255,0.7)',
                color : '#000',
                maxSize : '',
                waitTime : -1,
                textPos : 'vertical'
            });

            $.post(base_url + 'service/apply_voucher', { voucher_code : voucher_code }, function(res){

                if(res.status){
                    let amount = "";
                    let total_amount = $("#s_total_amount").val();
                    let deduction = 0;
                    let grand_total = 0;

                    if(res.data.type == "percentage"){

                        amount = res.data.amount + '%';
                        deduction = (parseInt(res.data.amount) / 100) * parseInt(total_amount);
                        grand_total = parseInt(total_amount) - deduction;
                    
                        
                    }else{

                        amount = numeral(parseInt(res.data.amount)).format();
                        deduction = parseInt(res.data.amount);
                        grand_total = parseInt(total_amount) - deduction;

                    }

                    if(grand_total == 0){
                        $("#payment_method_card").hide();
                    }else{
                        $("#payment_method_card").show();
                    }
                    
                    $("#s_voucher_total_amount").val(deduction);
                    $("#s_voucher_amount").val(res.data.amount);
                    $("#s_grand_total_amount").val(grand_total);
                    $("#s_voucher_code").val(voucher_code);

                    $("#voucher-banner").attr("src", base_url + '/uploads/' + res.data.image);
                    $(".voucher-name").text(res.data.name);
                    $(".voucher-amount").text("Potongan " + amount);

                    $("#summary_voucher_amount").html('Rp <span style="float:right">' + numeral(deduction).format() + '</span>');
                    $("#summary_grand_total").html('Rp <span style="float:right">' + numeral(grand_total).format() + '</span>');
                    
                    $(".voucher-container").show();
                }else{
                    $(".voucher-container").hide();

                    alert("Voucher tidak valid/kadaluarsa");
                
                }
                $('body').waitMe("hide");
            },'json').fail(function(err){ 
                $('body').waitMe("hide");
            });

        });

        $("#delete-voucher").click(function(){

            let total_amount = $("#s_total_amount").val();


            $("#payment_method_card").show();
            $(".voucher-container").hide();

            $("#summary_voucher_amount").html('-');
            $("#summary_grand_total").html('Rp <span style="float:right">' + numeral(total_amount).format() + '</span>');

            $("#s_voucher_total_amount").val(0);
            $("#s_grand_total_amount").val(total_amount);
            $("#s_voucher_code").val("");
            $("#voucher").val("");

        });

    });


    function changeProductService(customer_type){

        $('body').waitMe({
            effect : 'pulse',
            text : 'Loading ...',
            bg : 'rgba(255,255,255,0.7)',
            color : '#000',
            maxSize : '',
            waitTime : -1,
            textPos : 'vertical'
        });

        $.get(base_url + 'register/get_services/'+customer_type, (res) => {
            console.log(res);
            
            let template_services = ""; 
            let template_service_fees = "";
            
            $.each(res.services,(i, item) => {
                
                let checked = "";

                if(i == 0){
                    checked = "checked";
                    setProductFeeDetail(item);

                    $("#selected_product_title").text(item.name);
                    $("#selected_product_description").text(item.description);
                }

                template_services += '<div class="purpose-radio">';
                template_services += '<input type="radio" name="purpose" id="service_'+item.id+'" class="purpose-radio-input" value=\''+JSON.stringify(item)+'\' '+checked+'>';
                template_services += '<label for="service_'+item.id+'" class="purpose-radio-label">';
                template_services += '<span class="label-icon">';
                template_services += '<img src="'+base_url+'/assets/images/wireless-router-off.png" alt="service_'+item.id+'" class="label-icon-default service-logo">';
                template_services += '<img src="'+base_url+'/assets/images/wireless-router-on.png" alt="service_'+item.id+'" class="label-icon-active service-logo">';
                template_services += '</span>';
                template_services += '<span class="label-text">'+item.name+'</span>';
                template_services += '<span class="label-text">Rp '+numeral(item.service_price).format()+'</span>';
                template_services += '</label>';
                template_services += '</div>';

            });


            $("#product_services").html(template_services);

            $('input:radio[name="purpose"]').change(
            function(){
                
                let value = $(this).val();
                let data = JSON.parse(value);
                
                $("#selected_product_title").text(data.name);
                $("#selected_product_description").text(data.description);
                $("#selected_product_package").text(data.package_name);

                $("#selected_product_price_detail").html("<tr><td style='text-align: center;padding-top: 50px;'><img style='height:50px;' src='"+base_url+"/assets/images/loader.svg' /></td></tr>");

                setProductFeeDetail(data);

            });

            $('body').waitMe('hide');
        },'json').fail((err)=> {
            console.log(err);
            $('body').waitMe('hide');
        });

    }

    function submitRegistration(){

        $('body').waitMe({
            effect : 'pulse',
            text : 'Loading ...',
            bg : 'rgba(255,255,255,0.7)',
            color : '#000',
            maxSize : '',
            waitTime : -1,
            textPos : 'vertical'
        });
       
        var formData = new FormData($("#frm-registration")[0]);
        var url = base_url + 'register/make_order';
        
        $.ajax({
            type:'POST',
            url: url,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(res){
                            
                if(res.status){
                    
                    step4_valid = true;

                    if(res.hasOwnProperty('data')){

                        if(res.data.hasOwnProperty('link_url')){

                            $("#payment_link").attr('href','https://'+res.data.link_url);
                            $("#payment_link").html('Link Pembayaran');

                            $(".inquiry_failed").hide();
                            $(".va_inquiry_success").hide();
                            $(".free_registration_success").hide();
                            $(".inquiry_success").show();

                            $("#wizard > .actions").hide();

                        }else if(res.data.hasOwnProperty('paymentUrl') && !res.data.hasOwnProperty('vaNumber')){

                            $("#payment_link").attr('href',res.data.paymentUrl);
                            $("#payment_link").html('Link Pembayaran');

                            $(".inquiry_failed").hide();
                            $(".va_inquiry_success").hide();
                            $(".free_registration_success").hide();
                            $(".inquiry_success").show();

                            $("#wizard > .actions").hide();

                        }else if(res.data.hasOwnProperty('vaNumber')){

                            $("#virtual_account").html(res.data.vaNumber);
                            $("#btn_virtual_account").attr("data-clipboard-text",res.data.vaNumber);

                            $(".inquiry_failed").hide();
                            $(".va_inquiry_success").show();
                            $(".inquiry_success").hide();
                            $(".free_registration_success").hide();

                            $("#wizard > .actions").hide();

                        }else{

                            $(".inquiry_failed").show();
                            $(".inquiry_success").hide();
                            $(".va_inquiry_success").hide();
                            $(".free_registration_success").hide();

                        }

                    }else{

                        $(".inquiry_failed").show();
                        $(".inquiry_success").hide();
                        $(".va_inquiry_success").hide();
                        $(".free_registration_success").hide();

                    }

                    $("#wizard").steps("setStep", 4);

                }else{

                    $(".inquiry_failed").show();
                    $(".inquiry_success").hide();
                    $(".va_inquiry_success").hide();
                    $(".free_registration_success").hide();

                }

                $('body').waitMe('hide');
            },
            error: function(data){
                
                $(".inquiry_failed").show();
                $(".inquiry_success").hide();
                $(".va_inquiry_success").hide();
                $(".free_registration_success").hide();
                $('body').waitMe('hide');

                
            }
        });


    }

    function submitFreeRegistration(){

        $('body').waitMe({
            effect : 'pulse',
            text : 'Loading ...',
            bg : 'rgba(255,255,255,0.7)',
            color : '#000',
            maxSize : '',
            waitTime : -1,
            textPos : 'vertical'
        });

        var formData = new FormData($("#frm-registration")[0]);
        var url = base_url + 'register/make_free_order';

        $.ajax({
            type:'POST',
            url: url,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(res){
                            
                if(res.status){
                    
                    step5_valid = true;

                    $(".free_registration_success").show();
                    $(".inquiry_failed").hide();
                    $(".inquiry_success").hide();
                    $(".va_inquiry_success").hide();

                    $("#wizard").steps("setStep", 5);

                }else{

                    $(".free_registration_success").hide();
                    $(".inquiry_failed").show();
                    $(".inquiry_success").hide();
                    $(".va_inquiry_success").hide();

                }

                $('body').waitMe('hide');
            },
            error: function(data){
                
                $(".free_registration_success").hide();
                $(".inquiry_failed").show();
                $(".inquiry_success").hide();
                $(".va_inquiry_success").hide();
                $('body').waitMe('hide');
                
            }
        });

    }

    function copyText(id){

        var clipboard = new ClipboardJS('#btn_'+id);

        clipboard.on('success', function(e) {
            console.info('Action:', e.action);
            console.info('Text:', e.text);
            console.info('Trigger:', e.trigger);
            e.clearSelection();
            alert("copied : "+e.text);
        });

        clipboard.on('error', function(e) {
            console.error('Action:', e.action);
            console.error('Trigger:', e.trigger);
        });

    }

    function setProductFeeDetail(data){
        let template = '';
        let template2 = '';

        template2+='<tr>';
        template2+='<td style="border: none;">1</td>';
        template2+='<td style="border: none;border-left: solid 1px;">'+data.name+' - '+data.package_name+'</td>';
        template2+='<td style="border: none;border-left: solid 1px;"></td>';
        template2+='</tr>';

        $.post(base_url + 'register/product_fee/', { service_id : data.id }, (res) => {
            
            if(res.hasOwnProperty('status')){

                if(res.status){
                    $.each(res.data,(i,item)=>{

                        template += '<tr>';
                        template += '<td>'+item.name+'</td>';
                        template += '<td>Rp <span style="float:right">'+numeral(item.fee).format()+'</span></td>';
                        template += '</tr>';

                        template2 += '<tr>';
                        template2 += '<td style="border: none;"></td>';
                        template2 += '<td style="border: none;border-left: solid 1px;">'+item.name+'</td>';
                        template2 += '<td style="border: none;border-left: solid 1px;">Rp <span style="float:right">'+numeral(item.fee).format()+'</span></td>';
                        template2 += '</tr>';

                    });

                    $("#summary_service_name").text(data.name);
                    $("#summary_service_desc").text(data.description);
                    $("#summary_detail_fee").html(template);
                    $("#summary_grand_total").html('Rp <span style="float:right">'+numeral(data.service_price).format()+'</span>');


                    $("#s_service_id").val(data.id);
                    $("#s_service_plan_id").val(data.package_id);
                    $("#s_total_amount").val(data.service_price);
                    $("#s_grand_total_amount").val(data.service_price);

                    $.get(base_url + 'register/check_penyesuaian/'+data.id, (res)=>{
                        
                        $("#s_diff_day").val(res.diff_day);

                        if(res.diff_day != '0'){

                            $("#summary_grand_total").html('Rp <span style="float:right">'+numeral(res.total_amount).format()+'</span>');
                           
                            $("#original_monthly_fee").text(numeral(res.original_monthly_fee).format());
                            $("#total_monthly_fee").text(numeral(res.total_monthly_fee).format());
                            $("#s_total_amount").val(res.total_amount);
                            $("#s_grand_total_amount").val(res.total_amount);
                            $("#s_total_adjustment").val(res.total_monthly_fee);
                            $("#s_is_adjustment").val('1');

                            $("#alert-penyesuaian").show();
                        }else{
                            $("#alert-penyesuaian").hide();
                            $("#s_is_adjustment").val('0');
                        }

                    },'json').fail((err)=>{
                        console.log(err);
                    });

                   
                    template += '<tr>';
                    template += '<td>Total</td>';
                    template += '<td>Rp <span style="float:right">'+numeral(data.service_price).format()+'</span></td>';
                    template += '</tr>';

                    $("#selected_product_price_detail").html(template);

                   
                  
                }

            }

        },'json').fail((err)=>{
            console.log(err);
        })

    }

  </script>
</body>
</html>
