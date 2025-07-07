<?php

namespace App\Livewire\Admin\PemeriksaanBayi;

use App\Livewire\Forms\PasienForm;
use App\Livewire\Forms\PemeriksaanForm;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class PemeriksaanBayiDetail extends Component
{
    public $pageTitle = "Pemeriksaan";
    public $pageName = "pemeriksaan";
    public $dirView = "pemeriksaan_bayi";
    public $isEdit = false;
    public $id = "";
    public $kategori_periksa = "bayi";

    public PemeriksaanForm $form;

    public function mount($id = null)
    {
        $this->id = $id;
        $this->setTitle();
    }

    public function setTitle()
    {
        $this->pageTitle = "Pemeriksaan Bayi";
    }

    public function readData()
    {
        $data = PemeriksaanModel::joinTable()->find($this->id);
        return $data;
    }

    public function render()
    {
        return view('livewire.admin.' . $this->dirView . '.detail')
            ->with([
                "dataRow" => $this->readData()
            ])
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
