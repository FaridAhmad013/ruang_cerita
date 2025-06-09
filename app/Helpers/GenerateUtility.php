<?php

namespace App\Helpers;

use App\Models\TBprDokumenSmki;

class GenerateUtility{
    static function generateNomorTransaksi($bprId)
    {
        $bulanRomawi = [ 'I', 'II', 'III','IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];

        $year = date('Y');
        $month = date('n');
        $monthRomawi = $bulanRomawi[$month - 1];

        // Mendapatkan nomor transaksi terbaru dalam bulan dan tahun yang sama
        $latestTransaction = TBprDokumenSmki::whereYear('uploaded_at', $year)
            ->whereMonth('uploaded_at', $month)
            ->orderBy('uploaded_at', 'desc')
            ->first();

        if ($latestTransaction) {
            $lastNumber = $latestTransaction->nomor_transaksi;
            $noUrut = substr($lastNumber, 0, 5); // Mengambil 5 digit pertama dari nomor transaksi terbaru
            $nextNumber = str_pad((int)$noUrut + 1, 5, '0', STR_PAD_LEFT); // Menambah 1 ke nomor urut sebelumnya dan padding '0' di depan jika kurang
        } else {
            $nextNumber = '00001'; // Jika tidak ada data sebelumnya, nomor urut diatur ke '00001'
        }

        // Generate nomor transaksi
        $nomorTransaksi = $nextNumber . '/' . $year . '/' . $monthRomawi . '/SMKI/' . $bprId;

        $existingTransaction = TBprDokumenSmki::where('nomor_transaksi', $nomorTransaksi)->exists();

        if ($existingTransaction) {
            return self::generateNomorTransaksi($bprId);
        }

        return $nomorTransaksi;
    }
}
