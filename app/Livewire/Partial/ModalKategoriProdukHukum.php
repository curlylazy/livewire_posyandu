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

class ModalKategoriProdukHukum extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $katakunci = "";

    public function mount()
    {

    }

    #[Computed()]
    public function dataKategoriProdukHukum()
    {
        $data = KategoriProdukHukumModel::search($this->katakunci)
                ->paginate(10, pageName: 'kategoriprodukhukum-page');

        return $data;
    }

    public function selectRow($data)
    {
        $this->dispatch('on-selectkategoriprodukhukum', data: $data);
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <div wire:ignore.self class="modal fade" id="modalKategoriProdukHukum" tabindex="-1" aria-labelledby="modalKategoriProdukHukumLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalKategoriProdukHukumLabel">Daftar Kategori Produk Hukum</h5>
                                <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
                            </div>
                            <div class="modal-body m-0">
                                <div class="mb-2">
                                    <input class="form-control" wire:model='katakunci' placeholder="masukkan katakunci pencarian.." wire:keydown.enter='$commit'/>
                                </div>
                                <ul class="list-group">
                                    @foreach($this->dataKategoriProdukHukum as $data)
                                        <li class="list-group-item" role="button" wire:click="selectRow('{{ $data->toJson() }}')">
                                            <small>No Urut / Tahun : {{ $data->nourut }}</small>
                                            <h6>{{ $data->namakategoriprodukhukum }}</h6>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer d-block">
                                <div class="m-2">{{ $this->dataKategoriProdukHukum->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}
