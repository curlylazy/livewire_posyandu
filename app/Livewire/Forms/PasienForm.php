<?php

namespace App\Livewire\Forms;

use App\Lib\FilterString;
use App\Lib\GetString;
use App\Lib\IDateTime;
use App\Lib\Upload;
use App\Models\PasienModel;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Form;

class PasienForm extends Form
{
    use WithFileUploads;

    public $kodepasien = '';
    public $kategoripasien = '';
    public $nik = '';
    public $namapasien = '';
    public $tgl_lahir = '';
    public $alamat = '';
    public $nohp = '';
    public $jk = 'L';
    public $beratbadan = 0;
    public $tinggibadan = 0;
    public $tekanan_darah = 0;
    public $status = 1;

    // *** jika sudah menikah
    public $kodesuami = '';

    // *** data untuk balita
    public $kodeayah = '';
    public $kodeibu = '';
    public $anakke = 0;
    public $tinggibadan_lahir = 0;
    public $beratbadan_lahir = 0;
    public $carabersalin = 1;
    public $tgl_bersalin = null;
    public $tempatbersalin = "";

    // *** data untuk bumil/nifas
    public $hamil_ke = 0;
    public $minggu_ke = 0;
    public $lila = 0;

    // *** extra
    public $umur = 0;
    public $kategoriumur = "";
    public $namaayah = "";
    public $namaibu = "";
    public $namasuami = "";

    public function rules()
    {
        return [
            'nik' => 'nullable|size:16',
            'namapasien' => 'required',
            'tgl_lahir' => 'nullable',
            'alamat' => 'nullable',
            'nohp' => 'nullable',
            'hamil_ke' => 'nullable|integer',
            'minggu_ke' => 'nullable|integer',
            'beratbadan' => 'nullable|numeric',
            'tinggibadan' => 'nullable|numeric',
            'lila' => 'nullable|numeric',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = PasienModel::selectCustom()->find($id);
        $this->kodepasien = $data->kodepasien;
        $this->kategoripasien = $data->kategoripasien;
        $this->nik = $data->nik;
        $this->namapasien = $data->namapasien;
        $this->tgl_lahir = $data->tgl_lahir;
        $this->alamat = $data->alamat;
        $this->nohp = $data->nohp;
        $this->beratbadan = $data->beratbadan;
        $this->tinggibadan = $data->tinggibadan;
        $this->jk = $data->jk;
        $this->tekanan_darah = $data->tekanan_darah;
        $this->status = $data->status;

        // *** data untuk balita
        $this->kodeayah = $data->kodeayah;
        $this->kodeibu = $data->kodeibu;
        $this->anakke =$data->anakke;
        $this->tinggibadan_lahir =$data->tinggibadan_lahir;
        $this->beratbadan_lahir =$data->beratbadan_lahir;
        $this->carabersalin = $data->carabersalin;
        $this->tgl_bersalin = $data->tgl_bersalin;
        $this->tempatbersalin = $data->tempatbersalin;

        // *** data untuk bumil/nifas
        $this->hamil_ke = $data->hamil_ke;
        $this->minggu_ke = $data->minggu_ke;
        $this->lila = $data->lila;

        // *** jika sudah menikah
        $this->kodesuami = $data->kodesuami;

        // *** extra
        $this->umur = IDateTime::dateDiff($this->tgl_lahir);
        $this->kategoriumur = GetString::getKategoriUmur($this->umur);
        $this->namaayah = $data->namaayah;
        $this->namaibu = $data->namaibu;
        $this->namasuami = $data->namasuami;
    }

    public function prepare()
    {
    }

    public function aftervalidated()
    {
    }

    private function exceptData()
    {
        $arr = ['kategoriumur', 'namaayah', 'namaibu', 'umur', 'namasuami'];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        $data = PasienModel::create($this->except($this->exceptData()));
        $kodepasien = $data->kodepasien;
        return $kodepasien;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        PasienModel::find($this->kodepasien)->update($this->except($this->exceptData()));
    }

    public function hapusGambar($kode)
    {
        $data = PasienModel::find($kode);
        Upload::deleteImage($data->gambarpasien);
        $data->update(['gambarpasien' => ""]);
    }

}
