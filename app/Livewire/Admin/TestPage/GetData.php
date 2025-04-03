<?php

namespace App\Livewire\Admin\TestPage;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PendukungModel;
use App\Models\ProdukModel;

class GetData extends Component
{
    use WithPagination;

    public $pageTitle = "Test Data";

    #[Url]
    public $katakunci = "";

    public $dataProduk = [];
    public $detailProduk;

    public function mount()
    {
        $this->cariData();
    }

    public function cariData()
    {
        $dataProduk = ProdukModel::joinTable()->search($this->katakunci)->get();
        $this->dataProduk = $dataProduk;
    }

    public function detail($id)
    {
        $detailProduk = ProdukModel::join('tbl_kategori', 'tbl_kategori.kodkategori', '=', 'tbl_produk.kodekategori')->find($id);
        $this->detailProduk = $detailProduk;
    }

    public function render()
    {
        return view('livewire.admin.testpage.getdata')
        ->layout('components.layouts.admin')
        ->title($this->pageTitle);
    }
}
