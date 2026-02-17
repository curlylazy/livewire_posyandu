<?php

namespace App\Livewire\Forms;

use App\Lib\FilterString;
use App\Lib\Upload;
use App\Models\PackageModel;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Form;

class PackageForm extends Form
{
    use WithFileUploads;

    // *** onUpdate = tidak melakukan validasi otomatis saat ada request masuk, ex upload image
    #[Validate('nullable|image|max:1024', onUpdate: false)] // 1MB Max
    public $gambarpackageFile;

    public $kodepackage = '';
    public $namapackage = '';
    public $activityinclude = '';
    public $keterangan = '';
    public $harga = 0;
    public $seopackage = '';
    public $gambarpackage = '';

    public function rules()
    {
        return [
            'namapackage' => 'required',
            'keterangan' => 'required',
            'harga' => 'required|integer',
            'seopackage' => 'required',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = PackageModel::find($id);
        $this->kodepackage = $data->kodepackage;
        $this->namapackage = $data->namapackage;
        $this->activityinclude = $data->activityinclude;
        $this->keterangan = $data->keterangan;
        $this->harga = $data->harga;
        $this->gambarpackage = $data->gambarpackage;
        $this->seopackage = $data->seopackage;
    }

    public function prepare()
    {
        $this->harga = FilterString::FilterInt($this->harga);
        $this->seopackage = Str::slug($this->namapackage);
    }

    public function aftervalidated()
    {
        if($this->gambarpackageFile)
            $this->gambarpackage = Upload::image($this->gambarpackageFile, $this->gambarpackage, true);
    }

    private function exceptData()
    {
        $arr = ['gambarpackageFile'];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        $data = PackageModel::create($this->except($this->exceptData()));
        $kodepackage = $data->kodepackage;
        return $kodepackage;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        PackageModel::find($this->kodepackage)->update($this->except($this->exceptData()));
    }

    public function hapusGambar($kode)
    {
        $data = PackageModel::find($kode);
        Upload::deleteImage($data->gambarpackage);
        $data->update(['gambarpackage' => ""]);
    }

}
