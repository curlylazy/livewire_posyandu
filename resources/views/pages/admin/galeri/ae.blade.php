<?php

use App\Livewire\Forms\GaleriForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $pageTitle = "Galeri";
    public $pageName = "galeri";
    public $isEdit = false;
    public $id = "";

    public GaleriForm $form;

    public function mount($id = null)
    {
        $this->form->namagaleri = "Galeri ".Carbon::now()->format('F j, Y');
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
        session()->flash('success', "berhasil tambah data ".$this->form->namagaleri);
    }

    public function saveEdit()
    {
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->form->namagaleri);
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
};

?>

{{-- *** Views --}}
<div>
    <x-partials.loader />

    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url("/admin") }}" class="text-decoration-none" wire:navigate><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{ url("/admin/$pageName") }}" class="text-decoration-none" wire:navigate><span>{{ $pageTitle }}</span></a></li>
        @if($isEdit)
            <li class="breadcrumb-item"><span>Edit</span></li>
            <li class="breadcrumb-item active"><span>{{ $form->namagaleri }}</span></li>
        @else
            <li class="breadcrumb-item active"><span>Tambah</span></li>
        @endif
    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>

            <form wire:submit="save">

                <div class="row g-2">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="namagaleri" wire:model='form.namagaleri'>
                            <label for="namagaleri">Judul Galeri</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="form.gambargaleriFile" class="form-label">Gambar</label>
                        <input class="form-control" type="file" id="form.gambargaleriFile" wire:model='form.gambargaleriFile'>
                        @if ($form->gambargaleriFile)
                            <img src="{{ $form->gambargaleriFile->temporaryUrl() }}" style="width: 500px; height: 500px; object-fit: cover;" class="rounded mt-2">
                        @elseif(!empty($form->gambargaleri))
                            <div class="d-inline-flex flex-column gap-2">
                                <a href="{{ ImageUtils::getImage($form->gambargaleri) }}" target="_blank">
                                    <img src="{{ ImageUtils::getImageThumb($form->gambargaleri) }}" style="width: 500px; height: 500px; object-fit: cover;" class="rounded mt-2">
                                </a>
                                <button type="button" class="btn btn-sm btn-danger text-white" wire:click='$dispatch("confirm-delete-gambar")'><i class="fas fa-trash"></i> Hapus Gambar</button>
                            </div>
                        @endif
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

{{-- *** Script --}}
<script>
    $wire.on('confirm-delete-gambar', (e) => {
        Swal.fire({
            title: 'Hapus Gambar',
            text: `Item yang kamu pilih gambarnya akan dihapus, lanjutkan ?`,
            icon: "question",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.hapusIcon();
            }
        });
    });
</script>
