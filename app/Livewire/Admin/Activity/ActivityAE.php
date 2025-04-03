<?php

namespace App\Livewire\Admin\Activity;

use App\Livewire\Forms\ActivityForm;
use App\Models\GaleriActivityModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class ActivityAE extends Component
{
    use WithFileUploads;

    public $pageTitle = "Activity";
    public $pageName = "activity";
    public $isEdit = false;
    public $id = "";

    public ActivityForm $form;

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

    public function readDataGaleriActivity()
    {
        $data = GaleriActivityModel::searchByKodeActivity($this->id)->get();
        return $data;
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
        session()->flash('success', "berhasil tambah data ".$this->form->namaactivity);
    }

    public function saveEdit()
    {
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->form->namaactivity);
    }

    public function hapusGambar()
    {
        $this->form->hapusGambar($this->form->kodeactivity);
    }

    // *** galeri Activity

    public function addGambar()
    {
        try
        {
            $this->form->addGambar();
            $this->dispatch('close-modal', namamodal: 'modalActivityAddGambar');
            $this->dispatch('notif', message: "Yak, berhasil tambah gambar Activity", icon: "success");

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal tambah gambar Activity : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function hapusGambarActivity($kode)
    {
        $this->form->hapusGambarActivity($kode);
        $this->dispatch('notif', message: "berhasil hapus gambar", icon: "success");
    }

    public function render()
    {
        return view("livewire.admin.$this->pageName.ae")
            ->with([
                "dataGaleriActivity" => $this->readDataGaleriActivity()
            ])
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
