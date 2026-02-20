<?php

use App\Exports\PemeriksaanBayiExport;
use App\Exports\PemeriksaanBumilNifasPerPasienExport;
use App\Lib\GetString;
use App\Models\PasienModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PemeriksaanModel;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;

new class extends Component
{
    use WithPagination;

    public $pageTitle = "Pemeriksaan Riwayat Bayi";
    public $pageName = "pemeriksaan";

    #[Url]
    public $namapasien = "", $kodepasien = "";

    public $judulModalPasien = "";
    public $kategoriumurArr = [];
    public $jk = "";

    public $selectedKode = "";
    public $selectedNama = "";
    public $kategori_periksa = "bayi";

    public $listAnak = [];

    public function mount()
    {
        $this->pageTitle = "Riwayat Pemeriksaan Bayi";
        $this->listAnak = collect();
    }

    public function readData()
    {
        $data = PemeriksaanModel::searchByKodePasien($this->kodepasien)
            ->searchByKategoriPeriksa($this->kategori_periksa)
            ->joinTable()
            ->orderBy('tbl_pemeriksaan.tgl_periksa', 'ASC')
            ->paginate(10);

        return $data;
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodepemeriksaan'];
        $this->selectedNama = $data['namapasien'];
        $this->dispatch('open-modal', namamodal: "modalPilihData");
    }

    // *** extra
    public function onClickOpenModalPasien()
    {
        $this->judulModalPasien = "Daftar Bayi";
        $this->kategoriumurArr = ["'Balita'", "'Anak-anak'"];
        $this->dispatch('open-modal', namamodal : 'modalPasien');
    }

    public function modalSelectPasien($data)
    {
        $data = json_decode($data);
        $this->kodepasien = $data->kodepasien;
        $this->namapasien = $data->namapasien;

        $this->dispatch('close-modal', namamodal : 'modalPasien');
        $this->readData();
    }

    public function onClickExportToExcel()
    {
        if(empty($this->kodepasien)) {
            $this->dispatch('notif', message: "pilih pasien dulu ya, baru bisa export excelnya!", icon: "error");
            return;
        }

        $array = [
            "kodepasien" => $this->kodepasien,
        ];

        $namafile = "Laporan Pemeriksaan ".GetString::getJudulByKategoriPeriksa($this->kategori_periksa)." Per Pasien.xlsx";
        return Excel::download(new PemeriksaanBayiExport(json_encode($array)), $namafile);
    }

    public function render()
    {
        return $this->view([
            "dataRow" => $this->readData(),
        ])
        ->layout('layouts.admin')
        ->title($this->pageTitle." - ".config('app.webname'));
    }
};

?>

{{-- *** Views --}}
<div>
    <livewire:components::modal-pasien
        :judulModal="$judulModalPasien"
        :kategoriumurArr="$kategoriumurArr"
        @selectpasien="modalSelectPasien($event.detail.data)"
    />

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item active"><span>{{ $pageTitle }}</span></li>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>
            <div class="mb-3 d-flex flex-column flex-md-row gap-2">
                <a class="btn btn-outline-secondary" type="button" href="{{ url("admin/") }}"><i class="fas fa-arrow-left"></i></a>
                <button class="btn btn-outline-primary" type="button" wire:click='onClickOpenModalPasien'><i class="fas fa-search"></i> Pilih Pasien</button>
                <button class="btn btn-outline-success" type="button" wire:click='onClickExportToExcel'><i class="fas fa-file-export"></i> Export Excel</button>
            </div>

            @if(!empty($kodepasien))
                <div>
                    <h6>Nama Pasien : {{ $namapasien }}</h6>
                </div>
            @endif

            <x-partials.containerdata :dataRows="$dataRow">
                <hr />
                <div class="row g-3">
                    @foreach ($dataRow as $row)
                        <div class="col-12">
                            <div class="d-flex justify-content-between mb-2">
                                <h6>Periode : {{ IDateTime::formatDate($row->tgl_periksa) }}</h6>
                                <a href="{{ url("admin/pemeriksaan/bayi/detail/$row->kodepemeriksaan") }}" class="btn btn-sm btn-outline-secondary"> Cek Detail</a>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item d-flex flex-md-row flex-column">
                                    <div class="flex-grow-1">Berat Badan :</div>
                                    <div class="fw-bold">{{ $row->periksa_bb }} Kg</div>
                                </li>
                                <li class="list-group-item d-flex flex-md-row flex-column">
                                    <div class="flex-grow-1">Tingi Badan :</div>
                                    <div class="fw-bold">{{ $row->periksa_tinggi_badan }} Cm</div>
                                </li>
                                <li class="list-group-item d-flex flex-md-row flex-column">
                                    <div class="flex-grow-1">Lingkar Kepala :</div>
                                    <div class="fw-bold">{{ $row->periksa_lingkar_kepala }}</div>
                                </li>
                                <li class="list-group-item d-flex flex-md-row flex-column">
                                    <div class="flex-grow-1">Lingkar Lengan Atas (LILA) :</div>
                                    <div class="fw-bold">{{ $row->periksa_lila }}</div>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </x-partials.containerdata>

            {{-- *** Modal Selected --}}
            <x-partials.modalselected>
                <x-slot:pageTitle>{{ $pageTitle }}</x-slot>
                <x-slot:selectedNama>{{ $selectedNama }}</x-slot>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-outline-primary" href="{{ url("admin/$pageName/edit/$selectedKode?kategori_periksa=$kategori_periksa") }}" role="button" wire:navigated><i class="fas fa-edit"></i> Edit</a>
                    <a class="btn btn-lg btn-outline-primary" href="{{ url("admin/$pageName/detail/$selectedKode?kategori_periksa=$kategori_periksa") }}" role="button" wire:navigated><i class="fas fa-stethoscope"></i> Detail</a>
                    <button type="button" class="btn btn-lg btn-outline-danger" data-coreui-dismiss="modal" wire:click='$dispatch("confirm-delete", { kode: "{{ $selectedKode }}", nama: "{{ $selectedNama }}" })'><i class="fas fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-lg btn-outline-secondary" data-coreui-dismiss="modal"><i class="fas fa-close"></i> Batal</button>
                </div>
            </x-partials.modalselected>

            <div class="text-center mt-4">
                {{ $dataRow->links() }}
            </div>
        </div>
    </div>
</div>
