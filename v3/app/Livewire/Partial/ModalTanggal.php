<?php

namespace App\Livewire\Partial;

use App\Models\ProdukModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class ModalTanggal extends Component
{
    public $title = "";
    public $tgl_dari = "";
    public $tgl_sampai = "";

    public function mount()
    {

    }

    #[On("on-modaltanggal-set-title")]
    public function setTitle($title)
    {
        $this->title = $title;
    }

    #[On("on-modaltanggal-set-tanggal")]
    public function setTanggal($tgl_dari, $tgl_sampai)
    {
        $this->tgl_dari = $tgl_dari;
        $this->tgl_sampai = $tgl_sampai;
    }

    public function save()
    {
        $this->dispatch('on-select-tanggal', tgl_dari: $this->tgl_dari, tgl_sampai: $this->tgl_sampai, title: $this->title);
        $this->dispatch('close-modal', namamodal: "modalPesanTglPesan");
    }

    public function render()
    {
        return <<<'HTML'
            <div>

                @assets
                    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
                @endassets

                @script
                    <script>

                        document.addEventListener('livewire:navigated', (event) => {
                            flatpickr(".date", { dateFormat: "Y-m-d", disableMobile: "true" });
                        });

                    </script>
                @endscript

                <div wire:ignore.self class="modal fade" id="modalPesanTglPesan" tabindex="-1" aria-labelledby="modalPesanTglPesanLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalPesanTglPesanLabel">{{ $title }}</h5>
                                <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
                            </div>
                            <div class="modal-body m-0">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control date" id="tgl_dari" wire:model='tgl_dari' placeholder="" readonly>
                                            <label for="tgl_dari">Tanggal Dari</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control date" id="tgl_sampai" wire:model='tgl_sampai' placeholder="" readonly>
                                            <label for="tgl_sampai">Tanggal Sampai</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-block">
                                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" wire:click='save'>Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}
