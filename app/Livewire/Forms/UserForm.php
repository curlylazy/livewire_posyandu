<?php

namespace App\Livewire\Forms;

use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UserForm extends Form
{
    public $kodeuser = '';
    public $kodeposyandu = '';
    public $username = '';
    public $namauser = '';
    public $password = '';
    public $password_old = '';
    public $akses = '';

    public function rules()
    {
        return [
            'username' => 'required',
            'namauser' => 'required',
            'akses' => 'required',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = UserModel::find($id);
        $this->kodeuser = $data->kodeuser;
        $this->kodeposyandu = $data->kodeposyandu;
        $this->username = $data->username;
        $this->namauser = $data->namauser;
        $this->password_old = $data->password;
        $this->akses = $data->akses;
    }

    public function prepare()
    {
    }

    public function aftervalidated()
    {
        if(!empty($this->password)) {
            $this->password = Hash::make($this->password);
        } else {
            $this->password = $this->password_old;
        }
    }

    private function exceptData()
    {
        $arr = ['password_old'];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        $user = UserModel::create($this->except($this->exceptData()));

        // *** set role
        $user->assignRole($this->akses);
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        $user = UserModel::find($this->kodeuser)->update($this->except($this->exceptData()));

        // *** set role
        $user->assignRole($this->akses);

        // $user = UserModel::find($this->kodeuser);
        // $user->assignRole($this->akses);
    }

}
