<?php

namespace App\Livewire\Forms;

use App\Lib\FilterString;
use App\Lib\Upload;
use App\Models\BayiModel;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Form;

class BayiForm extends Form
{
    use WithFileUploads;

    public $kodebayi = '';
    public $kodepasien = '';
    public $namabayi = '';
    public $anakke = 1;
    public $tinggibadan = 0;
    public $beratbadan = 0;
    public $carabersalin = 1;
    public $tgl_lahir = "";
    public $tgl_bersalin = "";
    public $tempatbersalin = "";
    public $jk = "L";

    public $namapasien = "";

    public function rules()
    {
        return [
            'kodepasien' => 'required',
            'namabayi' => 'required',
            'anakke' => 'required',
            'tinggibadan' => 'required',
            'beratbadan' => 'required',
            'carabersalin' => 'nullable',
            'tgl_lahir' => 'nullable',
            'tgl_bersalin' => 'nullable',
            'tempatbersalin' => 'nullable',
            'jk' => 'nullable',
        ];
    }

    public function setPasien($data)
    {
        $data = json_decode($data);
        $this->kodepasien = $data->kodepasien;
        $this->namapasien = $data->namapasien;
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = BayiModel::joinTable()->find($id);
        $this->kodebayi = $data['kodebayi'];
        $this->kodepasien = $data['kodepasien'];
        $this->namabayi = $data['namabayi'];
        $this->anakke = $data['anakke'];
        $this->tinggibadan = $data['tinggibadan'];
        $this->beratbadan = $data['beratbadan'];
        $this->carabersalin = $data['carabersalin'];
        $this->tgl_lahir = $data['tgl_lahir'];
        $this->tgl_bersalin = $data['tgl_bersalin'];
        $this->jk = $data['jk'];
        $this->tempatbersalin = $data['tempatbersalin'];

        $this->namapasien = $data['namapasien'];
    }

    public function prepare()
    {
    }

    public function aftervalidated()
    {
    }

    private function exceptData()
    {
        $arr = ['namapasien'];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        $data = BayiModel::create($this->except($this->exceptData()));
        $kodebayi = $data->kodebayi;
        return $kodebayi;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        BayiModel::find($this->kodebayi)->update($this->except($this->exceptData()));
    }

    public function hapusGambar($kode)
    {
        $data = BayiModel::find($kode);
        Upload::deleteImage($data->gambarbayi);
        $data->update(['gambarbayi' => ""]);
    }

}
