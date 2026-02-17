<?php

use App\Models\PasienModel;
use Livewire\Component;

class PasienDetail extends Component
{
    public $pageTitle = "Pasien";
    public $pageName = "pasien";
    public $isEdit = false;
    public $id = "";

    public $pilihanayahibu = "";
    public $judulModalPasien = "";

    public function mount($id)
    {
        $this->id = $id;
        $this->readData();
    }

    public function readData()
    {
        $data = PasienModel::selectCustom()->find($this->id);
        return $data;
    }

    public function render()
    {
        return $this->view([
                "dataPasien" => $this->readData()
            ])
            ->layout('layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
};

?>

{{-- *** Views --}}
<div>
    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{ url('/admin/pasien') }}" class="text-decoration-none"><span>Pasien</span></a></li>
        <li class="breadcrumb-item active"><span>{{ $pageTitle }}</span></li>
        <li class="breadcrumb-item active"><span>{{ $dataPasien->namapasien }}</span></li>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>
            <div class="mb-3">
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex gap-1">
                        <a class="btn btn-outline-secondary" type="button" href="{{ url("admin/$pageName") }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>

            {{-- <div class="row g-3">
                <div class="col-md-12">
                    <label>NIK</label>
                    <h5>{{ FilterString::filterString($dataPasien->nik) }}</h5>
                </div>
                <div class="col-md-12">
                    <label>Nama Pasien</label>
                    <h5>{{ FilterString::filterString($dataPasien->namapasien) }}</h5>
                </div>
                <div class="col-md-12">
                    <label>Alamat</label>
                    <h5>{{ FilterString::filterString($dataPasien->alamat) }}</h5>
                </div>
            </div> --}}

            <div class="row g-3">
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Kategori Umur</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->kategoriumur) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">NIK</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->nik) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Nama Pasien</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->namapasien) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Tanggal Lahir</div>
                        <div class="h5">{{ IDateTime::formatDate($dataPasien->tgl_lahir) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Umur</div>
                        <div class="h5">{{ ($dataPasien->kategoriumur == "Balita") ? Str::title($dataPasien->umur_tahun_bulan) : $dataPasien->umur.' Tahun' }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Alamat</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->alamat) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">No Telepon</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->nohp) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Berat Badan</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->beratbadan) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Tekanan Darah</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->tekanan_darah) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Jenis Kelamin</div>
                        <div class="h5">{{ GetString::getJK($dataPasien->jk) }}</div>
                    </div>
                </div>

                {{-- *** jika wanita maka munculkan apakah yang bersangkutan nifas atau bumil atau tidak --}}
                <div class="col-12" x-show="$wire.dataPasien->jk == 'P'" x-cloak>
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Kategori Pasien</div>
                        <div class="h5">{{ FilterString::filterString(Str::title($dataPasien->kategoripasien)) }}</div>
                    </div>
                </div>

                {{-- *** tampilkan jika yang bersangkutan nifas / bumil --}}
                <div class="col-12" x-show="$wire.dataPasien->kategori == 'bumil'" x-cloak>
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex border-bottom">
                                <div class="h6 fw-normal flex-grow-1">Hamil Ke</div>
                                <div class="h5">{{ FilterString::filterString($dataPasien->hamil_ke) }}</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex border-bottom">
                                <div class="h6 fw-normal flex-grow-1">Minggu Ke</div>
                                <div class="h5">{{ FilterString::filterString($dataPasien->minggu_ke) }}</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex border-bottom">
                                <div class="h6 fw-normal flex-grow-1">LILA</div>
                                <div class="h5">{{ FilterString::filterString($dataPasien->lila) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="h4">Data Orang Tua</div>
                    <p>data saat pasien pertama kali didata / lahir</p>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Nama Ayah</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->namaayah) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Nama Ibu</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->namaibu) }}</div>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="h4">Data Balita</div>
                    <p>data saat pasien pertama kali didata / lahir</p>
                </div>

                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Berat Badan Lahir</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->beratbadan_lahir) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Tinggi Badan Lahir</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->tinggibadan_lahir) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Cara Bersalin</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->carabersalin) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Tanggal Bersalin</div>
                        <div class="h5">{{ IDateTime::formatDate($dataPasien->tgl_bersalin) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Tempat Bersalin</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->tempatbersalin) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
