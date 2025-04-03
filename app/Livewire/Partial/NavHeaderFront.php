<?php

namespace App\Livewire\Partial;

use App\Models\KategoriProdukHukumModel;
use App\Models\PelangganModel;
use App\Models\ProdukModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class NavHeaderFront extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $katakunci = "";

    public function mount()
    {

    }

    #[Computed()]
    public function dataProdukHukum($subkategori)
    {
        $data = KategoriProdukHukumModel::where('subkategori', $subkategori)->latest()->limit(5)->get();
        return $data;
    }

    public function selectRow($data)
    {
        $this->dispatch('on-selectpelanggan', data: $data);
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <header id="header" class="header d-flex align-items-center fixed-top">
                <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

                    <a href="{{ url('/') }}" class="logo d-flex align-items-center justify-content-center">
                        <img src="{{ asset('logo.png') }}" alt="{{ config('app.webname') }}">
                        <h6 class="sitename mb-0">{{ config('app.webname') }}</h6>
                    </a>

                    <nav id="navmenu" class="navmenu">
                        <ul>
                            <li><a href="{{ url('/') }}" @class(['active' => Route::currentRouteName() == "dashboard"]) wire:navigate>Home</a></li>
                            <li><a href="{{ url('/berita') }}" @class(['active' => Route::currentRouteName() == "berita" || Route::currentRouteName() == "berita_detail"]) wire:navigate>Berita</a></li>
                            <li><a href="{{ url('/layanan') }}" @class(['active' => Route::currentRouteName() == "profile"]) wire:navigate>Profile</a></li>
                            <li><a href="{{ url('/produkunggulan') }}" @class(['active' => Route::currentRouteName() == "produk_unggulan"]) wire:navigate>Produk Unggulan</a></li>
                            <li><a href="{{ url('/produkhukum') }}" @class(['active' => Route::currentRouteName() == "produkhukum"]) wire:navigate>Produk Hukum</a></li>
                            <li class="dropdown">
                                <a href="#"><span>Produk Hukum</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    @foreach(Option::subKategoriProdukHukum() as $data)
                                        <li class="dropdown"><a href="#"><span>{{ $data['name'] }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                            <ul>
                                                @foreach($this->dataProdukHukum($data['name']) as $dataSub)
                                                    <li><a href="#">{{ Str::title($dataSub->namakategoriprodukhukum) }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" @class(['active' => Route::currentRouteName() == "galeri"])><span>Galeri</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li class="dropdown"><a href="{{ url('/galeri') }}" wire:navigate>Photo</a></li>
                                    <li class="dropdown"><a href="{{ url('/video') }}" wire:navigate>Video</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/kontak') }}" @class(['active' => Route::currentRouteName() == "kontak"]) wire:navigate>Kontak</a></li>
                        </ul>
                        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                    </nav>
                </div>
            </header>
            </div>
        HTML;
    }
}
