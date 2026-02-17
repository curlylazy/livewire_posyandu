<?php

use App\Models\ProdukModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Title;
use Livewire\Component;

new class extends Component
{
    #[Reactive]
    public $title = "Bulan dan Tahun";

    #[Modelable]
    public $bulan;

    #[Modelable]
    public $tahun;

    public function save()
    {
        $collection = collect(['bulan' => $this->bulan, 'tahun' => $this->tahun]);
        $this->dispatch('selectdateyear', data: $collection->toJson());
        $this->dispatch('close-modal', namamodal: "modalYearMonthPicker");
    }
};

?>

<div>
    <div wire:ignore.self class="modal fade" id="modalYearMonthPicker" tabindex="-1" aria-labelledby="modalYearMonthPickerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalYearMonthPickerLabel">{{ $title ?? "Tentukan Periode" }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
                </div>
                <div class="modal-body m-0">
                    <div class="row g-2">
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
                    <button type="button" class="btn btn-primary" wire:click='save'>Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- *** External Asset --}}
@assets
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endassets

{{-- *** Script --}}
<script>
    flatpickr(".date", { dateFormat: "Y-m-d", disableMobile: "true" });
</script>
