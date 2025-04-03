<?php

namespace App\Livewire\Front\Activities;

use App\Lib\MetaTag;
use App\Models\ActivityModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class ActivitiesList extends Component
{
    use WithPagination;

    public $pageName = "activities";
    public $pageTitle = "Activities";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = ActivityModel::get();
        return $data;
    }

    public function render()
    {
        // *** meta tag
        $mt = new MetaTag;
        $mt->title = "$this->pageTitle | ".config("app.webname");
        $mt->url = url("/$this->pageName");
        $mt->genMetaTag();

        return view("livewire.front.$this->pageName.list")
            ->with([
                "dataActivity" => $this->readData(),
            ])
            ->layout('components.layouts.front');
    }
}
