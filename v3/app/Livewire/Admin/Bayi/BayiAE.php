<?php

namespace App\Livewire\Admin\Bayi;

use App\Livewire\Forms\BayiForm;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class BayiAE extends Component
{
    public $pageTitle = "Bayi";
    public $pageName = "bayi";
    public $isEdit = false;
    public $id = "";

    public BayiForm $form;

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
        session()->flash('success', "berhasil tambah data ".$this->form->namabayi);
    }

    public function saveEdit()
    {
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->form->namabayi);
    }

    // *** extra
    #[On('on-selectpasien')]
    public function selectPasien($data)
    {
        $this->form->setPasien($data);
        $this->dispatch('close-modal', namamodal : 'modalPasien');
    }

    public function render()
    {
        return view("livewire.admin.$this->pageName.ae")
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
