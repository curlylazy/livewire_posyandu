<?php

namespace App\Livewire\Front\Blog;

use App\Lib\MetaTag;
use App\Models\BlogModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class BlogList extends Component
{
    use WithPagination;

    public $pageName = "blog";
    public $pageTitle = "Blog";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = BlogModel::joinTable()->search($this->katakunci)->paginate(20);
        return $data;
    }

    public function render()
    {
        // *** meta tag
        $mt = new MetaTag;
        $mt->title = $this->pageTitle." | ".config("app.webname");
        $mt->url = url("/$this->pageName");
        $mt->genMetaTag();

        return view("livewire.front.$this->pageName.list")
            ->with([
                "dataKegiatan" => $this->readData(),
            ])
            ->layout('components.layouts.front');
    }
}
