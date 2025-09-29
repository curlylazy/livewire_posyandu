<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Forms\UserForm;
use App\Models\PosyanduModel;
use App\Models\UserModel;
use Livewire\Component;

class UserAE extends Component
{
    public $pageTitle = "User";
    public $pageName = "user";
    public $isEdit = false;
    public $id = "";
    public $nama = "";

    public UserForm $form;

    public function mount($id = null)
    {
        $this->readData($id);
    }

    public function readData($id = null)
    {
        if(empty($id))
            return;

        $this->form->setPost($id);
        $this->id = $id;
        $this->nama = $this->form->namauser;
        $this->isEdit = (empty($id)) ? false : true;
        $this->pageTitle = (empty($id)) ? "Tambah User" : "Edit User";
    }

    public function readDataPosyandu()
    {
        $res = PosyanduModel::pluck('namaposyandu', 'kodeposyandu');
        return $res;
    }

    public function save()
    {
        try {
            $this->validate();

            if($this->isEdit) {
                $this->saveEdit();
            } else {
                $this->saveAdd();
            }

            $this->redirect("/admin/$this->pageName", navigate: true);

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal simpan data : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function saveAdd()
    {
        $this->form->store();
        session()->flash('success', "berhasil tambah data ".$this->nama);
    }

    public function saveEdit()
    {
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->nama);
    }

    public function render()
    {
        return view("livewire.admin.".$this->pageName.".ae")
            ->with([
                'dataPosyandu' => $this->readDataPosyandu(),
            ])
            ->layout('components.layouts.admin')
            ->title("$this->pageTitle | ".config('app.webname'));
    }
}
