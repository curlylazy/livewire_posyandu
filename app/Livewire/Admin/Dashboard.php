<?php

namespace App\Livewire\Admin;

use App\Models\ActivityModel;
use App\Models\AnggotaModel;
use App\Models\BlogModel;
use App\Models\GaleriModel;
use App\Models\KegiatanModel;
use Livewire\Component;

class Dashboard extends Component
{

    public $pageTitle = "Beranda";
    public $jmlKegiatan = 0;
    public $jmlBlog = 0;
    public $jmlGaleri = 0;

    public function mount()
    {
        $this->jmlKegiatan = ActivityModel::count();
        $this->jmlBlog = BlogModel::count();
        $this->jmlGaleri = GaleriModel::count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
