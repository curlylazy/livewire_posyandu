<?php

namespace App\Livewire\Forms;

use App\Lib\Upload;
use App\Models\ActivityModel;
use App\Models\GaleriActivityModel;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Form;

class ActivityForm extends Form
{
    use WithFileUploads;

    // *** onUpdate = tidak melakukan validasi otomatis saat ada request masuk, ex upload image
    #[Validate('nullable|image|max:1024', onUpdate: false)] // 1MB Max
    public $gambaractivityFile;

    #[Validate('nullable|image|max:1024', onUpdate: false)] // 1MB Max
    public $gambarGaleriActivityFile;

    // #[Validate('nullable|image|max:1024', onUpdate: false)] // 1MB Max
    // public $gambargaleriactivityFile;

    public $kodeactivity = '';
    public $namaactivity = '';
    public $keterangansingkat = '';
    public $keterangan = '';
    public $nourut = 0;
    public $seoactivity = '';
    public $gambaractivity = '';

    public function rules()
    {
        return [
            'namaactivity' => 'required',
            'seoactivity' => 'required',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = ActivityModel::find($id);
        $this->kodeactivity = $data->kodeactivity;
        $this->namaactivity = $data->namaactivity;
        $this->keterangansingkat = $data->keterangansingkat;
        $this->keterangan = $data->keterangan;
        $this->nourut = $data->nourut;
        $this->gambaractivity = $data->gambaractivity;
        $this->seoactivity = $data->seoactivity;
    }

    public function prepare()
    {
        $this->seoactivity = Str::slug($this->namaactivity);
    }

    public function aftervalidated()
    {
        if($this->gambaractivityFile)
            $this->gambaractivity = Upload::image($this->gambaractivityFile, $this->gambaractivity, true);
    }

    private function exceptData()
    {
        $arr = ['gambaractivityFile', 'gambarGaleriActivityFile'];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        $data = ActivityModel::create($this->except($this->exceptData()));
        $kodeactivity = $data->kodeactivity;

        // *** masukkan ke galeri
        GaleriActivityModel::create([
            "kodeactivity" => $kodeactivity,
            "gambargaleriactivity" => $this->gambaractivity,
        ]);

        return $kodeactivity;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        ActivityModel::find($this->kodeactivity)->update($this->except($this->exceptData()));
    }

    public function hapusGambar($kode)
    {
        $data = ActivityModel::find($kode);
        Upload::deleteImage($data->gambaractivity);
        $data->update(['gambaractivity' => ""]);
    }

    // ** form galeri
    public function addGambar()
    {
        $gambargaleriactivity = Upload::image($this->gambarGaleriActivityFile, "", true);
        GaleriActivityModel::create([
            "kodeactivity" => $this->kodeactivity,
            "gambargaleriactivity" => $gambargaleriactivity,
        ]);

        $this->gambarGaleriActivityFile = null;
    }

    public function hapusGambarActivity($kode)
    {
        $data = GaleriActivityModel::find($kode);
        Upload::deleteImage($data->gambargaleriactivity);
        $data->delete();
    }

}
