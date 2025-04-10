<?php

namespace App\Livewire\Partial;

use App\Models\BayiModel;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ModalBayi extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $katakunci = "";
    public $kodepasien = "";

    public function mount()
    {

    }

    #[Computed()]
    public function dataBayi()
    {
        $data = BayiModel::joinTable()
                ->search($this->katakunci)
                ->searchByPasien($this->kodepasien)
                ->paginate(10, pageName: 'bayi-page');

        return $data;
    }

    public function selectRow($data)
    {
        $this->dispatch('on-selectbayi', data: $data);
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <div wire:ignore.self class="modal fade" id="modalBayi" tabindex="-1" aria-labelledby="modalBayiLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalBayiLabel">Daftar Bayi</h5>
                                <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
                            </div>
                            <div class="modal-body m-0">
                                <div class="mb-2">
                                    <input class="form-control" wire:model='katakunci' placeholder="masukkan katakunci pencarian.." wire:keydown.enter='$commit'/>
                                </div>
                                <ul class="list-group">
                                    @foreach($this->dataBayi as $data)
                                        <li class="list-group-item" role="button" wire:click="selectRow('{{ $data->toJson() }}')">
                                            <small>{{ $data->namapasien }}</small>
                                            <h6>{{ $data->namabayi }}</h6>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer d-block">
                                <div class="m-2">{{ $this->dataBayi->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}
