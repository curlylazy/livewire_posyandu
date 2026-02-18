<?php

namespace App\Livewire\Admin\Blog;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\BlogModel;

class BlogList extends Component
{
    use WithPagination;

    public $pageTitle = "Blog";
    public $pageName = "blog";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = BlogModel::search($this->katakunci)->paginate(20);
        return $data;
    }

    public function hapus($id)
    {
        $data = BlogModel::find($id);
        $namadata = $data->judul;
        $data->delete();

        session()->flash('success', "berhasil hapus data $namadata");
        $this->readData();
    }

    public function render()
    {
        return view("livewire.admin.".$this->pageName.".list", [
            "dataRow" => $this->readData(),
        ])
        ->layout('layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
}
