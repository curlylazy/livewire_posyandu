<?php

namespace App\Livewire\Partial;

use App\Models\ProdukModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class ModalYearMonth extends Component
{
    public $title = "";
    public $bulan = "";
    public $tahun = "";

    public function mount()
    {

    }

    #[On("on-modalyearmonth-set-title")]
    public function setTitle($title)
    {
        $this->title = $title;
    }

    #[On("on-modalyearmonth-set-tanggal")]
    public function setYearMonth($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function save()
    {
        $this->dispatch('on-select-yearmonth', bulan: $this->bulan, tahun: $this->tahun, title: $this->title);
        $this->dispatch('close-modal', namamodal: "modalYearMonth");
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

                <div wire:ignore.self class="modal fade" id="modalYearMonth" tabindex="-1" aria-labelledby="modalYearMonthLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalYearMonthLabel">{{ $title }}</h5>
                                <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
                            </div>
                            <div class="modal-body m-0">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <select type="text" class="form-control" id="tahun" wire:model='tahun'>
                                                @foreach (Option::tahun() as $data)
                                                    <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <label for="tahun">Tahun</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <select type="text" class="form-control" id="bulan" wire:model='bulan'>
                                                @foreach (Option::bulan() as $data)
                                                    <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <label for="bulan">Bulan</label>
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
