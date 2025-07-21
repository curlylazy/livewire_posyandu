<?php

namespace App\Lib;

use App\Models\PasienModel;
use App\Models\PesanDTModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\PemeriksaanModel;

class Rekap
{
	public static function pemeriksaanBumilNifas($tahun)
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
                'jml_sesuai_kurva_bb' => $jmlSesuaiKurvaBB,
                'jml_tidak_sesuai_kurva_bb' => $jmlTidakSesuaiKurvaBB,
                'jml_sesuai_lila' => $jmlSesuaiLila,
                'jml_tidak_sesuai_lila' => $jmlTidakSesuaiLila,
                'jml_sesuai_tekanan_darah' => $jmlSesuaiTekananDarah,
                'jml_tidak_sesuai_tekanan_darah' => $jmlTidakSesuaiTekananDarah,
                'jml_bergejala_tbc' => $jmlBergejalaTBC,
                'jml_ibu_hamil_ttd' => $jmlIbuHamilTTD,
                'jml_konsumsi_tablet_tiap_hari' => $jmlKonsumsiTabletTiapHari,
                'jml_konsumsi_tablet_tidak' => $jmlKonsumsiTabletTidak,
                'jml_bumil_kek' => $jmlBumilKEK,
                'jml_bumil_kek_tiap_hari' => $jmlBumilKEKTiapHari,
                'jml_bumil_kek_tidak' => $jmlBumilKEKTidak,
                'jml_bumil_kelas_ibu_hamil_ya' => $jmlBumilKelasIbuHamilYa,
                'jml_bumil_kelas_ibu_hamil_tidak' => $jmlBumilKelasIbuHamilTidak,
                'jml_nifas_vitamin_a_ya' => $jmlNifasVitaminAYa,
                'jml_nifas_vitamin_a_tidak' => $jmlNifasVitaminATidak,
                'jml_nifas_kb_ya' => $jmlNifasKBYa,
                'jml_nifas_kb_tidak' => $jmlNifasKBTidak,
                'jml_bumil_nifas_edukasi' => $jmlBumilNifasEdukasi,
                'jml_rujuk_bumil' => $jmlRujukBumil,
                'jml_rujuk_nifas' => $jmlRujukNifas,
            ];

            $rowsData->push($object);
        }

        return $rowsData;
	}

    public static function pemeriksaanBayi($tahun)
	{
        $rowsData = collect();

        for($i=1;$i<=12;$i++)
        {
            $bulan = $i;
            $dateName = IDateTime::formatDate(date("$tahun-$bulan-01"), "MMMM YYYY");

            $dataFiltered = PemeriksaanModel::searchByMonthYear($bulan, $tahun)
                ->searchByKategoriPeriksa('bayi')
                ->get();

            $jmlBayi = PasienModel::searchByKategoriPasien('bayi')->searchUmurByBayi()->count();
            $jmlBalitaApras = PasienModel::searchByKategoriPasien('bayi')->searchByUmurBalitaApras()->count();

            // *** Jumlah Sasaran
            $jmlBayiDatang = PemeriksaanModel::joinTable()->searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->searchByUmurBayi()->count();
            $jmlBalitaAprasDatang = PemeriksaanModel::joinTable()->searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->searchByUmurBalitaApras()->count();
            $jmlBayiDatangTidakDatang = $jmlBayi - $jmlBayiDatang;
            $jmlBalitaAprasDatangTidakDatang = $jmlBalitaApras - $jmlBalitaAprasDatang;

            // *** Jumlah Bayi/Balita/Apras dengan Hasil Penimbangan dan Pengukuran/Pemantauan/Pemeriksaan
            $dataPeriksaBayi = self::cekPeriksaBayi($bulan, $tahun);
            $jmlBBNaik = $dataPeriksaBayi['jmlBBNaik'];
            $jmlBBTidakNaik = $dataPeriksaBayi['jmlBBTidakNaik'];
            $jmlBBNormal = $dataPeriksaBayi['jmlBBNormal'];
            $jmlBBTidakNormal = $dataPeriksaBayi['jmlBBTidakNormal'];
            $jmlTBNormal = $dataPeriksaBayi['jmlTBNormal'];
            $jmlBBGiziBaik = $dataPeriksaBayi['jmlBBGiziBaik'];
            $jmlBBGiziTidakBaik = $dataPeriksaBayi['jmlBBGiziTidakBaik'];
            $jmlLKNormal = $dataPeriksaBayi['jmlLKNormal'];
            $jmlLKTidakNormal = $dataPeriksaBayi['jmlLKTidakNormal'];
            $jmlGiziLilaNormal = $dataPeriksaBayi['jmlGiziLilaNormal'];
            $jmlGiziLilaTidakNormal = $dataPeriksaBayi['jmlGiziLilaTidakNormal'];
            $jmlBayiCheckListLengkap = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->searchByCheckListLengkap(1)->count();
            $jmlBayiCheckListTidakLengkap = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->searchByCheckListLengkap(0)->count();
            $jmlBergejalaTBC = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->searchByGejalaTBC()->count();

            // *** Jumlah Bayi mendapatkan
            $jmlAsiEksklusif = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->where('is_asi_ekslusif', 1)->count();
            $jmlMpasi = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->where('is_mpasi_sesuai', 1)->count();
            $jmlImunisasiLengkap = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->where('is_imunisasi_lengkap', 1)->count();
            $jmlBeriVitA = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->where('is_beri_vit_a', 1)->count();
            $jmlBeriObatCacing = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->where('is_beri_obat_cacing', 1)->count();
            $jmlMTPanganLokal = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->where('is_mt_pangan_lokal_pemulihan', 1)->count();
            $jmlEdukasi = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->where('edukasi','!=', "")->count();
            $jmlSakit = PemeriksaanModel::searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->where('is_gejala_sakit', 1)->count();

            // *** Jumlah Sasaran Dirujuk / Tidak
            $jmlBayiDirujuk = PemeriksaanModel::joinTable()->searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->where('is_rujuk', 1)->searchByUmurBayi()->count();
            $jmlBalitaAprasDirujuk = PemeriksaanModel::joinTable()->searchByMonthYear($bulan, $tahun)->searchByKategoriPeriksa('bayi')->where('is_rujuk', 1)->searchByUmurBalitaApras()->count();

            $object = (object)[
                'periode' => $dateName,
                'jml_bayi' => $jmlBayi,
                'jml_bayi_datang' => $jmlBayiDatang,
                'jml_balita_apras' => $jmlBalitaApras,
                'jml_balita_apras_datang' => $jmlBalitaAprasDatang,
                'jml_bayi_tidak_datang' => $jmlBayiDatangTidakDatang,
                'jml_balita_apras_tidak_datang' => $jmlBalitaAprasDatangTidakDatang,
                'jml_bayi_checklist_lengkap' => $jmlBayiCheckListLengkap,
                'jml_bayi_checklist_tidak_lengkap' => $jmlBayiCheckListTidakLengkap,

                'jml_bb_naik' => $jmlBBNaik,
                'jml_bb_tidak_naik' => $jmlBBTidakNaik,
                'jml_bb_normal' => $jmlBBNormal,
                'jml_bb_tidak_normal' => $jmlBBTidakNormal,
                'jml_tb_normal' => $jmlTBNormal,
                'jml_tb_tidak_normal' => $jmlBBTidakNormal,
                'jml_bb_gizi_baik' => $jmlBBGiziBaik,
                'jml_bb_gizi_tidak_baik' => $jmlBBGiziTidakBaik,
                'jml_lk_normal' => $jmlLKNormal,
                'jml_lk_tidak_normal' => $jmlLKTidakNormal,
                'jml_lila_gizi_normal' => $jmlGiziLilaNormal,
                'jml_lila_gizi_tidak_normal' => $jmlGiziLilaTidakNormal,
                'jml_bergejala_tbc' => $jmlBergejalaTBC,

                'jml_asi_eksklusif' => $jmlAsiEksklusif,
                'jml_mpasi' => $jmlMpasi,
                'jml_imunisasi_lengkap' => $jmlImunisasiLengkap,
                'jml_beri_vit_a' => $jmlBeriVitA,
                'jml_beri_obat_cacing' => $jmlBeriObatCacing,
                'jml_mt_pangan_lokal' => $jmlMTPanganLokal,
                'jml_edukasi' => $jmlEdukasi,
                'jml_sakit' => $jmlSakit,

                'jml_bayi_dirujuk' => $jmlBayiDirujuk,
                'jml_balita_apras_dirujuk' => $jmlBalitaAprasDirujuk,
            ];

            $rowsData->push($object);
        }

        return $rowsData;
    }

    private static function cekPeriksaBayi($bulan, $tahun)
    {
        $dataRows= PemeriksaanModel::joinTable()
                ->searchByKategoriPeriksa('bayi')
                ->searchByMonthYear($bulan, $tahun)
                ->get();

        $allPemeriksaan = PemeriksaanModel::searchByKategoriPeriksa('bayi')
            ->searchByMonthYear($bulan, $tahun)
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('kodepasien');

        $jmlBBNaik = 0;
        $jmlBBTidakNaik = 0;
        $jmlBBNormal = 0;
        $jmlBBTidakNormal = 0;
        $jmlTBNormal = 0;
        $jmlTBTidakNormal = 0;
        $jmlBBGiziBaik = 0;
        $jmlBBGiziTidakBaik = 0;
        $jmlLKNormal = 0;
        $jmlLKTidakNormal = 0;
        $jmlGiziLilaNormal = 0;
        $jmlGiziLilaTidakNormal = 0;

        foreach($dataRows as $data)
        {
            $pemeriksaanPasien = $allPemeriksaan[$data->kodepasien] ?? collect();

            // Ambil pemeriksaan terakhir sebelum data ini
            $previousPemeriksaan = $pemeriksaanPasien
                ->where('created_at', '<', $data->created_at)
                ->sortByDesc('created_at')
                ->first();

            // lanjut ke pasien berikutnya
            if (!$previousPemeriksaan) {
                continue;
            }

            // $previousPemeriksaan = PemeriksaanModel::searchByKategoriPeriksa('bayi')
            //     ->searchByKodePasien($data->kodepasien)
            //     ->orderBy('created_at', 'desc')
            //     ->where('created_at', '<', $data->created_at)
            //     ->first();

            $umurBayi = IDateTime::dateDiff($data->tgl_lahir, $data->tgl_periksa);
            $umurBayiBulan = IDateTime::dateDiff($data->tgl_lahir, $data->tgl_periksa, "month");

            $bbSaatIni = $data->periksa_bb;
            $bbSebelumnya = ($previousPemeriksaan) ? $previousPemeriksaan->periksa_bb : 0;
            $isBBNaik = Pemeriksaan::isBeratBadanNaik($bbSaatIni, $bbSebelumnya);
            $kesimpulanBB = Pemeriksaan::kesimpulanBeratBadan($umurBayi, $data->periksa_bb);
            $kesimpulanTB = Pemeriksaan::kesimpulanTinggiBadan($umurBayi, $data->periksa_tinggi_badan);
            $kesimpulanBBGizi = Pemeriksaan::kesimpulanBBGizi($umurBayi, $data->periksa_bb);
            $kesimpulanLK = Pemeriksaan::kesimpulanLingkarKepala($umurBayi, $data->periksa_lingkar_kepala, $data->jk);
            $kesimpulanLilaGizi = Pemeriksaan::kesimpulanLilaGizi($data->periksa_lila);

            if($isBBNaik) {
                $jmlBBNaik++;
            } else {
                $jmlBBTidakNaik++;
            }

            if($kesimpulanBB == "Normal") {
                $jmlBBNormal++;
            } else {
                $jmlBBTidakNormal++;
            }

            if($kesimpulanTB == "Normal") {
                $jmlTBNormal++;
            } else {
                $jmlTBTidakNormal++;
            }

            if($kesimpulanBBGizi == "Normal") {
                $jmlBBGiziBaik++;
            } else {
                $jmlBBGiziTidakBaik++;
            }

            if($kesimpulanLK == "Normal") {
                $jmlLKNormal++;
            } else {
                $jmlLKTidakNormal++;
            }

            if($kesimpulanLilaGizi == "Normal") {
                $jmlGiziLilaNormal++;
            } else {
                $jmlGiziLilaTidakNormal++;
            }
        }

        $res = [
            "jmlBBNaik" => $jmlBBNaik,
            "jmlBBTidakNaik" => $jmlBBTidakNaik,
            "jmlBBNormal" => $jmlBBNormal,
            "jmlBBTidakNormal" => $jmlBBTidakNormal,
            "jmlTBNormal" => $jmlTBNormal,
            "jmlTBTidakNormal" => $jmlTBTidakNormal,
            "jmlBBGiziBaik" => $jmlBBGiziBaik,
            "jmlBBGiziTidakBaik" => $jmlBBGiziTidakBaik,
            "jmlLKNormal" => $jmlLKNormal,
            "jmlLKTidakNormal" => $jmlLKTidakNormal,
            "jmlGiziLilaNormal" => $jmlGiziLilaNormal,
            "jmlGiziLilaTidakNormal" => $jmlGiziLilaTidakNormal,
        ];

        return $res;
    }

}
