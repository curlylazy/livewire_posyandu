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
        $data = BlogModel::select('tbl_blog.*', 'tbl_user.namauser')
                ->joinTable()
                ->search($this->katakunci)
                ->latest('tbl_blog.created_at')
                ->paginate(20);

        return $data;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodeblog'];
        $this->selectedNama = $data['judulblog'];
        $this->dispatch("selected-modal-open");
    }

    public function hapus($id)
    {
        $data = BlogModel::find($id);
        $namadata = $data->judulblog;
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
