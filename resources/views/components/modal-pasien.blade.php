<?php

use App\Models\PasienModel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $katakunci = "";

    #[Reactive]
    public $kategoriumur = "", $jk = "", $pilihanayahibu = "", $kategoriumurArr = [], $keteranganModal = "", $kodeibu, $judulModal = "Daftar Pasien";

    public function mount()
    {
    }

    #[Computed()]
    public function dataPasien()
    {
        $data = PasienModel::selectCustom()
                ->search($this->katakunci)
                ->searchByKategoriUmur($this->kategoriumur)
                ->searchByJK($this->jk)
                ->searchByIbu($this->kodeibu)
                ->searchByKategoriUmurInArray($this->kategoriumurArr)
                ->searchByStatus(1);

        if($this->pilihanayahibu == "lakilakiDewasa") {
            $data = $data->searchByLakiDewasa();
        }

        if($this->pilihanayahibu == "perempuanDewasa") {
            $data = $data->searchByPerempuanDewasa();
        }

        $data = $data->paginate(10, pageName: 'pasien-page');

        return $data;
    }

    public function selectRow($data)
    {
        $this->katakunci = "";
        $this->dispatch('selectpasien', data: $data);
    }
};

?>

{{-- *** Views --}}
<div>
    <!-- <x-partials.loader /> -->
    <div wire:ignore.self class="modal fade" id="modalPasien" tabindex="-1" aria-labelledby="modalPasienLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPasienLabel">{{ $judulModal ?? "Daftar Pasien" }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
                </div>
                <div class="modal-body m-0">
                    <div wire:loading.class="d-none">
                        <div class="mb-2">
                            <input class="form-control" wire:model='katakunci' placeholder="masukkan katakunci pencarian.." wire:keydown.enter='$commit'/>
                        </div>
                        <div class="mb-2 d-flex gap-2">
                            @if(!empty($keteranganModal))
                                <div class="p-1 border rounded-3">{{ $keteranganModal }}</div>
                            @endif

                            @if(!empty($kategoriumur))
                                <div class="p-1 border rounded-3">Umur : {{ $kategoriumur }}</div>
                            @endif
                        </div>
                        @if($this->dataPasien->isEmpty())
                            <div>Maaf tidak ada data yang ditemukan</div>
                        @else
                            <ul class="list-group">
                            @foreach($this->dataPasien as $data)
                                <li class="list-group-item" role="button" wire:click="selectRow('{{ $data }}')">
                                    <div class="d-flex align-items-center gap-2">
                                        <div><i class="fas {{ ($data->jk == 'P') ? 'fa-female' : 'fa-male' }} fa-xl"></i></div>
                                        <div class="d-flex flex-column">
                                            <small>{{ $data->nik }}</small>
                                            <h6>{{ $data->namapasien }}</h6>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            </ul>
                        @endif
                    </div>

                    <div wire:loading.inline>
                        <div class="text-center h5"><i class="fas fa-circle-notch fa-spin"></i> Memuat Halaman</div>
                    </div>
                </div>
                <div class="modal-footer d-block">
                    <div class="m-2">{{ $this->dataPasien->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
