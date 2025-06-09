<?php

namespace App\Helpers;

class ConstantUtility{

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';
    const STATUS_NEED_APPROVAL = 'NEED_APPROVAL';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_REVISION = 'REVISION';

    //mail
    // const SENDER_EMAIL = 'noreply@perbarindo.org';
    const SENDER_EMAIL = 'noreply@perbarindo.id';
    const SENDER_NAME = 'PERBARINDO';

    //log
    const LOG_RESET_PASSWORD = 'RESET PASSWORD';
    const LOG_GAGAL_LOGIN = 'GAGAL LOGIN';
    const LOG_GANTI_PASSWORD = 'GANTI PASSWORD';
    const LOG_BERHASIL_LOGIN = 'BERHASIL LOGIN';
    const LOG_UPLOAD_DOKUMEN = 'UPLOAD DOKUMEN';
    const LOG_ACTIVATION_SMKI_ACCOUNT = 'AKUN SMKI TELAH DIAKTIVASI';
}
