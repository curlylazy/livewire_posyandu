<?php

namespace App\Livewire\Admin\Posyandu;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PosyanduModel;

class PosyanduList extends Component
{
    use WithPagination;

    public $pageTitle = "Posyandu";
    public $pageName = "posyandu";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = PosyanduModel::search($this->katakunci)
                ->latest()
                ->paginate(20);

        return $data;
    }

    public function hapus($id)
    {
        $data = PosyanduModel::find($id);
        $namadata = $data->namaposyandu;
        $data->delete();

        session()->flash('success', "berhasil hapus data $namadata");
        $this->readData();
    }

    public function render()
    {
        return view("livewire.admin.".$this->pageName.".list", [
            "dataRow" => $this->readData(),
        ])
        ->layout('components.layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
}
