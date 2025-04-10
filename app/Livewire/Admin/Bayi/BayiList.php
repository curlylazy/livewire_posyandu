<?php

namespace App\Livewire\Admin\Bayi;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\BayiModel;

class BayiList extends Component
{
    use WithPagination;

    public $pageTitle = "Bayi";
    public $pageName = "bayi";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = BayiModel::search($this->katakunci)
                ->joinTable()
                ->latest('tbl_bayi.created_at')
                ->paginate(20);

        return $data;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodebayi'];
        $this->selectedNama = $data['namabayi'];
        $this->dispatch("selected-modal-open");
    }

    public function hapus($id)
    {
        $data = BayiModel::find($id);
        $namadata = $data->namabayi;
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
