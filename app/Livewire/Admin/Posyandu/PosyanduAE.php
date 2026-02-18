<?php

namespace App\Livewire\Admin\Posyandu;

use App\Livewire\Forms\PosyanduForm;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class PosyanduAE extends Component
{
    public $pageTitle = "Posyandu";
    public $pageName = "posyandu";
    public $isEdit = false;
    public $id = "";

    public PosyanduForm $form;

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
        session()->flash('success', "berhasil tambah data ".$this->form->namaposyandu);
    }

    public function saveEdit()
    {
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->form->namaposyandu);
    }

    // *** extra

    public function render()
    {
        return view("livewire.admin.".$this->pageName.".ae")
            ->layout('layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
