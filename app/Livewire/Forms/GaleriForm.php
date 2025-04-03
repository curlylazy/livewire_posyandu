<?php

namespace App\Livewire\Forms;

use App\Lib\Upload;
use App\Models\GaleriModel;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Carbon\Carbon;
use Livewire\Form;

class GaleriForm extends Form
{
    #[Validate('nullable|image|max:1024', onUpdate: false)] // 1MB Max
    public $gambargaleriFile;

    public $kodegaleri = '';
    public $namagaleri = '';
    public $gambargaleri = '';

    public function rules()
    {
        return [
            'namagaleri' => 'required',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = GaleriModel::find($id);
        $this->kodegaleri = $data->kodegaleri;
        $this->namagaleri = $data->namagaleri;
        $this->gambargaleri = $data->gambargaleri;
    }

    public function prepare()
    {
    }

    public function aftervalidated()
    {
        if($this->gambargaleriFile)
            $this->gambargaleri = Upload::image($this->gambargaleriFile, $this->gambargaleri, true);
    }

    private function exceptData()
    {
        $arr = ['gambargaleriFile'];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        $data = GaleriModel::create($this->except($this->exceptData()));
        $kodegaleri = $data->kodegaleri;
        return $kodegaleri;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        GaleriModel::find($this->kodegaleri)->update($this->except($this->exceptData()));
    }

}
