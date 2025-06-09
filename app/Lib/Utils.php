<?php
namespace App\Lib;

use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Carbon\Carbon;

class Utils
{

    public static function jarakKehamilan($nik, $kehamilan_ke)
    {
        $res = 0;
        if($kehamilan_ke == 1)
            return $res;

        $kodeibu = PasienModel::searchByNik($nik)->first()->kodepasien;
        $anakke = $kehamilan_ke - 1;
        $dataPasien = PasienModel::searchByIbu($kodeibu)->searchByAnakKe($anakke)->first();
        $dateAnakSebelumnya = Carbon::parse($dataPasien->tgl_lahir);

        // *** kita ambil pemeriksaan pertama saja, karena tidak dicatan kapan tanggal hamillnya
        $dataPemeriksaan = PemeriksaanModel::searchByHamilKe($kehamilan_ke)->orderBy('tgl_periksa', 'ASC')->first();
        $dateAnakTerakhir = Carbon::parse($dataPemeriksaan->tgl_periksa);

        $res = round($dateAnakSebelumnya->diffInYears($dateAnakTerakhir));
        return $res;
    }

}
