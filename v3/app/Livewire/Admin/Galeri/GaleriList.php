<?php

namespace App\Livewire\Admin\Galeri;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\GaleriModel;

class GaleriList extends Component
{
    use WithPagination;

    public $pageTitle = "Galeri";
    public $pageName = "galeri";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = GaleriModel::search($this->katakunci)
                ->latest()
                ->paginate(20);

        return $data;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodegaleri'];
        $this->selectedNama = $data['namagaleri'];
        $this->dispatch("selected-modal-open");
    }

    public function hapus($id)
    {
        $data = GaleriModel::find($id);
        $namadata = $data->namagaleri;
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
