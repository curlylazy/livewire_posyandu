<?php

namespace App\Livewire\Forms;

use App\Lib\FilterString;
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
    public $hamil_ke = 1;
    public $minggu_ke = 1;
    public $bb = 0;
    public $lila = 0;
    public $tekanan_darah = 0;
    public $nama_suami = "";
    public $status = 1;

    public function rules()
    {
        return [
            'kategoripasien' => 'required',
            'nik' => 'required|size:16',
            'namapasien' => 'required',
            'tgl_lahir' => 'nullable',
            'alamat' => 'nullable',
            'nohp' => 'nullable',
            'hamil_ke' => 'nullable|integer',
            'minggu_ke' => 'required|integer',
            'bb' => 'required|numeric',
            'lila' => 'required|numeric',
            'nama_suami' => 'required',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = PasienModel::find($id);
        $this->kodepasien = $data->kodepasien;
        $this->kategoripasien = $data->kategoripasien;
        $this->nik = $data->nik;
        $this->namapasien = $data->namapasien;
        $this->tgl_lahir = $data->tgl_lahir;
        $this->alamat = $data->alamat;
        $this->nohp = $data->nohp;
        $this->hamil_ke = $data->hamil_ke;
        $this->minggu_ke = $data->minggu_ke;
        $this->bb = $data->bb;
        $this->lila = $data->lila;
        $this->tekanan_darah = $data->tekanan_darah;
        $this->nama_suami = $data->nama_suami;
        $this->status = $data->status;
    }

    public function prepare()
    {
    }

    public function aftervalidated()
    {
    }

    private function exceptData()
    {
        $arr = [];
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
