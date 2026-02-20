<?php

namespace App\Livewire\Admin\Laporan;

use App\Exports\LapPemeriksaanBayiMultiSheetExport;
use App\Lib\AkunTansi;
use App\Models\PemeriksaanModel;
use Illuminate\Support\Str;
use App\Models\PesanHDModel;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;

class LapPemeriksaanBayi extends Component
{
    use WithPagination;

    public $pageTitle = "Laporan Pemeriksaan Bayi";
    public $pageName = "pemeriksaan_bayi";
    public $totalKunjungan = 0;
    public $kategori_periksa = "bayi";

    public $selectedKode = "";
    public $selectedNoInvoice = "";
    public $selectedNama = "";
    public $selectedTitle = "";
    public $selectedPhone = "";
    public $selectedEmail = "";
    public $selectedUrl = "";

    #[Url]
    public $katakunci = "", $bulan = "", $tahun = "";

    public function mount()
    {
        $this->bulan = (empty($this->bulan)) ? date("m") : $this->bulan;
        $this->tahun = (empty($this->tahun)) ? date("Y") : $this->tahun;
    }

    public function readData()
    {
        $this->totalKunjungan = 0;
        $rowsData = PemeriksaanModel::joinTable()
                ->search($this->katakunci)
                ->searchByMonthYear($this->bulan, $this->tahun)
                ->searchByKategoriPeriksa($this->kategori_periksa)
                ->get();

        foreach($rowsData as $data){
            $this->totalKunjungan++;
        }

        return $rowsData;
    }

    public function setYearMonth()
    {
        $this->dispatch('on-modalyearmonth-set-title', title: "Periode Pemeriksaan");
        $this->dispatch('on-modalyearmonth-set-tanggal', bulan: $this->bulan, tahun: $this->tahun);
        $this->dispatch('open-modal', namamodal : 'modalYearMonth');
    }

    #[On("on-select-yearmonth")]
    public function selectYearMonth($bulan, $tahun, $title = "")
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->readData();
    }

    public function onClickCetak()
    {
        $array = [
            'kategori_periksa' => $this->kategori_periksa,
            'katakunci' => $this->katakunci,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ];

        $this->redirect("/cetak/$this->pageName?".Arr::query($array));
    }

    public function onClickExportExcel()
    {
        try
        {
            $array = [
                'kategori_periksa' => $this->kategori_periksa,
                'katakunci' => $this->katakunci,
                'bulan' => $this->bulan,
                'tahun' => $this->tahun,
            ];

            $namafile = "Laporan Pemeriksaan $this->pageTitle Tahun $this->tahun.xlsx";
            return Excel::download(
                new LapPemeriksaanBayiMultiSheetExport(json_encode($array)),
                $namafile,
            );

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal cetak laporan excel : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function render()
    {
        return $this->view([
            "dataRow" => $this->readData(),
        ])
        ->layout('layouts.admin')
        ->title($this->pageTitle);
    }
};

?>

{{-- *** Views --}}
<div>
    <livewire:components::modal-year-month />

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item active"><span>{{ $pageTitle }}</span></li>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>

            <div class="mb-2">
                <a class="btn btn-outline-secondary" type="button" href="{{ url('/admin') }}" wire:navigate><i class="fas fa-arrow-left"></i></a>
                <a class="btn btn-outline-secondary" type="button" wire:click='readData'><i class="fas fa-search"></i> Cari</a>
                <a class="btn btn-outline-primary" type="button" wire:click='onClickCetak' target="_blank"><i class="fas fa-print"></i> Cetak</a>
                <a class="btn btn-outline-success" type="button" wire:click='onClickExportExcel' target="_blank"><i class="fas fa-file-export"></i> Export Excel</a>
            </div>

            <form autocomplete="off">
                <div class="row g-2 mb-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="katakunci" wire:model='katakunci' placeholder="" wire:keydown.enter='$commit'>
                            <label for="katakunci">Katakunci</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="text" class="form-control pe-none" id="yearmonth_keterangan" value="{{ IDateTime::formatDate("$tahun-$bulan-01", "MMMM Y") }}" placeholder="">
                                <label for="tgl_keterangan">Periode Pemeriksaan</label>
                            </div>
                            @if(!empty($tgl_dari))
                                <button class="btn btn-outline-secondary" type="button" x-on:click="$wire.bulan = ''; $wire.tahun = ''; $wire.readData();"><i class="fas fa-close"></i></button>
                            @endif
                            <button class="btn btn-outline-secondary" type="button" wire:click='setYearMonth'><i class="fas fa-calendar"></i></button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- *** Large Device --}}
            <x-partials.viewlarge>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nama Bayi</th>
                                <th scope="col">Nama Ibu</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Umur Bayi</th>
                                <th scope="col">Tanggal Periksa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataRow as $row)
                                <tr role="button">
                                    <td>{{ $row->namapasien }}</td>
                                    <td>{{ $row->namaibu }}</td>
                                    <td>{{ IDateTime::formatDate($row->tgl_lahir) }}</td>
                                    <td>{{ IDateTime::dateDiffFormat($row->tgl_lahir) }}</td>
                                    <td>{{ IDateTime::formatDate($row->tgl_periksa) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-partials.viewlarge>

            {{-- *** Mobile --}}
            <x-partials.viewsmall>
                <div class="row g-2">
                    <hr />
                    @foreach ($dataRow as $row)
                        <div class="col-12 col-md-12">
                            <div class="card" role="button" wire:click='selectData({{ $row }})'>
                                <div class="card-body px-2 py-2">
                                    <div class="h5 mb-1">{{ $row->namapasien }}</div>
                                    <div>Ibu {{ $row->namaibu }}</div>
                                    <div>{{ IDateTime::formatDate($row->tgl_lahir) }}</div>
                                    <div>{{ IDateTime::dateDiffFormat($row->tgl_lahir) }}</div>
                                    <div>{{ IDateTime::formatDate($row->tgl_periksa) }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-partials.viewsmall>

            <div class="row justify-content-end">
                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between">
                            <div class="fs-4 mt-0">Total Kunjungan:</div>
                            <div class="fs-4">{{ Number::format($totalKunjungan) }} Orang</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- *** Modal Selected --}}
            <x-partials.modalselected>
                <x-slot:pageTitle>{{ $pageTitle }}</x-slot>
                <x-slot:selectedNama>{{ $selectedNama }}</x-slot>
                <div class="d-grid gap-2">
                    <a role="button" class="btn btn-lg btn-outline-primary" href="{{ url("admin/$pageName/edit/$selectedKode") }}"><i class="fas fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-lg btn-outline-primary" data-coreui-dismiss="modal" wire:click='$dispatch("on-modalshare-readdata", { kode: "{{ $selectedKode }}" })'><i class="fas fa-share"></i> Share</button>
                    <button type="button" class="btn btn-lg btn-outline-primary" data-coreui-dismiss="modal" wire:click='cetak("{{ $selectedNoInvoice }}")'><i class="fas fa-print"></i> Cetak</button>
                    <button type="button" class="btn btn-lg btn-outline-danger" data-coreui-dismiss="modal" wire:click='$dispatch("confirm-delete", { kode: "{{ $selectedKode }}", nama: "{{ $selectedNama }}" })'><i class="fas fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-lg btn-outline-secondary" data-coreui-dismiss="modal"><i class="fas fa-close"></i> Batal</button>
                </div>
            </x-partials.modalselected>

        </div>
    </div>
</div>

{{-- *** External Asset --}}
@assets
    <script src="https://cdn.jsdelivr.net/npm/sharer.js@0.5.2/sharer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endassets

{{-- *** Script --}}
<script>
    flatpickr(".date", { dateFormat: "Y-m-d", disableMobile: "true" });

    $wire.on('selected-modal-open', (e) => {
        $wire.dispatch('open-modal', { namamodal: "modalPilihData" });
    });

    $wire.on('confirm-delete', (e) => {
        Swal.fire({
            title: 'Hapus Data',
            text: `Hapus data ${e.nama} dari sistem, lanjutkan ?`,
            icon: "question",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.hapus(e.kode);
            }
        });
    });
</script>
