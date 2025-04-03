<?php

namespace App\Livewire\Front\Blog;

use App\Lib\MetaTag;
use App\Models\BlogModel;
use Livewire\Component;

class BlogDetail extends Component
{
    private $pageName = "blog";
    private $pageTitle = "Blog";

    public $id = "";
    public $judulblog = "";

    public function mount($id)
    {
        $this->id = $id;
    }

    public function readData()
    {
        $data = BlogModel::joinTable()->searchBySeo($this->id)->first();
        $this->judulblog = $data->judulblog;
        return $data;
    }

    public function readBlogLainnya()
    {
        $data = BlogModel::joinTable()->limit(5)->get();
        return $data;
    }

    public function render()
    {
        // *** meta tag
        $mt = new MetaTag;
        $mt->title = $this->judulblog." | ".config("app.webname");
        $mt->url = url("/$this->pageName/$this->id");
        $mt->genMetaTag();

        return view("livewire.front.$this->pageName.detail")
            ->with([
                "dataBlog" => $this->readData(),
                "dataBlogLainnya" => $this->readBlogLainnya(),
            ])
            ->layout('components.layouts.front');
    }
}
