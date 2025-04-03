<?php

namespace App\Livewire\Partial;

use App\Models\PelangganModel;
use App\Models\ProdukModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ModalPelanggan extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $katakunci = "";

    public function mount()
    {

    }

    #[Computed()]
    public function dataPelanggan()
    {
        $data = PelangganModel::search($this->katakunci)
                ->paginate(10, pageName: 'pelanggan-page');

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
                <div wire:ignore.self class="modal fade" id="modalPelanggan" tabindex="-1" aria-labelledby="modalPelangganLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalPelangganLabel">Daftar Pelanggan</h5>
                                <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
                            </div>
                            <div class="modal-body m-0">
                                <div class="mb-2">
                                    <input class="form-control" wire:model='katakunci' placeholder="masukkan katakunci pencarian.." wire:keydown.enter='$commit'/>
                                </div>
                                <ul class="list-group">
                                    @foreach($this->dataPelanggan as $data)
                                        <li class="list-group-item" role="button" wire:click="selectRow('{{ $data->toJson() }}')">
                                            <small>{{ $data->email ?? '--' }}</small>
                                            <h6>{{ $data->namapelanggan }}</h6>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer d-block">
                                <div class="m-2">{{ $this->dataPelanggan->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}
