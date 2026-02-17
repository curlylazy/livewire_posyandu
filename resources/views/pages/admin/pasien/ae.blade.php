<?php

use App\Lib\GetString;
use App\Lib\IDateTime;
use App\Livewire\Forms\PasienForm;
use App\Models\PasienModel;
use App\Models\PosyanduModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

new class extends Component
{
    public $pageTitle = "Pasien";
    public $pageName = "pasien";
    public $isEdit = false;
    public $id = "";

    public $pilihanayahibu = "";
    public $judulModalPasien = "";

    public PasienForm $form;

    public function mount($id = null)
    {
        $this->form->kodeuser = Auth::user()->kodeuser;
        // $this->form->kodeposyandu = PosyanduModel::searchBySeo('kebonkuri-lukluk')->first()->kodeposyandu;
        $this->readData($id);
    }

    public function readData($id = null)
    {
        if(empty($id))
            return;

        $this->form->setPost($id);
        $this->id = $id;
        $this->isEdit = true;
        $this->pageTitle = "Edit ".Str::title($this->pageName);
    }

    public function readDataPosyandu()
    {
        $res = PosyanduModel::pluck('namaposyandu', 'kodeposyandu');
        return $res;
    }

    public function save()
    {
        try {
            ($this->isEdit) ? $this->saveEdit() : $this->saveAdd();

            $this->redirect("/admin/$this->pageName", navigate: true);

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal simpan data : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function saveAdd()
    {
        $this->form->store();
        session()->flash('success', "berhasil tambah data ".$this->form->namapasien);
    }

    public function saveEdit()
    {
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->form->namapasien);
    }

    // *** extra
    public function onChangeCekKategoriUmur()
    {
        $this->form->umur = IDateTime::dateDiff($this->form->tgl_lahir);
        $this->form->kategoriumur = GetString::getKategoriUmur($this->form->umur);
    }

    public function onClickOpenModalPasien($pilihan)
    {
        $this->pilihanayahibu = $pilihan;

        if($pilihan == "lakilakiDewasa") {
            $this->judulModalPasien = "Daftar Ayah";
        } elseif($pilihan == "perempuanDewasa") {
            $this->judulModalPasien = "Daftar Ibu";
        } elseif($pilihan == "suami") {
            $this->judulModalPasien = "Suami";
        }

        $this->dispatch('open-modal', namamodal : 'modalPasien');
    }

    // *** extra : action on modal
    public function modalSelectPasien($data)
    {
        $data = json_decode($data);
        if($this->pilihanayahibu == "lakilakiDewasa")
        {
            $this->form->kodeayah = $data->kodepasien;
            $this->form->namaayah = $data->namapasien;
        }
        elseif($this->pilihanayahibu == "perempuanDewasa")
        {
            $this->form->kodeibu = $data->kodepasien;
            $this->form->namaibu = $data->namapasien;
        }
        elseif($this->pilihanayahibu == "suami")
        {
            $this->form->kodesuami = $data->kodepasien;
            $this->form->namasuami = $data->namapasien;
        }

        $this->dispatch('close-modal', namamodal : 'modalPasien');
    }

    public function render()
    {
        return $this->view([
                'dataPosyandu' => $this->readDataPosyandu(),
            ])
            ->layout('layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
};

?>

{{-- *** Views --}}
<div>
    <livewire:components::modal-pasien
        :pilihanayahibu="$pilihanayahibu"
        :judulModal="$judulModalPasien"
        @selectpasien="modalSelectPasien($event.detail.data)"
    />

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url("/admin") }}" class="text-decoration-none" wire:navigate><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{ url("/admin/$pageName") }}" class="text-decoration-none" wire:navigate><span>{{ $pageTitle }}</span></a></li>
        @if($isEdit)
            <li class="breadcrumb-item"><span>Edit</span></li>
            <li class="breadcrumb-item active"><span>{{ $form->namapasien }}</span></li>
        @else
            <li class="breadcrumb-item active"><span>Tambah</span></li>
        @endif
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>

            <form wire:submit="save">

                <div class="row g-2">
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Kategori Umur</h6>
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="kategoriumur" value="Balita" id="kategoriumur_balita" autocomplete="off" wire:model="form.kategoriumur">
                                    <label class="btn" for="kategoriumur_balita">Balita</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="kategoriumur" value="Anak-anak" id="kategoriumur_anakanak" autocomplete="off" wire:model="form.kategoriumur">
                                    <label class="btn" for="kategoriumur_anakanak">Anak-anak</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="kategoriumur" value="Remaja" id="kategoriumur_remaja" autocomplete="off" wire:model="form.kategoriumur">
                                    <label class="btn" for="kategoriumur_remaja">Remaja</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="kategoriumur" value="Dewasa" id="kategoriumur_dewasa" autocomplete="off" wire:model="form.kategoriumur">
                                    <label class="btn" for="kategoriumur_dewasa">Dewasa</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="kategoriumur" value="Lansia" id="kategoriumur_lansia" autocomplete="off" wire:model="form.kategoriumur">
                                    <label class="btn" for="kategoriumur_lansia">Lansia</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Jenis Kelamin</h6>
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="jk" value="L" id="jk_lakilaki" autocomplete="off" wire:model="form.jk">
                                    <label class="btn" for="jk_lakilaki">Laki Laki</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="jk" value="P" id="jk_perempuan" autocomplete="off" wire:model="form.jk">
                                    <label class="btn" for="jk_perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nik" wire:model='form.nik' maxlength="16">
                            <label for="nik">NIK <span x-text="$wire.form.nik ? `(${$wire.form.nik.length}/16)` : `(0/16)`"></span></label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="namapasien" wire:model='form.namapasien'>
                            <label for="namapasien">Nama Pasien</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control date" id="form.tgl_lahir" wire:model='form.tgl_lahir' wire:change='onChangeCekKategoriUmur' placeholder="">
                            <label for="form.tgl_lahir">Tanggal Lahir</label>
                        </div>
                    </div>

                </div>

                {{-- *** munculkan jika adalah seorang perempuan --}}
                <div class="row g-2 mt-0" x-show="$wire.form.jk == 'P' && ($wire.form.kategoriumur == 'Remaja' || $wire.form.kategoriumur == 'Dewasa')" x-cloak>
                    <div class="col-12 col-md-12">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="kategoripasien" wire:model='form.kategoripasien'>
                                <option value="">Pilih Kategori Pasien</option>
                                @foreach (Option::kategoriPasien() as $data)
                                    <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                            <label for="kategoripasien">Kategori Pasien</label>
                        </div>
                    </div>
                </div>

                {{-- *** tampil jika pasien adalah ibu hamil --}}
                <div class="row g-2 mt-0" x-show="$wire.form.kategoripasien == 'bumil'" x-cloak>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="hamil_ke" wire:model='form.hamil_ke' x-mask:dynamic="$money($input)">
                            <label for="hamil_ke">Hamil Ke ?</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="bulan_ke" wire:model='form.bulan_ke'>
                            <label for="bulan_ke">Bulan Ke ?</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mt-0">
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="kodeposyandu" wire:model='form.kodeposyandu'>
                                <option value="">Pilih Posyandu</option>
                                @foreach ($dataPosyandu as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            <label for="kodeposyandu">Posyandu</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="alamat" wire:model='form.alamat'>
                            <label for="alamat">Alamat</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nohp" wire:model='form.nohp'>
                            <label for="nohp">No Handphone</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="beratbadan" wire:model='form.beratbadan' x-mask:dynamic="$money($input)">
                            <label for="bb">Berat Badan</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="lila" wire:model='form.lila' x-mask:dynamic="$money($input)">
                            <label for="lila">Lingkar Lengan</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="tekanan_darah" wire:model='form.tekanan_darah' x-mask:dynamic="$money($input)">
                            <label for="tekanan_darah">Tekanan Darah</label>
                        </div>
                    </div>
                </div>

                {{-- jika sudah remaja / dewasa dan perempuan bisa tentukan siapa suaminya --}}
                <div class="row g-2 mt-0" x-show="($wire.form.kategoriumur == 'Dewasa' || $wire.form.kategoriumur == 'Remaja' || $wire.form.kategoriumur == 'Lansia') && $wire.form.jk == 'P'" x-cloak>
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="form-floating pe-none">
                                <input type="text" class="form-control" id="namasuami" wire:model='form.namasuami' placeholder="">
                                <label for="namasuami">Suami</label>
                            </div>
                            <button type="button" class="input-group-text" wire:click='onClickOpenModalPasien("suami")'><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>

                {{-- kategori umur : balita --}}
                <div class="row g-2 mt-0" x-show="$wire.form.kategoriumur == 'Balita' || $wire.form.kategoriumur == 'Anak-anak'" x-cloak>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="form-floating pe-none">
                                <input type="text" class="form-control" id="namaayah" wire:model='form.namaayah' placeholder="">
                                <label for="namaayah">Ayah</label>
                            </div>
                            <button type="button" class="input-group-text" wire:click='onClickOpenModalPasien("lakilakiDewasa")'><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="form-floating pe-none">
                                <input type="text" class="form-control" id="namaibu" wire:model='form.namaibu' placeholder="">
                                <label for="namaibu">Ibu</label>
                            </div>
                            <button type="button" class="input-group-text" wire:click='onClickOpenModalPasien("perempuanDewasa")'><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="anakke" wire:model='form.anakke' x-mask:dynamic="$money($input)">
                            <label for="anakke">Anakke</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="tinggibadan_lahir" wire:model='form.tinggibadan_lahir' x-mask:dynamic="$money($input)">
                            <label for="tinggibadan_lahir">Tinggi Badan Lahir</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="beratbadan_lahir" wire:model='form.beratbadan_lahir' x-mask:dynamic="$money($input)">
                            <label for="beratbadan_lahir">Berat Badan Lahir</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="carabersalin" wire:model='form.carabersalin'>
                                @foreach (Option::caraBersalin() as $data)
                                    <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                            <label for="carabersalin">Cara Bersalin</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control date" id="form.tgl_bersalin" wire:model='form.tgl_bersalin' placeholder="">
                            <label for="form.tgl_bersalin">Tanggal Bersalin</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="form.tempatbersalin" wire:model='form.tempatbersalin' placeholder="">
                            <label for="form.tempatbersalin">Tempat Bersalin</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mt-0">
                    <div class="col-12 col-md-12">
                        <div class="border rounded-3 p-2">
                            <h6 class="fw-normal">Status Aktif Pasien</h6>
                            <div class="d-flex gap-2">
                                <div>
                                    <input type="radio" class="btn-check" name="status" value="1" id="status_ya" autocomplete="off" wire:model="form.status">
                                    <label class="btn" for="status_ya">Aktif</label>
                                </div>
                                <div>
                                    <input type="radio" class="btn-check" name="status" value="0" id="status_tidak" autocomplete="off" wire:model="form.status">
                                    <label class="btn" for="status_tidak">Tidak Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex mt-3 gap-2">
                    <a href="{{ url("admin/$pageName") }}" class="btn btn-secondary" type="button" wire:navigate><i class="fas fa-arrow-left"></i></a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- *** External Asset --}}
@assets
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endassets

<script>
    flatpickr(".date", { dateFormat: "Y-m-d", disableMobile: "true" });
</script>
