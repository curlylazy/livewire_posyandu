<?php

namespace App\Livewire\Admin\Pasien;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PasienModel;

class PasienList extends Component
{
    use WithPagination;

    public $pageTitle = "Pasien";
    public $pageName = "pasien";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "", $kategoriumur = "", $status = 1;

    public function mount()
    {

    }

    public function readData()
    {
        $data = PasienModel::selectCustom()
                ->search($this->katakunci)
                ->searchByKategoriUmur($this->kategoriumur)
                ->latest('tbl_pasien.created_at')
                ->searchByStatus($this->status)
                ->paginate(20);

        return $data;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodepasien'];
        $this->selectedNama = $data['namapasien'];
        $this->dispatch('open-modal', namamodal: "modalPilihData");
    }

    public function hapus($id)
    {
        $data = PasienModel::find($id);
        $namadata = $data->namapasien;
        $data->delete();

        session()->flash('success', "berhasil hapus data $namadata");
        $this->readData();
    }

    public function commitPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view("livewire.admin.$this->pageName.list", [
            "dataRow" => $this->readData(),
        ])
        ->layout('components.layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
}
