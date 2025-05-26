<?php

namespace App\Livewire\Partial;

use App\Livewire\Forms\PasienForm;
use App\Models\PasienModel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Faker\Factory as Faker;

class ModalAddPasien extends Component
{
    public PasienForm $form;
    public $kategori_periksa, $pilihanAdd, $kodeibu, $judulModal = "Tambah Pasien";

    // #[Reactive]
    // public $kategori_periksa, $pilihanAdd, $kodeibu, $judulModal = "Tambah Pasien";

    public function mount($kategori_periksa = "", $pilihanAdd = "", $kodeibu = "", $judulModal = "Tambah Pasien")
    {
        $this->kategori_periksa = $kategori_periksa;
        $this->pilihanAdd = $pilihanAdd;
        $this->kodeibu = $kodeibu;
        $this->judulModal = $judulModal;
    }

    public function booted()
    {
        // if($this->kategori_periksa == "bumil")
        // {
        //     $this->form->kategoripasien = "bumil";
        // }
        // else
        // {
        //     $this->form->kategoripasien = "nifas";
        // }

        // $faker = Faker::create('id_ID');

        // if($this->pilihanAdd == "bumilnifas")
        // {
        //     $this->form->nik = $faker->nik();
        //     $this->form->hamil_ke = 1;
        //     $this->form->minggu_ke = 1;
        //     $this->form->namapasien = $faker->name(gender: "female");
        //     $this->form->tgl_lahir = $faker->dateTimeBetween('-40 years', '-30 years');
        //     $this->form->alamat = $faker->address();
        // }

        // if($this->pilihanAdd == "bayi")
        // {
        //     $dataIbu = PasienModel::find($this->kodeibu);
        //     $this->form->kodeibu = $this->kodeibu;
        //     $this->form->namaibu = $dataIbu->namapasien;
        //     $this->form->namapasien = $faker->name();
        //     $this->form->tgl_lahir = $faker->dateTimeBetween('-5 months', '-1 months');
        // }
    }

    public function save()
    {
        try
        {
            // *** cek apakah nik sudah terpakai
            $isExistsNik = PasienModel::searchByNik($this->form->nik)->exists();
            if($isExistsNik) {
                $this->dispatch('notif', message : 'NIK yang diinputkan ternyata sudah ada nih di database, coba cek kembali ya NIK yang kamu gunakan', icon: 'warning');
                return;
            }

            $kodepasien = $this->form->store();
            $data = PasienModel::find($kodepasien);
            $this->dispatch('saved', data: json_encode($data));
            $this->dispatch('close-modal', namamodal : 'modalPasienAdd');

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal simpan data : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function render()
    {
        // $this->mountReactive();

        return <<<'HTML'
            <div>
                <div wire:ignore.self class="modal fade" id="modalPasienAdd" tabindex="-1" aria-labelledby="modalPasienAddLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalPasienAddLabel">{{ $judulModal }}</h5>
                                <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2 mb-2">
                                    <div class="col-md-12">
                                        <div class="form-floating" x-show="$wire.pilihanAdd == 'bumilnifas'" x-cloak>
                                            <input type="text" class="form-control" id="nik" wire:model='form.nik'>
                                            <label for="nik">NIK</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="namapasien" wire:model='form.namapasien'>
                                            <label for="namapasien">Nama Pasien</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
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
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control date" id="form.tgl_lahir" wire:model='form.tgl_lahir' placeholder="">
                                            <label for="form.tgl_lahir">Tanggal Lahir</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- *** untuk data ibu -->
                                <div class="row g-2" x-show="$wire.pilihanAdd == 'bumilnifas'" x-cloak>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="hamil_ke" wire:model='form.hamil_ke'>
                                            <label for="hamil_ke">Hamil Ke</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="minggu_ke" wire:model='form.minggu_ke'>
                                            <label for="minggu_ke">Minggu Ke</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
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
                                </div>

                                <!-- *** jika bayi -->
                                <div class="row g-2" x-show="$wire.pilihanAdd == 'bayi'" x-cloak>
                                    <div class="col-md-12 pe-none">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="namaibu" wire:model='form.namaibu'>
                                            <label for="namaibu">Nama Ibu</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="anakke" wire:model='form.anakke' x-mask:dynamic="$money($input)">
                                            <label for="anakke">Anak Ke - ?</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control date" id="form.tgl_bersalin" wire:model='form.tgl_bersalin' placeholder="">
                                            <label for="form.tgl_bersalin">Tanggal Bersalin</label>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="form.tempatbersalin" wire:model='form.tempatbersalin' placeholder="">
                                            <label for="form.tempatbersalin">Tempat Bersalin</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-floating">
                                            <select type="text" class="form-control" id="carabersalin" wire:model='form.carabersalin'>
                                                @foreach (Option::caraBersalin() as $data)
                                                    <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <label for="carabersalin">Cara Bersalin</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="tinggibadan_lahir" wire:model='form.tinggibadan_lahir' x-mask:dynamic="$money($input)">
                                            <label for="tinggibadan_lahir">Tinggi Badan Lahir</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="beratbadan_lahir" wire:model='form.beratbadan_lahir' x-mask:dynamic="$money($input)">
                                            <label for="beratbadan_lahir">Berat Badan Lahir</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex mt-3 gap-2">
                                    <button type="button" class="btn btn-primary" wire:click='save'><i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}
