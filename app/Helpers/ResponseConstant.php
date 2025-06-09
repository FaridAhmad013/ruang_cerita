<?php

namespace App\Helpers;

class ResponseConstant
{
    //Response Code
    const RC_SUCCESS = '0001';
    const RC_CREATE_SUCCESS = '0002';
    const RC_UPDATE_SUCCESS = '0003';
    const RC_DELETE_SUCCESS = '0004';
    const RC_SOFT_DELETE_SUCCESS = '0005';
    const RC_RESTORE_SUCCESS = '0006';
    const RC_LOGIN_SUCCESS = '0007';
    const RC_TRANSACTION_SUCCESS = '0008';
    const RC_ALREADY_EXISTS = '0101';
    const RC_NOT_FOUND = '0201';
    const RC_INVALID_USERNAME = '1101';
    const RC_INVALID_PASSWORD = '1102';
    const RC_INVALID_TRANSACTION = '1103';
    const RC_INVALID_AMOUNT = '1104';
    const RC_INVALID_BILL = '1105';
    const RC_INVALID_PRODUCT = '1106';
    const RC_INACTIVE = '1201';
    const RC_INACTIVE_CUSTOMERS = '1202';
    const RC_USER_ACCOUNT_BLOCKED = '1301';
    const RC_CUSTOMERS_BLOCKED = '1302';
    const RC_AGENT_BLOCKED = '1303';
    const RC_TRANSACTION_ALREADY_PAID = '5101';
    const RC_BILL_ALREADY_PAID = '5102';
    const RC_PENDING_TRANSACTION = '52';
    const RC_TIME_OUT = '6101';
    const RC_OTP_TIME_OUT = '6102';
    const RC_FORMAT_ERROR = '9101';
    const RC_DATE_FORMAT_ERROR = '9102';
    const RC_RESPONSE_ERROR = '92';
    const RC_INVALID_CREDENTIAL = '98';
    const RC_INTERNAL_ERROR = '99';
    const RC_BAD_REQUEST = '93';
    const RC_VALIDATION_ERROR = '1107';
    const RC_APPROVE_SUCCES = '0009';
    const RC_APPROVE_FAILED = '0010';
    const RC_REJECT_SUCCES = '0011';
    const RC_REJECT_FAILED = '0012';
    const RC_IP_ADDRESS_DOES_NOT_MATCH = "65";
    const RC_IP_ADDRESS_IS_MATCH = "66";

    //Response Message
    const RM_SUCCESS = 'Success';
    const RM_CREATE_SUCCESS = 'Berhasil Menambahkan Data';
    const RM_CREATE_FAILED = 'Gagal Menambahkan Data';
    const RM_UPDATE_SUCCESS = 'Berhasil Update Data';
    const RM_UPDATE_FAILED = 'Gagal Merubah Data';
    const RM_DELETE_SUCCESS = 'Berhasil Menghapus Data';
    const RM_DELETE_FAILED = 'Gagal Menghapus Data';
    const RM_SOFT_DELETE_SUCCESS = 'Berhasil Menghapus Data Sementara';
    const RM_RESTORE_SUCCESS = 'Berhasil Memulihkan Data';
    const RM_LOGIN_SUCCESS = 'Login Berhasil';
    const RM_TRANSACTION_SUCCESS = 'Transaksi Berhasil';
    const RM_ALREADY_EXISTS = 'Data Telah Terdaftar';
    const RM_NOT_FOUND = 'Data Tidak Ditemukan';
    const RM_INVALID_USERNAME = 'Username Tidak Ditemukan';
    const RM_INVALID_PASSWORD = 'Password Salah';
    const RM_INVALID_USERNAME_PASSWORD = 'Username Atau Password Salah';
    const RM_INVALID_TRANSACTION = 'Transaksi Tidak Sah';
    const RM_INVALID_AMOUNT = 'Jumlah Nonimal Tidak Sah';
    const RM_INVALID_BILL = 'Tagihan Tidak Sah';
    const RM_INVALID_PRODUCT = 'Produk Tidak Sah';
    const RM_INACTIVE = 'Data Tidak Aktif';
    const RM_INACTIVE_CUSTOMERS = 'Nasabah Tidak Aktif';
    const RM_USER_ACCOUNT_BLOCKED = 'Akun User Diblokir';
    const RM_CUSTOMERS_BLOCKED = 'Akun Nasabah Diblokir';
    const RM_AGENT_BLOCKED = 'Akun Agen Diblokir';
    const RM_TRANSACTION_ALREADY_PAID = 'Transaksi Telah Dibayar';
    const RM_BILL_ALREADY_PAID = 'Tagihan Telah Dibayar';
    const RM_PENDING_TRANSACTION = 'Transaksi Tertunda';
    const RM_TIME_OUT = "Waktu Proses Telah Habis";
    const RM_OTP_TIME_OUT = "Waktu OTP Telah Habis";
    const RM_FORMAT_ERROR = "Kesalahan Format";
    const RM_DATE_FORMAT_ERROR = "Format Tanggal Tidak Sah";
    const RM_RESPONSE_ERROR = "Gagal Menampilkan Response";
    const RM_INVALID_CREDENTIAL = "Kredensial Tidak Sah";
    const RM_INTERNAL_ERROR = "Terjadi Kesalahan Internal";
    const RM_BAD_REQUEST = "Terjadi Kesalahan Ketika Request (Method, Path, Dan Lainnya)";
    const RM_VALIDATION_ERROR = "Masih Terdapat Data Yang Belum Sesuai";
    const RM_NOT_MESSAGE = "Terjadi kesalahan, message tidak terdefinisi";
    const RM_IP_ADDRESS_DOES_NOT_MATCH = "IP Address Berubah";
    const RM_IP_ADDRESS_IS_MATCH = "IP Address Tidak Berubah";
    const RM_APPROVE_SUCCESS = "Berhasil Melakukan Persetujuan";
    const RM_REJECT_SUCCESS = "Berhasil Melakukan Penolakan";
    const RM_APPROVE_FAILED = "Gagal Melakukan Persetujuan";
    const RM_REJECT_FAILED = "Gagal Melakukan Penolakan";
    const RM_DOCUMENT_CREATE_SUCCESS = 'Dokumen Berhasil Diajukan';
    const RM_DOCUMENT_CREATE_FAILED = 'Dokumen Gagal Diajukan';
    const RM_USER_NOT_FOUND = 'User Tidak Ditemukan';
}
