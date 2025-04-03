<?php

namespace App\Livewire\Partial;

use App\Models\ProdukModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ModalProduk extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $katakunci = "";

    public function mount()
    {

    }

    #[Computed()]
    public function dataProduk()
    {
        $data = ProdukModel::joinTable()
                ->search($this->katakunci)
                ->paginate(10, pageName: 'produk-page');

        return $data;
    }

    public function addProdukToDt($data)
    {
        $this->dispatch('on-modalpesandt-add-produk', data: $data);
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <div wire:ignore.self class="modal fade" id="modalProduk" tabindex="-1" aria-labelledby="modalProdukLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalProdukLabel">Daftar Produk</h5>
                                <button type="button" class="btn-close" data-coreui-target="#modalPesanDt" data-coreui-toggle="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <input class="form-control" wire:model='katakunci' placeholder="masukkan katakunci pencarian.." wire:keydown.enter='$commit'/>
                                </div>
                                <ul class="list-group">
                                    @foreach($this->dataProduk as $data)
                                        <li class="list-group-item" role="button" data-coreui-target="#modalPesanDt" data-coreui-toggle="modal" wire:click="addProdukToDt('{{ $data->toJson() }}')">
                                            <div class='d-flex justify-content-between align-items-center'>
                                                <div class='d-flex flex-column'>
                                                    <div class="mb-0 fw-bold" style="font-size: 10pt;">{{ $data->namakategori }}</div>
                                                    <h5 class="mb-0 fw-normal">{{ Str::title($data->namaproduk) }}</h5>
                                                </div>
                                                <h5 class="mb-0 fw-bold">Rp{{ Number::format($data->hargajual) }}</h5>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer d-block">
                                <div class="m-2">{{ $this->dataProduk->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}
