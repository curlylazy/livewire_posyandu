<?php

namespace App\Livewire\Admin\Pasien;

use App\Lib\GetString;
use App\Lib\IDateTime;
use App\Livewire\Forms\PasienForm;
use App\Models\PasienModel;
use Livewire\Component;
use Illuminate\Support\Str;

class PasienAE extends Component
{
    public $pageTitle = "Pasien";
    public $pageName = "pasien";
    public $isEdit = false;
    public $id = "";

    public PasienForm $form;

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
        $this->isEdit = true;
        $this->pageTitle = "Edit ".Str::title($this->pageName);
    }

    public function save()
    {
        try {
            ($this->isEdit) ? $this->saveEdit() : $this->saveAdd();

            $this->redirect("/admin/$this->pageName", navigate: true);

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal simpan data : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function saveAdd()
    {
        $this->form->store();
        session()->flash('success', "berhasil tambah data ".$this->form->namapasien);
    }

    public function saveEdit()
    {
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->form->namapasien);
    }

    // *** extra
    public function onChangeCekKategoriUmur()
    {
        try {

            dd($this->form->tgl_lahir);
            $umur = IDateTime::dateDiff($this->form->tgl_lahir);
            $this->form->kategoriumur = GetString::getKategoriUmur($umur);

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal simpan data : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function render()
    {
        return view("livewire.admin.$this->pageName.ae")
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
