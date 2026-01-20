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
    public $judul = '';
    public $isi = '';
    public $seoblog = '';

    public $gambarblog = '';

    public function rules()
    {
        return [
            'kodeuser' => 'required',
            'judul' => 'required',
            'isi' => 'required',
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
        $this->judul = $data->judul;
        $this->isi = $data->isi;
        $this->gambarblog = $data->gambarblog;
        $this->seoblog = $data->seoblog;
    }

    public function prepare()
    {
        $this->seoblog = Str::slug($this->judul);
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
