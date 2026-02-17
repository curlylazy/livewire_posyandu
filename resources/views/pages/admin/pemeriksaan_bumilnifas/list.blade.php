<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PemeriksaanModel;

new class extends Component
{
    use WithPagination;

    public $pageTitle = "Pemeriksaan";
    public $pageName = "pemeriksaan";
    public $subPage = "bumilnifas";
    public $dirView = "pemeriksaan_bumilnifas";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "", $kategori_periksa = "", $bulan = "", $tahun = "";

    public function mount()
    {
        $this->pageTitle = ($this->kategori_periksa == "bumil") ? "Pemeriksaan Ibu Hamil" : "Pemeriksaan Nifas";
        $this->bulan = date('m');
        $this->tahun = date('Y');
    }

    public function readData()
    {
        $data = PemeriksaanModel::search($this->katakunci)
                ->joinTable()
                ->searchByMonthYear(month : $this->bulan, year: $this->tahun)
                ->searchByKategoriPeriksa($this->kategori_periksa)
                ->orderBy('tbl_pemeriksaan.tgl_periksa', 'ASC')
                ->paginate(20);

        return $data;
    }

    public function getSetPeriode($data = "")
    {
        if(empty($data)) {
            $this->dispatch('open-modal', namamodal: "modalYearMonthPicker");
            return;
        }

        $this->bulan = json_decode($data, true)['bulan'];
        $this->tahun = json_decode($data, true)['tahun'];
        $this->readData();
    }

    public function selectData($data)
    {
        $this->selectedKode = $data['kodepemeriksaan'];
        $this->selectedNama = $data['namapasien'];
        $this->dispatch('open-modal', namamodal: "modalPilihData");
    }

    public function hapus($id)
    {
        $data = PemeriksaanModel::find($id);
        $namadata = $data->kodepemeriksaan;
        $data->delete();

        session()->flash('success', "berhasil hapus data $namadata");
        $this->readData();
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
    <livewire:components::modal-year-month-picker
        wire:model="bulan"
        wire:model="tahun"
        @selectdateyear="getSetPeriode($event.detail.data)"
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
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <a class="btn btn-outline-secondary" type="button" href="{{ url("admin/") }}"><i class="fas fa-arrow-left"></i></a>
                    <a class="btn btn-outline-primary" role="button" href="{{ url("admin/$pageName/$subPage/add?kategori_periksa=$kategori_periksa") }}" wire:navigate><i class="fas fa-plus"></i> Tambah</a>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="katakunci" wire:model='katakunci' placeholder="" wire:keydown.enter='$commit'>
                        <label for="katakunci">Katakunci</label>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" class="form-control pe-none" id="yearmonth_keterangan" value="{{ IDateTime::formatDate("$tahun-$bulan-01", "MMMM Y") }}" placeholder="">
                            <label for="tgl_keterangan">Periode Pemeriksaan</label>
                        </div>
                        @if(!empty($tgl_dari))
                            <button class="btn btn-outline-secondary" type="button" x-on:click="$wire.bulan = ''; $wire.tahun = ''; $wire.readData();"><i class="fas fa-close"></i></button>
                        @endif
                        <button class="btn btn-outline-secondary" type="button" wire:click='getSetPeriode'><i class="fas fa-calendar"></i></button>
                    </div>
                </div>
            </div>

            <x-partials.containerdata :dataRows="$dataRow">
                {{-- *** Large Device --}}
                <x-partials.viewlarge>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            @if($kategori_periksa == 'nifas')
                                <thead>
                                    <tr>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Nama Ibu</th>
                                        <th scope="col">Nama Bayi</th>
                                        <th scope="col">Tanggal Lahir</th>
                                        <th scope="col">Umur Bayi</th>
                                        <th scope="col">Tanggal Periksa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataRow as $row)
                                        <tr role="button" wire:click='$dispatch("selected-data", { data : {{ $row }} })'>
                                            <td>{{ $row->nik }}</td>
                                            <td>{{ $row->namapasien }}</td>
                                            <td>{{ $row->namabayi }}</td>
                                            <td>{{ IDateTime::formatDate($row->tgl_lahir_bayi) }}</td>
                                            <td>{{ IDateTime::dateDiffFormat($row->tgl_lahir_bayi) }}</td>
                                            <td>{{ IDateTime::formatDate($row->tgl_periksa) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <thead>
                                    <tr>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Nama Ibu</th>
                                        <th scope="col">Hamil Ke</th>
                                        <th scope="col">BB</th>
                                        <th scope="col">LILA</th>
                                        <th scope="col">Tanggal Lahir</th>
                                        <th scope="col">Umur</th>
                                        <th scope="col">Tanggal Periksa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataRow as $row)
                                        <tr role="button" wire:click='$dispatch("selected-data", { data : {{ $row }} })'>
                                            <td>{{ $row->nik }}</td>
                                            <td>{{ $row->namapasien }}</td>
                                            <td>{{ $row->hamil_ke }}</td>
                                            <td>{{ Number::format($row->periksa_bb) }} kg</td>
                                            <td>{{ Number::format($row->periksa_lila) }} cm</td>
                                            <td>{{ IDateTime::formatDate($row->tgl_lahir_pasien) }}</td>
                                            <td>{{ IDateTime::dateDiff($row->tgl_lahir_pasien) }} Tahun</td>
                                            <td>{{ IDateTime::formatDate($row->tgl_periksa) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </x-partials.viewlarge>

                {{-- *** Mobile --}}
                <x-partials.viewsmall>
                    <div class="row g-2">

                        @if($kategori_periksa == 'nifas')
                            @foreach ($dataRow as $row)
                                <div class="col-12 col-md-4">
                                    <div class="card" role="button" wire:click='$dispatch("selected-data", { data : {{ $row }} })'>
                                        <div class="card-body px-2 py-2">
                                            <div class="h5 mb-1">{{ $row->namabayi }}</div>
                                            <div>Ibu {{ $row->namapasien }}</div>
                                            <div>{{ $row->namabayi }}</div>
                                            <div>{{ IDateTime::formatDate($row->tgl_lahir_bayi) }}</div>
                                            <div>{{ IDateTime::dateDiffFormat($row->tgl_lahir_bayi) }}</div>
                                            <div>{{ IDateTime::formatDate($row->tgl_periksa) }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @foreach ($dataRow as $row)
                                <div class="col-12 col-md-4">
                                    <div class="card" role="button" wire:click='$dispatch("selected-data", { data : {{ $row }} })'>
                                        <div class="card-body px-2 py-2">
                                            <div class="h5 mb-1">{{ $row->namapasien }}</div>
                                            <div>{{ $row->nik }}</div>
                                            <div>BB : {{ Number::format($row->periksa_bb) }} kg</div>
                                            <div>LILA : {{ Number::format($row->periksa_lila) }} cm</div>
                                            <div>Tgl Lahir :{{ IDateTime::formatDate($row->tgl_lahir_pasien) }}</div>
                                            <div>Umur : {{ IDateTime::dateDiff($row->tgl_lahir_pasien) }} Tahun</div>
                                            <div>Periksa : {{ IDateTime::formatDate($row->tgl_periksa) }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </x-partials.viewsmall>
            </x-partials.containerdata>

            {{-- *** Modal Selected --}}
            <x-partials.modalselected>
                <x-slot:pageTitle><span wire:text="pageTitle"></span></x-slot>
                <x-slot:selectedNama><span wire:text="selectedNama"></span></x-slot>
                <div class="d-grid gap-2" x-data="{ selectedKode: $wire.entangle('selectedKode'), pageName: $wire.entangle('pageName'), subPage: $wire.entangle('subPage'),  kategori_periksa: $wire.entangle('kategori_periksa')}">
                    <button type="button" class="btn btn-lg btn-outline-primary" data-coreui-dismiss="modal" wire:click='$dispatch("edit")'><i class="fa-solid fa-edit"></i> Edit</button>
                    <button type="button" class="btn btn-lg btn-outline-primary" data-coreui-dismiss="modal" wire:click='$dispatch("detail")'><i class="fa-solid fa-stethoscope"></i> Detail</button>
                    <button type="button" class="btn btn-lg btn-outline-danger" data-coreui-dismiss="modal" wire:click='$dispatch("confirm-delete")'><i class="fas fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-lg btn-outline-secondary" data-coreui-dismiss="modal"><i class="fas fa-close"></i> Batal</button>
                </div>
            </x-partials.modalselected>

            <div class="text-center mt-4">
                {{ $dataRow->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    $wire.on('selected-data', (e) => {
        $wire.selectedNama = e.data.namapasien;
        $wire.selectedKode = e.data.kodepemeriksaan;
        $wire.dispatch('open-modal', { namamodal: "modalPilihData" });
    });

    $wire.on('edit', (e) => {
        Livewire.navigate(`admin/${$wire.pageName}/bumilnifas/edit/${$wire.selectedKode}`);
    });

    $wire.on('detail', (e) => {
        Livewire.navigate(`admin/${$wire.pageName}/bumilnifas/detail/${$wire.selectedKode}`);
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
                $wire.dispatch('close-modal', { namamodal: "modalPilihData" });
            }
        });
    });
</script>
