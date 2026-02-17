<?php

namespace App\Livewire\Partial;

use App\Lib\FilterString;
use App\Livewire\Forms\PesanDtForm;
use App\Models\BahanBakuModel;
use App\Models\JenisKainModel;
use App\Models\PendukungModel;
use App\Models\ProdukBahanBakuModel;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class ModalPesanDt extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $selectedTab = "tabProduk";
    public $katakunci = "";
    public $dataProduk;
    public $dataUkuran;
    public $dataWarna;
    public $dataJenisKain;
    public $dataProdukBahanBaku;

    public PesanDtForm $pesanDtForm;

    // *** untuk edit bahan baku
    public $namabahanbaku = "";
    public $kodepesanbahanbaku = "";
    public $qtyhabis = 0;
    public $hargabahanbaku = "";

    public function mount()
    {
        $this->dataProdukBahanBaku = collect();
        $this->readDataExtra();
    }

    #[Computed()]
    public function dataBahanBaku()
    {
        $data = BahanBakuModel::search($this->katakunci)
                ->paginate(10, pageName: 'bahanbaku-page');

        return $data;
    }

    public function readDataExtra()
    {
        $this->dataUkuran = PendukungModel::searchUkuran()->get();
        $this->dataWarna = PendukungModel::searchWarna()->get();
        $this->dataJenisKain = JenisKainModel::get();
    }

    public function hitung()
    {
        try
        {
            // *** update jumlah pesannya
            // *** qty pesan digunakan untuk mengalikan qtyhabis dan berapa jumlah pesan order
            // misal jml pesan 2, jadi 2 * 6 Meter = 12, ini digunakan untuk pengurangan stoknya
            // $dataProdukBahanBaku = $this->dataProdukBahanBaku;
            // foreach($dataProdukBahanBaku as $data)
            // {
            //     $data['qtypesan'] = 5;
            // }

            // dd($this->pesanDtForm->qty);

            $this->pesanDtForm->subtotal = $this->pesanDtForm->qty * FilterString::filterInt($this->pesanDtForm->hargajual);
            $this->pesanDtForm->hargapokok = $this->dataProdukBahanBaku->sum(function($item){
                return $item['qtyhabis'] * $item['hargabahanbaku'];
            });
        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal melakukan perhitungan : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function addBahanBaku($data)
    {
        try
        {
            $isExist = $this->dataProdukBahanBaku->where('kodebahanbaku', $data['kodebahanbaku'])->count();
            if($isExist)
            {
                $this->dispatch('notif', message: $data['namabahanbaku']." sudah ada lo dalam daftar baku, coba cek lalu pilih bahan baku yang lain ya!.", icon: "error");
                return;
            }

            $data['kodepesandt'] = $this->pesanDtForm->kodepesandt;
            $data['kodepesanbahanbaku'] = uniqid("PBB-");
            $data['qtyhabis'] = 1;
            $this->dataProdukBahanBaku->push($data);
            $this->hitung();

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal tambah bahan baku : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function editBahanBaku($kodepesanbahanbaku)
    {
        $data = $this->dataProdukBahanBaku->firstWhere('kodepesanbahanbaku', $kodepesanbahanbaku);
        $this->namabahanbaku = $data['namabahanbaku'];
        $this->kodepesanbahanbaku = $data['kodepesanbahanbaku'];
        $this->qtyhabis = $data['qtyhabis'];
        $this->hargabahanbaku = $data['hargabahanbaku'];
    }

    public function hapusBahanBaku($kode)
    {
        $filtered = $this->dataProdukBahanBaku->filter(function ($row, $key) use($kode) {
            return $row['kodepesanbahanbaku'] != $kode;
        });
        $this->dataProdukBahanBaku = $filtered;
        $this->hitung();
    }

    public function saveBahanBaku()
    {
        $data = $this->dataProdukBahanBaku->firstWhere('kodepesanbahanbaku', $this->kodepesanbahanbaku);
        $data['kodepesanbahanbaku'] = $this->kodepesanbahanbaku;
        $data['qtyhabis'] = $this->qtyhabis;
        $data['hargabahanbaku'] = FilterString::filterInt($this->hargabahanbaku);

        // *** hapus yang sebelumnya
        $kode = $this->kodepesanbahanbaku;
        $filtered = $this->dataProdukBahanBaku->filter(function ($row, $key) use($kode) {
            return $row['kodepesanbahanbaku'] != $kode;
        });
        $this->dataProdukBahanBaku = $filtered;

        // *** masukkan data baru
        $this->dataProdukBahanBaku->push($data);
        $this->hitung();
    }

    public function resetForm()
    {
        $this->pesanDtForm->mode = "";
        $this->dataProdukBahanBaku = collect();
        $this->pesanDtForm->reset();
    }

    #[On('on-modalpesandt-add-produk')]
    public function addProduk($data)
    {
        $data = json_decode($data);
        $this->pesanDtForm->mode = "**add";
        $this->pesanDtForm->kodepesandt = uniqid("PESANDT-");
        $this->pesanDtForm->qty = 1;
        $this->pesanDtForm->kodeproduk = $data->kodeproduk;
        $this->pesanDtForm->namaproduk = $data->namaproduk;
        $this->pesanDtForm->hargajual = $data->hargajual;
        $this->pesanDtForm->hargapokok = $data->hargapokok;
        $this->pesanDtForm->subtotal = $data->hargajual;

        // *** tampilkan bahan bakunya
        $this->dataProdukBahanBaku = collect();
        $dataProdukBahanBaku = ProdukBahanBakuModel::joinTable()->searchByKodeProduk($this->pesanDtForm->kodeproduk)->get();
        foreach($dataProdukBahanBaku as $data)
        {
            $data->kodepesanbahanbaku = uniqid("PBB-");
            $data->kodepesandt = $this->pesanDtForm->kodepesandt;
            $this->dataProdukBahanBaku->push($data->toArray());
        }

        $this->hitung();
    }

    #[On('on-modalpesandt-edit-produk')]
    public function editProduk($data, $dataProdukBahanBaku)
    {
        $data = json_decode($data);
        $this->pesanDtForm->mode = "**edit";
        $this->pesanDtForm->kodepesandt = $data->kodepesandt;
        $this->pesanDtForm->kodepesanhd = $data->kodepesanhd;
        $this->pesanDtForm->kodeproduk = $data->kodeproduk;
        $this->pesanDtForm->kodejeniskain = $data->kodejeniskain;
        $this->pesanDtForm->ukuran = $data->ukuran;
        $this->pesanDtForm->warna = $data->warna;
        $this->pesanDtForm->namaproduk = $data->namaproduk;
        $this->pesanDtForm->hargajual = $data->hargajual;
        $this->pesanDtForm->hargapokok = $data->hargapokok;
        $this->pesanDtForm->qty = $data->qty;
        $this->pesanDtForm->subtotal = $data->subtotal;

        // *** tampilkan bahan bakunya
        $this->dataProdukBahanBaku = collect($dataProdukBahanBaku);
        $this->hitung();
    }

    public function save()
    {
        if(empty($this->pesanDtForm->kodeproduk))
        {
            $this->dispatch('notif', message: "anda belum memilih produk", icon: "error");
            return;
        }

        if(empty($this->pesanDtForm->ukuran))
        {
            $this->dispatch('notif', message: "anda belum memilih ukuran", icon: "error");
            return;
        }

        if(empty($this->pesanDtForm->kodejeniskain))
        {
            $this->dispatch('notif', message: "anda belum memilih jenis kain", icon: "error");
            return;
        }

        if(empty($this->pesanDtForm->warna))
        {
            $this->dispatch('notif', message: "anda belum memilih warna", icon: "error");
            return;
        }

        if($this->dataProdukBahanBaku->isEmpty())
        {
            $this->dispatch('notif', message: "belum ada bahan baku yang dipilih, silahkan masukkan bahan baku.", icon: "error");
            return;
        }

        // *** convert string to int
        $this->pesanDtForm->hargapokok = FilterString::filterInt($this->pesanDtForm->hargapokok);
        $this->pesanDtForm->hargajual = FilterString::filterInt($this->pesanDtForm->hargajual);
        $this->pesanDtForm->subtotal = FilterString::filterInt($this->pesanDtForm->subtotal);

        $namajeniskain = JenisKainModel::find($this->pesanDtForm->kodejeniskain)->namajeniskain;

        // *** ubah statusnya, jika edit pesan
        if(!empty($this->pesanDtForm->kodepesanhd))
            $this->pesanDtForm->mode == "**upd";

        if($this->pesanDtForm->mode == "**add")
        {
            $this->pesanDtForm->namajeniskain = $namajeniskain;
            $this->dispatch('on-pesanae-insertrow', data: $this->pesanDtForm->pull(), dataProdukBahanBaku: $this->dataProdukBahanBaku->all());
        }
        elseif($this->pesanDtForm->mode == "**edit" || $this->pesanDtForm->mode == "**upd")
        {
            $this->pesanDtForm->namajeniskain = $namajeniskain;
            $this->dispatch('on-pesanae-updaterow', data: $this->pesanDtForm->pull(), dataProdukBahanBaku: $this->dataProdukBahanBaku);
        }

        // *** reset
        $this->pesanDtForm->mode = "";
    }

    public function render()
    {
        return <<<'HTML'
            <div>

                @assets
                    <style>
                        /* width */
                        ::-webkit-scrollbar {
                            width: 5px;
                        }

                        /* Track */
                        ::-webkit-scrollbar-track {
                            background: #f1f1f1;
                        }

                        /* Handle */
                        ::-webkit-scrollbar-thumb {
                            background: #888;
                        }

                        /* Handle on hover */
                        ::-webkit-scrollbar-thumb:hover {
                            background: #555;
                        }
                    </style>
                @endassets

                @script
                    <script>
                        $wire.on('confirm-delete-bahanbaku', (e) => {
                            Swal.fire({
                                title: 'Hapus Bahan Baku',
                                text: `Hapus data ${e.nama} dari sistem, lanjutkan ?`,
                                icon: "question",
                                showCancelButton: true,
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $wire.hapusBahanBaku(e.kode);
                                }
                            });
                        });
                    </script>
                @endscript

                <!-- *** Daftar Bahan Baku (jika pelanggan minta req lebih) -->
                <div wire:ignore.self class="modal fade" id="modalDaftarBahanBaku" tabindex="-1" aria-labelledby="modalDaftarBahanBakuLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header d-flex flex-column">
                                <h5 class="modal-title text-center mb-0">Daftar Bahan Baku</h5>
                                <button type="button" class="btn-close" data-coreui-target="#modalPesanDt" data-coreui-toggle="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <input class="form-control" wire:model='katakunci' placeholder="masukkan katakunci pencarian.." wire:keydown.enter='$commit'/>
                                </div>
                                <ul class="list-group">
                                    @foreach($this->dataBahanBaku as $data)
                                        <li class="list-group-item" role="button" data-coreui-target="#modalPesanDt" data-coreui-toggle="modal" wire:click='addBahanBaku({{ $data }})'>
                                            <div class='d-flex justify-content-between align-items-center'>
                                                <div class='d-flex flex-column'>
                                                    <div class="mb-0 fw-bold" style="font-size: 10pt;">{{ GetString::getTipeBahanBaku($data->tipebahanbaku) }}</div>
                                                    <h5 class="mb-0 fw-normal">{{ Str::title($data->namabahanbaku) }}</h5>
                                                </div>
                                                <h5 class="mb-0 fw-bold">Rp{{ Number::format($data->hargabahanbaku) }}</h5>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="modal-footer d-block">
                                <div class="m-2">{{ $this->dataBahanBaku->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- *** Edit Bahan Baku-->
                <div wire:ignore.self class="modal fade" id="modalEditBahanBaku" tabindex="-1" aria-labelledby="modalEditBahanBakuLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header d-flex flex-column">
                                <h5 class="modal-title text-center mb-0">Edit Bahan Baku</h5>
                                <h6 class="modal-title text-center mt-0 fw-bold">{{ $namabahanbaku }}</h6>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-12 col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="qtyhabis" wire:model='qtyhabis'>
                                            <label for="qtyhabis">Jumlah</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="hargabahanbaku" wire:model='hargabahanbaku' x-mask:dynamic="$money($input)">
                                            <label for="hargabahanbaku">Harga Bahan Baku</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-coreui-target="#modalPesanDt" data-coreui-toggle="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-coreui-target="#modalPesanDt" data-coreui-toggle="modal" wire:click='saveBahanBaku'>Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- *** Modal Pesan Detail -->
                <div wire:ignore.self class="modal fade" id="modalPesanDt" tabindex="-1" aria-labelledby="modalPesanDtLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalPesanDtLabel">Pesanan Produk</h5>
                                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close" x-on:click="$wire.resetForm()"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-tabs" id="tabModalPesanDetail" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" :class="{ 'active': ($wire.selectedTab == 'tabProduk') }" id="produk-tab" data-coreui-toggle="tab" data-coreui-target="#produk-tab-pane" type="button" role="tab" aria-controls="produk-tab-pane" aria-selected="true" x-on:click="$wire.selectedTab = 'tabProduk'">
                                            <i class="fas fa-cube"></i> Produk
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" :class="{ 'active': ($wire.selectedTab == 'tabBahanBaku') }" id="bahanbaku-tab" data-coreui-toggle="tab" data-coreui-target="#bahanbaku-tab-pane" type="button" role="tab" aria-controls="bahanbaku-tab-pane" aria-selected="false" x-on:click="$wire.selectedTab = 'tabBahanBaku'">
                                            <i class="fas fa-tshirt"></i> Bahan Baku
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content mt-2" id="tabModalPesanDetailContent">

                                    <!-- *** Produk Tab show active -->
                                    <div class="tab-pane fade" :class="{ 'show active': ($wire.selectedTab == 'tabProduk') }" id="produk-tab-pane" role="tabpanel" aria-labelledby="produk-tab" tabindex="0">
                                        <div class="row g-2">
                                            <div class="col-12" x-show="$wire.pesanDtForm.hargapokok > $wire.pesanDtForm.hargajual">
                                                <div class="alert alert-warning d-flex align-items-center mb-0" style="font-size: 10pt;" role="alert">
                                                    Harga pokok lebih besar dibanding harga jual, anda kemungkinan mengalami kerugian!
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control pe-none" id="pesanDtForm.namaproduk" wire:model='pesanDtForm.namaproduk' placeholder="" readonly>
                                                        <label for="pesanDtForm.namaproduk">Produk</label>
                                                    </div>
                                                    <button class="btn btn-outline-secondary" :class='$wire.mode == "**edit" ? "pe-none" : ""' type="button" id="button-addon1" data-coreui-target="#modalProduk" data-coreui-toggle="modal"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-12">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="pesanDtForm.qty" wire:model='pesanDtForm.qty' placeholder="" wire:change='hitung'>
                                                    <label for="pesanDtForm.qty">Jumlah</label>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control pe-none" id="pesanDtForm.hargapokok" value='{{ number_format($pesanDtForm->hargapokok) }}' placeholder="" readonly>
                                                    <label for="pesanDtForm.hargapokok">Harga Pokok</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 d-none">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="pesanDtForm.prosentasi" wire:model='pesanDtForm.prosentase' placeholder="" x-mask:dynamic="$money($input)">
                                                    <label for="pesanDtForm.prosentasi">Prosentase (%)</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="pesanDtForm.hargajual" wire:model='pesanDtForm.hargajual' placeholder="" x-mask:dynamic="$money($input)" wire:change='hitung'>
                                                    <label for="pesanDtForm.hargajual">Harga Jual</label>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-12">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control pe-none" id="pesanDtForm.subtotal" value='{{ number_format($pesanDtForm->subtotal) }}' placeholder="">
                                                    <label for="pesanDtForm.subtotal">Sub Total</label>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <select class="form-select" id="pesanDtForm.kodejeniskain" wire:model="pesanDtForm.kodejeniskain">
                                                        <option value="">Pilih Jenis Kain</option>
                                                        @foreach($dataJenisKain as $data)
                                                            <option value="{{ $data->kodejeniskain }}">{{ $data->namajeniskain }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="pesanDtForm.kodejeniskain">Jenis Kain</label>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <div class="form-floating">
                                                    <select class="form-select" id="pesanDtForm.ukuran" wire:model="pesanDtForm.ukuran">
                                                        <option value="">Pilih Ukuran</option>
                                                        @foreach($dataUkuran as $data)
                                                            <option value="{{ $data->namadatapendukung }}">{{ $data->namadatapendukung }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="pesanDtForm.ukuran">Ukuran</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-floating">
                                                    <select class="form-select" id="pesanDtForm.warna" wire:model="pesanDtForm.warna">
                                                        <option value="">Pilih Warna</option>
                                                        @foreach($dataWarna as $data)
                                                            <option value="{{ $data->namadatapendukung }}">{{ $data->namadatapendukung }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="pesanDtForm.ukuran">Ukuran</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- *** Bahan Baku -->
                                    <div class="tab-pane fade" :class="{ 'show active': ($wire.selectedTab == 'tabBahanBaku') }" id="bahanbaku-tab-pane" role="tabpanel" aria-labelledby="bahanbaku-tab" tabindex="0">
                                        @if(count($dataProdukBahanBaku) == 0)
                                            <div class="d-flex flex-column mt-5 text-center justify-content-center align-content-center">
                                                <div><img class="text-center" style="height: 300px; width: 300px; object-fit: cover;" src="{{ asset('empty.png') }}" /></div>
                                                <div>
                                                    <h5 class='mb-1'>Pilih Produknya Dulu Ya :)<br /></h5>
                                                    <p>Biar kamu bisa tau bahan baku yang dihabiskan</p>
                                                </div>
                                            </div>
                                        @else
                                            <div style="height: 400px; overflow-y: scroll;">
                                                <ul class="list-group">
                                                    @foreach($dataProdukBahanBaku as $data)
                                                        <li class="list-group-item">
                                                            <div class='d-flex justify-content-between align-items-center'>
                                                                <div class='d-flex flex-column'>
                                                                    <span class='fw-bold'>@if($data['tipebahanbaku'] == 2) (Jasa) @endif {{ $data['namabahanbaku'] }}</span>
                                                                    <span class='fw-medium'>
                                                                        @if($data['tipebahanbaku'] == 1)
                                                                            {{ $data['qtyhabis'] }} {{ $data['satuan'] }} x Rp{{ Number::format($data['hargabahanbaku']) }}
                                                                        @else
                                                                            {{ $data['qtyhabis'] }} x Rp{{ Number::format($data['hargabahanbaku']) }}
                                                                        @endif
                                                                    </span>
                                                                    <span class='fw-bold'>Rp{{ Number::format($data['qtyhabis'] * $data['hargabahanbaku']) }}</span>
                                                                </div>
                                                                <div>
                                                                    <div class="dropdown dropstart">
                                                                        <button class="btn btn-secondary" type="button" role="button" data-coreui-toggle="dropdown" aria-expanded="false">
                                                                            <i class="fas fa-ellipsis-v"></i>
                                                                        </button>

                                                                        <ul class="dropdown-menu">
                                                                            <li><button type='button' class='dropdown-item' wire:click='editBahanBaku("{{ $data["kodepesanbahanbaku"] }}")' data-coreui-target="#modalEditBahanBaku" data-coreui-toggle="modal"><i class="fas fa-edit me-2"></i> Edit</button></li>
                                                                            <li><button type='button' class='dropdown-item text-danger' wire:click='$dispatchSelf("confirm-delete-bahanbaku", { kode : "{{ $data["kodepesanbahanbaku"] }}", nama : "{{ $data["namabahanbaku"] }}" })'><i class="fas fa-trash me-2"></i> Hapus</button></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <hr class="mt-3 mb-2" />
                                            <div class="text-end mb-1">
                                                <button class="btn btn-outline-primary btn-sm" type="button" data-coreui-target="#modalDaftarBahanBaku" data-coreui-toggle="modal">
                                                    <i class="fas fa-plus"></i> Add Bahan Baku
                                                </button>
                                            </div>
                                            <div x-show="$wire.pesanDtForm.hargapokok > 0">
                                                <div class='d-flex justify-content-between mt-0'>
                                                    <h5 class='mt-2'>Total Harga Pokok</h5>
                                                    <h5 class='mt-2'>Rp{{ Number::format($pesanDtForm->hargapokok) }}</h5>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal" wire:click='resetForm'>Close</button>
                                <button type="button" class="btn btn-primary" wire:click='save'>Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}
