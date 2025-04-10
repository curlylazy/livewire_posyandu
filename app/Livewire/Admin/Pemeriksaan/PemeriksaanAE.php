<?php

namespace App\Livewire\Admin\Pemeriksaan;

use App\Livewire\Forms\PasienForm;
use App\Livewire\Forms\PemeriksaanForm;
use App\Models\PasienModel;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class PemeriksaanAE extends Component
{
    public $pageTitle = "Pemeriksaan";
    public $pageName = "pemeriksaan";
    public $isEdit = false;
    public $id = "";

    #[Url()]
    public $kategori_periksa = "";

    public PemeriksaanForm $form;

    public function mount($id = null)
    {
        $this->readData($id);
        $this->setTitle();
    }

    public function setTitle()
    {
        if($this->kategori_periksa == "bumil"){
            $this->pageTitle = "Pemeriksaan Ibu Hamil";
        }

        if($this->kategori_periksa == "nifas"){
            $this->pageTitle = "Pemeriksaan Nifas";
        }

        $this->form->tgl_periksa = date('Y-m-d');
        $this->form->kategori_periksa = $this->kategori_periksa;
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

            $this->redirect("/admin/$this->pageName?kategori_periksa=".$this->kategori_periksa, navigate: true);

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
    #[On('on-selectpasien')]
    public function selectPasien($data)
    {
        $this->form->setPasien($data);
        $this->dispatch('close-modal', namamodal : 'modalPasien');
    }

    #[On('on-selectbayi')]
    public function selectBayi($data)
    {
        $this->form->setBayi($data);
        $this->dispatch('close-modal', namamodal : 'modalBayi');
    }

    public function pilihBayi()
    {
        if(empty($this->form->kodepasien)) {
            $this->dispatch('notif', message: 'Pilih dulu Ibu, baru kemudian pilih anaknya', icon: 'warning');
            return;
        }

        if($this->isEdit) {
            $this->dispatch('notif', message: 'Untuk edit tidak bisa ubah nama bayi lagi ya!', icon: 'warning');
            return;
        }

        $this->dispatch('open-modal', namamodal : 'modalBayi');
    }

    public function pilihPasien()
    {
        if($this->isEdit) {
            $this->dispatch('notif', message: 'Untuk edit tidak bisa ubah nama pasien lagi ya!', icon: 'warning');
            return;
        }

        $this->dispatch('open-modal', namamodal : 'modalPasien');
    }

    public function render()
    {
        return view("livewire.admin.$this->pageName.ae")
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
