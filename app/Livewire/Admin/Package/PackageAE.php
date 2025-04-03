<?php

namespace App\Livewire\Admin\Package;

use App\Livewire\Forms\PackageForm;
use App\Models\ActivityModel;
use App\Models\GaleriActivityModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class PackageAE extends Component
{
    use WithFileUploads;

    public $pageTitle = "Package";
    public $pageName = "package";
    public $isEdit = false;
    public $id = "";

    public $dataPackageActivityInclude;
    public $dataPackageActivityIncludeDelete;

    public PackageForm $form;

    public function mount($id = null)
    {
        $this->dataPackageActivityInclude = collect();
        $this->dataPackageActivityIncludeDelete = collect();
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

        $this->readDataPackageActivity();
    }

    public function readDataActivity()
    {
        $data = ActivityModel::get();
        return $data;
    }

    public function readDataGaleriActivity()
    {
        $data = GaleriActivityModel::searchByKodeActivity($this->id)->get();
        return $data;
    }

    public function readDataPackageActivity()
    {
        $dataActivity = json_decode($this->form->activityinclude, true);
        foreach($dataActivity as $data) {
            $this->dataPackageActivityInclude->add($data);
        }
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
        $this->form->activityinclude = $this->dataPackageActivityInclude->toJson();
        $this->form->store();
        session()->flash('success', "berhasil tambah data ".$this->form->namapackage);
    }

    public function saveEdit()
    {
        $this->form->activityinclude = $this->dataPackageActivityInclude->toJson();
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->form->namapackage);
    }

    public function hapusGambar()
    {
        $this->form->hapusGambar($this->form->kodepackage);
    }

    public function showActivity()
    {
        $this->dispatch('open-modal', namamodal: "modalActivity");
    }

    public function addActivity($data)
    {
        if ($this->dataPackageActivityInclude->contains($data['namaactivity']))
        {
            $this->dispatch('notif', message: "Activity ".$data['namaactivity']." yang anda pilih sudah ada nih dalam list!", icon: "warning");
            return;
        }

        $this->dataPackageActivityInclude->add($data['namaactivity']);
    }

    public function hapusActivity($data)
    {
        $filtered = $this->dataPackageActivityInclude->reject(function ($value) use ($data) {
            return $value == $data;
        });
        $this->dataPackageActivityInclude = $filtered;
    }

    public function render()
    {
        return view("livewire.admin.$this->pageName.ae")
            ->with([
                "dataActivity" => $this->readDataActivity(),
                "dataGaleriActivity" => $this->readDataGaleriActivity(),
            ])
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
