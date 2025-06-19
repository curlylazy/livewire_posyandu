<?php

namespace App\Lib;

use App\Models\PasienModel;
use App\Models\PesanDTModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\PemeriksaanModel;

class Rekap
{
	public static function pemeriksaan($tahun)
	{
        $rowsData = collect();

        for($i=1;$i<=12;$i++)
        {
            $bulan = $i;
            $dateName = IDateTime::formatDate(date("$tahun-$bulan-01"), "MMMM YYYY");

            // *** kategori
            $jmlBumil = PasienModel::searchByKategoriPasien('bumil')->count();
            $jmlNifas = PasienModel::searchByKategoriPasien('nifas')->count();
            $jmlBumilDatang = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bumil')->count();
            $jmlNifasDatang = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('nifas')->count();
            $jmlBumilTidakDatang = $jmlBumil - $jmlBumilDatang;
            $jmlNifasTidakDatang = $jmlNifas - $jmlNifasDatang;

            // *** berat badan
            $jmlSesuaiKurvaBB = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_sesuai_kurva_bb', 1)->count();
            $jmlTidakSesuaiKurvaBB = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_sesuai_kurva_bb', 0)->count();

            // *** lila (lingkar lengan atas)
            $jmlSesuaiLila = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('periksa_lila', "<", 23.5)->count();
            $jmlTidakSesuaiLila = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('periksa_lila', ">=", 23.5)->count();

            // *** tekanan darah
            $jmlSesuaiTekananDarah = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_sesuai_kurva_tekanan_darah', 1)->count();
            $jmlTidakSesuaiTekananDarah = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_sesuai_kurva_tekanan_darah', 0)->count();

            // *** bergejalaTBC
            $jmlBergejalaTBC = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->whereRaw('is_batuk + is_demam + is_bb_tidak_naik_turun + is_kontak_pasien_tbc >= 2')->count();

            // *** TTD
            $jmlIbuHamilTTD = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_beri_tablet', 1)->count();
            $jmlKonsumsiTabletTiapHari = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_beri_tablet', 1)->where('konsumsi_tablet', 1)->count();
            $jmlKonsumsiTabletTidak = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_beri_tablet', 1)->where('konsumsi_tablet', 0)->count();

            // *** MT Bumil Kek
            $jmlBumilKEK = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_beri_mt', 1)->count();
            $jmlBumilKEKTiapHari = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_beri_mt', 1)->where('konsumsi_mt_bumil', 1)->count();
            $jmlBumilKEKTidak = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_beri_mt', 1)->where('konsumsi_mt_bumil', 0)->count();

            // *** jumlah Bumil Ikut Kelas Ibu Hamil
            $jmlBumilKelasIbuHamilYa = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bumil')->where('is_kelas_bumil', 1)->count();
            $jmlBumilKelasIbuHamilTidak = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bumil')->where('is_kelas_bumil', 0)->count();

            // *** jumlah Ibu Nifas Mendapatkan Vitamin A
            $jmlNifasVitaminAYa = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_beri_vit_a', 1)->count();
            $jmlNifasVitaminATidak = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_beri_vit_a', 0)->count();

            // *** Jumlah Ibu Nifas/Menyusui mengikuti KB Pasca Persalinan
            $jmlNifasKBYa = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_kb', 1)->count();
            $jmlNifasKBTidak = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_kb', 0)->count();

            // *** Jumlah Ibu Hamil/Nifas/ Menyusui mendapatkan Edukasi
            $jmlBumilNifasEdukasi = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->where('is_kelas_bumil', 1)->count();

            // *** Jumlah Sasaran yang Dirujuk
            $jmlRujukBumil = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bumil')->where('is_rujuk', 1)->count();
            $jmlRujukNifas = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('nifas')->where('is_rujuk', 1)->count();

            $object = (object)[
                'periode' => $dateName,
                'jml_bumil' => $jmlBumil,
                'jml_nifas' => $jmlNifas,
                'jml_bumil_datang' => $jmlBumilDatang,
                'jml_nifas_datang' => $jmlNifasDatang,
                'jml_bumil_tidak_datang' => $jmlBumilTidakDatang,
                'jml_nifas_tidak_datang' => $jmlNifasTidakDatang,
            ];

            $rowsData->push($object);
        }

        return $rowsData;
	}

}
