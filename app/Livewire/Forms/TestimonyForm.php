<?php

namespace App\Livewire\Forms;

use App\Models\TestimonyModel;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;

class TestimonyForm extends Form
{
    public $kodetestimony = '';
    public $nama = '';
    public $avatar = '';
    public $keterangantestimony = '';

    public function rules()
    {
        return [
            'nama' => 'required',
            'keterangantestimony' => 'required',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = TestimonyModel::find($id);
        $this->kodetestimony = $data->kodetestimony;
        $this->nama = $data->nama;
        $this->avatar = $data->avatar;
        $this->keterangantestimony = $data->keterangantestimony;
    }

    public function prepare()
    {
    }

    public function aftervalidated()
    {
    }

    private function exceptData()
    {
        $arr = [''];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        $data = TestimonyModel::create($this->except($this->exceptData()));
        $kodetestimony = $data->kodetestimony;
        return $kodetestimony;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        TestimonyModel::find($this->kodetestimony)->update($this->except($this->exceptData()));
    }

}
