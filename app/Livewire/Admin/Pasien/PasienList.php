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
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = PasienModel::search($this->katakunci)
                ->latest('created_at')
                ->paginate(20);

        return $data;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodepasien'];
        $this->selectedNama = $data['namapasien'];
        $this->dispatch("selected-modal-open");
    }

    public function hapus($id)
    {
        $data = PasienModel::find($id);
        $namadata = $data->namapasien;
        $data->delete();

        session()->flash('success', "berhasil hapus data $namadata");
        $this->readData();
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
