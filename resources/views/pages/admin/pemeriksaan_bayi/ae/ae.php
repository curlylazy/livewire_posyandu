<?php

use App\Lib\IDateTime;
use App\Lib\Pemeriksaan;
use App\Livewire\Forms\PasienForm;
use App\Livewire\Forms\PemeriksaanForm;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use App\Models\PosyanduModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;

new class extends Component
{
    public $pageTitle = "Pemeriksaan";
    public $pageName = "pemeriksaan";
    public $subPage = "bayi";
    public $dirView = "pemeriksaan_bayi";
    public $isEdit = false;
    public $id = "";

    public $pilihanModalPasien = "";
    public $judulModalPasien = "";
    public $keteranganModal = "";
    public $kategoriumur = "";
    public $kategoriumurArr = [];
    public $jk = "";

    public PemeriksaanForm $form;

    public function mount($id = null)
    {
        $this->form->kodeuser = Auth::guard()->user()->kodeuser;
        $this->setTitle();
        $this->readData($id);
    }

    public function setTitle()
    {
        $this->form->tgl_periksa = date('Y-m-d');
        $this->form->kategori_periksa = $this->subPage;
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
            $periodeOld = \Carbon\Carbon::parse($this->form->tgl_periksa_old)->format('Y-m');
            $periodeNew = \Carbon\Carbon::parse($this->form->tgl_periksa)->format('Y-m');
            if($periodeOld != $periodeNew)
            {
                $bulan = IDateTime::getMonth($this->form->tgl_periksa);
                $tahun = IDateTime::getYear($this->form->tgl_periksa);
                $isExist = PemeriksaanModel::searchByKodePasien($this->form->kodepasien)
                                ->searchByMonthYear(month: $bulan, year: $tahun)
                                ->searchByKategoriPeriksa($this->form->kategori_periksa)
                                ->exists();

                if($isExist)
                {
                    $this->dispatch('notif', message: "Maaf data tidak bisa disimpan, dikarenakan pasien {$this->form->namapasien} sudah melakukan pemeriksan di bulan ".IDateTime::formatDate($this->form->tgl_periksa, "MMMM Y") , icon: "error");
                    return;
                }
            }

            ($this->isEdit) ? $this->saveEdit() : $this->saveAdd();

            $this->redirect("/admin/$this->pageName/$this->subPage", navigate: true);

        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal simpan data : ".$e->getMessage(), icon: "error");
            return;
        }
    }

    public function saveAdd()
    {
        // $date = Carbon::parse($this->form->tgl_periksa);
        // $isExist = PemeriksaanModel::searchByKategoriPeriksa('bayi')
        //                 ->searchByKodePasien($this->form->kodepasien)
        //                 ->searchByMonthYear($date->month, $date->year)
        //                 ->exists();

        $this->form->store();
        session()->flash('success', "berhasil tambah data ".$this->form->namapasien);
    }

    public function saveEdit()
    {
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->form->namapasien);
    }

    // *** extra
    public function modalSelectPasien($data)
    {
        if($this->pilihanModalPasien == "ibu") {
            $this->form->resetBayi();
            $this->form->setIbu($data);
        }

        if($this->pilihanModalPasien == "bayi") {
            $this->form->setPasien($data);
        }

        $this->dispatch('close-modal', namamodal : 'modalPasien');
    }

    public function onClickOpenModalPasien($pilihan)
    {
        if($this->isEdit) {
            $this->dispatch('notif', message: 'Untuk edit tidak bisa ubah nama pasien lagi ya!', icon: 'warning');
            return;
        }

        $this->jk = "";
        $this->kategoriumur = "";
        $this->kategoriumurArr = [];

        if($pilihan == "ibu")
        {
            $this->kategoriumur = "Dewasa";
            $this->jk = "P";
            $this->judulModalPasien = "Pilih Ibu";
        }

        if($pilihan == "bayi")
        {
            $this->kategoriumurArr = ["'Balita'", "'Anak-anak'"];
            $this->judulModalPasien = "Pilih Bayi";
        }

        $this->pilihanModalPasien = $pilihan;
        $this->dispatch('open-modal', namamodal : 'modalPasien');
    }

    public function onClickOpenModalAddPasien($pilihan)
    {

        if($pilihan == "ibu")
        {
            $this->judulModalPasien = "Tambah Ibu";
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
        $this->form->kategori_periksa = $this->subPage;
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
}

?>
