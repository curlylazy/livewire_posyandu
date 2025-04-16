<?php

namespace App\Livewire\Admin\Pemeriksaan;

use App\Livewire\Forms\PasienForm;
use App\Livewire\Forms\PemeriksaanForm;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class PemeriksaanDetail extends Component
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
        $this->id = $id;
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
    }

    public function readData()
    {
        $data = PemeriksaanModel::joinTable()->find($this->id);
        return $data;
    }

    public function render()
    {
        return view("livewire.admin.$this->pageName.detail")
            ->with([
                "dataRow" => $this->readData()
            ])
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
