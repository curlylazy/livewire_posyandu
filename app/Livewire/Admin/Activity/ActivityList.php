<?php

namespace App\Livewire\Admin\Activity;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\ActivityModel;

class ActivityList extends Component
{
    use WithPagination;

    public $pageTitle = "Activity";
    public $pageName = "activity";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = ActivityModel::search($this->katakunci)
                ->latest()
                ->paginate(20);

        return $data;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodeactivity'];
        $this->selectedNama = $data['namaactivity'];
        $this->dispatch("selected-modal-open");
    }

    public function hapus($id)
    {
        $data = ActivityModel::find($id);
        $namadata = $data->namaactivity;
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
