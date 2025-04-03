<?php

namespace App\Livewire\Admin\package;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PackageModel;

class PackageList extends Component
{
    use WithPagination;

    public $pageTitle = "Package";
    public $pageName = "package";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = PackageModel::search($this->katakunci)
                ->latest('created_at')
                ->paginate(20);

        return $data;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodepackage'];
        $this->selectedNama = $data['namapackage'];
        $this->dispatch("selected-modal-open");
    }

    public function hapus($id)
    {
        $data = PackageModel::find($id);
        $namadata = $data->namapackage;
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
