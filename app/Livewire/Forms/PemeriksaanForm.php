<?php

namespace App\Livewire\Forms;

use App\Lib\Upload;
use App\Models\BayiModel;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Livewire\WithFileUploads;
use Livewire\Form;

class PemeriksaanForm extends Form
{
    use WithFileUploads;

    public $kodepemeriksaan = '';
    public $kodepasien = '';
    public $kodebayi = '';
    public $kategori_periksa = '';
    public $tgl_periksa = '';
    public $is_kelas_bumil = false;
    public $is_rujuk = false;
    public $edukasi = '';

    // ** Bumil
    public $periksa_hamil_ke = 0;
    public $periksa_minggu_ke = 0;

    // ** Hasil Penimbangan/Pengukuran/Pemeriksaan
    public $periksa_bb = 0;
    public $is_sesuai_kurva_bb = false;
    public $periksa_lila = 0;
    public $periksa_tekanan_darah = '';
    public $is_sesuai_kurva_tekanan_darah = false;

    // ** Skrining TBC
    public $is_batuk = false;
    public $is_demam = false;
    public $is_bb_tidak_naik_turun = false;
    public $is_kontak_pasien_tbc = false;

    // ** Pemberian TTD & MT Bumil KEK
    public $is_beri_tablet = false;
    public $jml_tablet = 0;
    public $konsumsi_tablet = 1;
    public $is_beri_mt = 0;
    public $mt_bumil = '';
    public $konsumsi_mt_bumil = 1;

    // ** Pemberian Vit A, Menyusui dan KB
    public $periksa_bb_bayi = 0;
    public $periksa_tinggi_badan = 0;
    public $is_beri_vit_a = false;
    public $jml_tablet_vit_a = 0;
    public $is_konsumsi_vit_a = false;
    public $is_menyusui = false;
    public $is_kb = false;

    // *** extra
    public $namapasien;
    public $namabayi;

    public function rules()
    {
        return [
            'kodepasien' => 'required',
            'kodebayi' => 'nullable',
            'kategori_periksa' => 'required',
            'tgl_periksa' => 'required',
            'edukasi' => 'nullable',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = PemeriksaanModel::joinTable()->find($id);
        $this->kodepemeriksaan = $data->kodepemeriksaan;
        $this->kodepasien = $data->kodepasien;
        $this->kodebayi = $data->kodebayi;
        $this->kategori_periksa = $data->kategori_periksa;
        $this->tgl_periksa = $data->tgl_periksa;
        $this->is_kelas_bumil = $data->is_kelas_bumil;
        $this->is_rujuk = $data->is_rujuk;
        $this->edukasi = $data->edukasi;

        // ** Hasil Penimbangan/Pengukuran/Pemeriksaan
        $this->periksa_bb = $data->periksa_bb;
        $this->is_sesuai_kurva_bb = $data->is_sesuai_kurva_bb;
        $this->periksa_lila = $data->periksa_lila;
        $this->periksa_tekanan_darah = $data->periksa_tekanan_darah;
        $this->is_sesuai_kurva_tekanan_darah = $data->is_sesuai_kurva_tekanan_darah;

        // ** Skrining TBC
        $this->is_batuk = $data->is_batuk;
        $this->is_demam = $data->is_demam;
        $this->is_bb_tidak_naik_turun = $data->is_bb_tidak_naik_turun;
        $this->is_kontak_pasien_tbc = $data->is_kontak_pasien_tbc;

        // ** Pemberian TTD & MT Bumil KEK
        $this->is_beri_tablet = $data->is_beri_tablet;
        $this->jml_tablet = $data->jml_tablet;
        $this->konsumsi_tablet = $data->konsumsi_tablet;
        $this->is_beri_mt = $data->is_beri_mt;
        $this->mt_bumil = $data->mt_bumil;
        $this->konsumsi_mt_bumil = $data->konsumsi_mt_bumil;

        // ** Pemberian Vit A, Menyusui dan KB
        $this->periksa_bb_bayi = $data->periksa_bb_bayi;
        $this->periksa_tinggi_badan = $data->periksa_tinggi_badan;
        $this->is_beri_vit_a = $data->is_beri_vit_a;
        $this->jml_tablet_vit_a = $data->jml_tablet_vit_a;
        $this->is_konsumsi_vit_a = $data->is_konsumsi_vit_a;
        $this->is_menyusui = $data->is_menyusui;
        $this->is_kb = $data->is_kb;

        $this->setPasien(json_encode($data));
        $this->setBayi(json_encode($data));
    }

    public function setPasien($data)
    {
        $data = json_decode($data);
        $this->resetBayi();
        $this->kodepasien = $data->kodepasien;
        $this->namapasien = $data->namapasien;
        $this->periksa_hamil_ke = $data->hamil_ke;
        $this->periksa_minggu_ke = $data->minggu_ke;
        $this->periksa_bb = $data->beratbadan;
        $this->periksa_tekanan_darah = $data->tekanan_darah;
        $this->periksa_lila = $data->lila;
    }

    public function setBayi($data)
    {
        $data = json_decode($data);
        $this->kodebayi = $data->kodepasien;
        $this->namabayi = $data->namapasien;
        $this->periksa_bb_bayi = $data->beratbadan;
        $this->periksa_tinggi_badan = $data->tinggibadan;
    }

    public function resetBayi()
    {
        $this->kodebayi = "";
        $this->namabayi = "";
        $this->periksa_bb_bayi = 0;
        $this->periksa_tinggi_badan = 0;
    }

    public function prepare()
    {
    }

    public function aftervalidated()
    {
    }

    private function exceptData()
    {
        $arr = ['namapasien', 'namabayi'];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        $this->updatePasienDanBayi();

        $data = PemeriksaanModel::create($this->except($this->exceptData()));
        $kodepemeriksaan = $data->kodepemeriksaan;
        return $kodepemeriksaan;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        $this->updatePasienDanBayi();

        PemeriksaanModel::find($this->kodepemeriksaan)->update($this->except($this->exceptData()));
    }

    // *** extra
    private function updatePasienDanBayi()
    {
        // *** update data ibu hamil/nifas
        PasienModel::find($this->kodepasien)->update([
            "hamil_ke" => $this->periksa_hamil_ke,
            "minggu_ke" => $this->periksa_minggu_ke,
            "beratbadan" => $this->periksa_bb,
            "tekanan_darah" => $this->periksa_tekanan_darah,
            "lila" => $this->periksa_lila,
        ]);

        // *** update data bayinya
        if($this->kategori_periksa == 'bayi')
        {
            PasienModel::find($this->kodebayi)->update([
                "tinggibadan" => $this->periksa_tinggi_badan,
                "beratbadan" => $this->periksa_bb,
            ]);
        }
    }

    public function hapusGambar($kode)
    {
        $data = PemeriksaanModel::find($kode);
        Upload::deleteImage($data->gambarpasien);
        $data->update(['gambarpasien' => ""]);
    }

}
