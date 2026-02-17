<?php

namespace App\Livewire\Front;

use App\Lib\MetaTag;
use App\Livewire\Forms\AnggotaForm;
use App\Models\AnggotaModel;
use App\Models\BeritaModel;
use App\Models\GaleriModel;
use App\Models\KategoriModel;
use App\Models\KegiatanModel;
use App\Models\PelangganModel;
use App\Models\PesanHDModel;
use App\Models\ProdukModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public AnggotaForm $form;

    public function mount()
    {
        $this->form->setPost(Auth::guard('front')->user()->kodeanggota);
    }

    public function readData()
    {
        $data = AnggotaModel::joinTable()->find(Auth::guard('front')->user()->kodeanggota);
        return $data;
    }

    public function save()
    {
        $this->form->update();
        $this->form->password = "";
        $this->readData();
        session()->flash('success', "berhasil tambah data ".$this->form->namaanggota);
    }

    public function render()
    {
        // *** meta tag
        $mt = new MetaTag;
        $mt->title = "Profile ".$this->form->namaanggota." | ".config("app.webname");
        $mt->url = url('/');
        $mt->genMetaTag();

        return view('livewire.front.profile')
            ->with([
                "dataAnggota" => $this->readData(),
            ])
            ->layout('components.layouts.front');
    }
}
