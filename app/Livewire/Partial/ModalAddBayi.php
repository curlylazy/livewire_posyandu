<?php

namespace App\Livewire\Partial;

use App\Livewire\Forms\BayiForm;
use App\Livewire\Forms\PasienForm;
use App\Models\BayiModel;
use App\Models\PasienModel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Faker\Factory as Faker;

class ModalAddBayi extends Component
{
    public BayiForm $form;

    #[Reactive]
    public $kodepasien, $namapasien;

    public function mount()
    {
        $faker = Faker::create('id_ID');
        $this->form->namabayi = $faker->name();
        $this->form->tgl_lahir = $faker->dateTimeBetween('-5 months', '-1 months');
    }

    public function save()
    {
        try {
            $this->form->kodepasien = $this->kodepasien;
            $this->form->namapasien = $this->namapasien;
            $kodebayi = $this->form->store();
            $data = BayiModel::find($kodebayi);
            $this->dispatch('on-selectbayi', data: json_encode($data));
            $this->dispatch('close-modal', namamodal : 'modalBayiAdd');

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal simpan data : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <div wire:ignore.self class="modal fade" id="modalBayiAdd" tabindex="-1" aria-labelledby="modalBayiAddLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalBayiAddLabel">Bayi Tambah</h5>
                                <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <h6>Nama Ibu : {{ $namapasien }}</h6>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="namabayi" wire:model='form.namabayi'>
                                            <label for="namabayi">Nama Bayi</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="anak_ke" wire:model='form.anak_ke' x-mask:dynamic="$money($input)">
                                            <label for="anak_ke">Anak Ke ?</label>
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

                                    <div class="col-12 col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control date" id="form.tgl_lahir" wire:model='form.tgl_lahir' placeholder="">
                                            <label for="form.tgl_lahir">Tanggal Lahir</label>
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
                                        <div class="border rounded-3 p-2">
                                            <h6 class="fw-normal">Jenis Kelamin</h6>
                                            <div class="d-flex gap-2">
                                                <div>
                                                    <input type="radio" class="btn-check" name="jk" value="L" id="jk_l" autocomplete="off" wire:model="form.jk">
                                                    <label class="btn" for="jk_l"><i class="fas fa-mars"></i> Laki Laki</label>
                                                </div>
                                                <div>
                                                    <input type="radio" class="btn-check" name="jk" value="P" id="jk_p" autocomplete="off" wire:model="form.jk">
                                                    <label class="btn" for="jk_p"><i class="fas fa-venus"></i> Perempuan</label>
                                                </div>
                                            </div>
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
