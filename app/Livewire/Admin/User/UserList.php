<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\UserModel;

class UserList extends Component
{
    use WithPagination;

    public $pageTitle = "User";
    public $pageName = "user";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = UserModel::search($this->katakunci)
                ->paginate(20);

        return $data;
    }

    public function hapus($id)
    {
        $data = UserModel::find($id);
        $namadata = $data->namauser;
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
        ->title("$this->pageTitle | ".config('app.webname'));
    }
}
