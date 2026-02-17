<?php

namespace App\Livewire\Forms;

use App\Models\PosyanduModel;
use Illuminate\Support\Str;
use Livewire\Form;

class PosyanduForm extends Form
{

    public $kodeposyandu = '';
    public $namaposyandu = '';
    public $seoposyandu = '';

    public function rules()
    {
        return [
            'namaposyandu' => 'required',
            'seoposyandu' => 'required',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = PosyanduModel::find($id);
        $this->kodeposyandu = $data->kodeposyandu;
        $this->namaposyandu = $data->namaposyandu;
        $this->seoposyandu = $data->seoposyandu;
    }

    public function prepare()
    {
        $this->seoposyandu = Str::slug($this->namaposyandu);
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

        $data = PosyanduModel::create($this->except($this->exceptData()));
        $kodeposyandu = $data->kodeposyandu;
        return $kodeposyandu;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        PosyanduModel::find($this->kodeposyandu)->update($this->except($this->exceptData()));
    }
}
