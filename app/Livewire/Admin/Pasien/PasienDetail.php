<?php

namespace App\Livewire\Admin\Pasien;

use App\Lib\GetString;
use App\Lib\IDateTime;
use App\Livewire\Forms\PasienForm;
use App\Models\PasienModel;
use Livewire\Component;
use Illuminate\Support\Str;

class PasienDetail extends Component
{
    public $pageTitle = "Pasien";
    public $pageName = "pasien";
    public $isEdit = false;
    public $id = "";

    public $pilihanayahibu = "";
    public $judulModalPasien = "";

    public PasienForm $form;

    public function mount($id)
    {
        $this->id = $id;
        $this->readData();
    }

    public function readData()
    {
        $data = PasienModel::selectCustom()->find($this->id);
        return $data;
    }

    public function render()
    {
        return view("livewire.admin.$this->pageName.detail")
            ->with([
                "dataPasien" => $this->readData()
            ])
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
