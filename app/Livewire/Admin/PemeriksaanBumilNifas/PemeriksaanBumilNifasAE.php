<?php

namespace App\Livewire\Admin\PemeriksaanBumilNifas;

use App\Lib\IDateTime;
use App\Livewire\Forms\PasienForm;
use App\Livewire\Forms\PemeriksaanForm;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

class PemeriksaanBumilNifasAE extends Component
{
    public $pageTitle = "Pemeriksaan";
    public $pageName = "pemeriksaan";
    public $subPage = "bumilnifas";
    public $dirView = "pemeriksaan_bumilnifas";
    public $isEdit = false;
    public $id = "";

    public $pilihanModalPasien = "";
    public $judulModalPasien = "";
    public $keteranganModal = "";
    public $kategoriumur = "";
    public $jk = "";

    #[Url()]
    public $kategori_periksa = "";

    public PemeriksaanForm $form;

    public function mount($id = null)
    {
        $this->form->kodeuser = Auth::user()->kodeuser;
        $this->readData($id);
        $this->setTitle();
    }

    public function setTitle()
    {
        if($this->kategori_periksa == "bumil"){
            $this->pageTitle = "Pemeriksaan Ibu Hamil";
        }

        if($this->kategori_periksa == "nifas"){
            $this->pageTitle = "Pemeriksaan Nifas";
        }

        $this->form->tgl_periksa = date('Y-m-d');
        $this->form->kategori_periksa = $this->kategori_periksa;
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

    public function save()
    {
        try
        {
            // *** cek apakah pasien sudah melakukan pemeriksaan, jika tanggalnya tidak sama maka lakukan validasi
            if($this->form->tgl_periksa != $this->form->tgl_periksa_old)
            {
                $bulan = IDateTime::getMonth($this->form->tgl_periksa);
                $tahun = IDateTime::getYear($this->form->tgl_periksa);
                $isExist = PemeriksaanModel::searchByKodePasien($this->form->kodepasien)
                                ->searchByMonthYear(month: $bulan, year: $tahun)
                                ->searchByKategoriPeriksa($this->kategori_periksa)
                                ->exists();

                if($isExist)
                {
                    $this->dispatch('notif', message: "Maaf data tidak bisa disimpan, dikarenakan pasien {$this->form->namapasien} sudah melakukan pemeriksan di bulan ".IDateTime::formatDate($this->form->tgl_periksa, "MMMM Y") , icon: "error");
                    return;
                }
            }


            ($this->isEdit) ? $this->saveEdit() : $this->saveAdd();

            $this->redirect("/admin/$this->pageName/bumilnifas?kategori_periksa=".$this->kategori_periksa, navigate: true);
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
        $this->redirect("/admin/$this->pageName/bumilnifas?kategori_periksa=".$this->kategori_periksa, navigate: true);
    }

    // *** extra
    public function modalSelectPasien($data)
    {
        if($this->pilihanModalPasien == "bumilnifas") {
            $this->form->resetBayi();
            $this->form->setPasien($data);
        }

        if($this->pilihanModalPasien == "bayi") {
            $this->form->setBayi($data);
        }

        $this->dispatch('close-modal', namamodal : 'modalPasien');
    }

    // #[On('on-selectbayi')]
    // public function selectBayi($data)
    // {
    //     $this->form->setBayi($data);
    //     $this->dispatch('close-modal', namamodal : 'modalBayi');
    // }

    // public function onClickPilihBayi()
    // {
    //     if(empty($this->form->kodepasien)) {
    //         $this->dispatch('notif', message: 'Pilih dulu Ibu, baru kemudian pilih anaknya', icon: 'warning');
    //         return;
    //     }

    //     if($this->isEdit) {
    //         $this->dispatch('notif', message: 'Untuk edit tidak bisa ubah nama bayi lagi ya!', icon: 'warning');
    //         return;
    //     }

    //     $this->dispatch('open-modal', namamodal : 'modalBayi');
    // }

    public function onClickOpenModalPasien($pilihan)
    {
        if($this->isEdit) {
            $this->dispatch('notif', message: 'Untuk edit tidak bisa ubah nama pasien lagi ya!', icon: 'warning');
            return;
        }

        $this->keteranganModal = "";
        $this->jk = "";

        if($pilihan == "bumilnifas") {
            $this->kategoriumur = "Dewasa";
            $this->jk = "P";
            $this->judulModalPasien = "Pilih Ibu Nifas / Hamil";
        }

        if($pilihan == "bayi") {

            if(empty($this->form->kodepasien)) {
                $this->dispatch('notif', message: 'Oops tidak bisa, harus pilih ibunya dulu ya!', icon: 'warning');
                return;
            }

            $this->kategoriumur = "Balita";
            $this->judulModalPasien = "Pilih Bayi";
            $this->keteranganModal = "Ibu : ".$this->form->namapasien;
        }

        $this->pilihanModalPasien = $pilihan;
        $this->dispatch('open-modal', namamodal : 'modalPasien');
    }

    public function onClickOpenModalAddPasien($pilihan)
    {

        if($pilihan == "bumilnifas")
        {
            $this->judulModalPasien = "Tambah Pasien Ibu Hamil / Nifas";
        }

        if($pilihan == "bayi")
        {
            if(empty($this->form->kodepasien)) {
                $this->dispatch('notif', message: 'Pilih dulu Ibu, baru kemudian bisa menambahkan data bayi', icon: 'warning');
                return;
            }

            $this->judulModalPasien = "Tambah Pasien Bayi";
        }

        $this->pilihanModalPasien = $pilihan;
        $this->dispatch('open-modal', namamodal : 'modalPasienAdd');
    }

    public function onClickBayiAdd()
    {
        if(empty($this->form->kodepasien)) {
            $this->dispatch('notif', message: 'Pilih dulu Ibu, baru kemudian bisa menambahkan data bayi', icon: 'warning');
            return;
        }

        $this->dispatch('open-modal', namamodal : 'modalBayiAdd');
    }

    public function onClickResetDataPasien()
    {
        $this->form->resetForm();
        $this->form->kategori_periksa = $this->kategori_periksa;
    }

    public function render()
    {
        return view('livewire.admin.' . $this->dirView . '.ae')
            ->layout('components.layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}
