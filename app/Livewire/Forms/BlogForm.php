<?php

namespace App\Livewire\Forms;

use App\Lib\Upload;
use App\Models\BlogModel;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Form;

class BlogForm extends Form
{
    use WithFileUploads;

    // *** onUpdate = tidak melakukan validasi otomatis saat ada request masuk, ex upload image
    #[Validate('nullable|image|max:1024', onUpdate: false)] // 1MB Max
    public $gambarblogFile;

    public $kodeblog = '';
    public $kodeuser = '';
    public $namablog = '';
    public $keterangansingkat = '';
    public $keterangan = '';
    public $seoblog = '';

    public $gambarblog = '';

    public function rules()
    {
        return [
            'kodeuser' => 'required',
            'namablog' => 'required',
            'keterangansingkat' => 'required',
            'keterangan' => 'required',
            'seoblog' => 'required',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = BlogModel::find($id);
        $this->kodeblog = $data->kodeblog;
        $this->kodeuser = $data->kodeuser;
        $this->namablog = $data->namablog;
        $this->keterangansingkat = $data->keterangansingkat;
        $this->keterangan = $data->keterangan;
        $this->gambarblog = $data->gambarblog;
        $this->seoblog = $data->seoblog;
    }

    public function prepare()
    {
        $this->seoblog = Str::slug($this->namablog);
    }

    public function aftervalidated()
    {
        if($this->gambarblogFile)
            $this->gambarblog = Upload::image($this->gambarblogFile, $this->gambarblog, true);
    }

    private function exceptData()
    {
        $arr = ['gambarblogFile'];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        $data = BlogModel::create($this->except($this->exceptData()));
        $kodeblog = $data->kodeblog;
        return $kodeblog;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        BlogModel::find($this->kodeblog)->update($this->except($this->exceptData()));
    }

    public function hapusGambar($kode)
    {
        $data = BlogModel::find($kode);
        Upload::deleteImage($data->gambarblog);
        $data->update(['gambarblog' => ""]);
    }

}
