<?php

use App\Livewire\Forms\BlogForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $pageTitle = "Blog";
    public $pageName = "blog";
    public $isEdit = false;
    public $id = "";

    public BlogForm $form;

    public function mount($id = null)
    {
        $this->form->kodeuser = Auth::user()->kodeuser;
        $this->form->tgl_blog = date('Y-m-d');
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
        session()->flash('success', "berhasil tambah data ".$this->form->judul);
    }

    public function saveEdit()
    {
        $this->form->update();
        session()->flash('success', "berhasil edit data ".$this->form->judul);
    }

    // *** extra
    public function hapusGambar()
    {
        $this->form->hapusGambar($this->form->kodeblog);
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
            <li class="breadcrumb-item active"><span>{{ $form->judul }}</span></li>
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
                    <div class="col-md-12 col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="judul" wire:model='form.judul'>
                            <label for="judul">Judul</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control date" id="form.tgl_blog" wire:model='form.tgl_blog' placeholder="">
                            <label for="form.tgl_blog">Tanggal Blog</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <livewire:jodit-text-editor wire:model="form.isi" />
                    </div>

                    <div class="col-12 col-md-6">
                        <x-partials.imgupload
                            label="Gambar"
                            model="form.gambarblogFile"
                            dispatchDelete="confirm-delete-gambar"
                            :temp="$form->gambarblogFile"
                            :gambar="$form->gambarblog"
                        />
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
    <!-- Include Jodit CSS Styling -->
    <link rel="stylesheet" href="//unpkg.com/jodit@4.1.16/es2021/jodit.min.css">
    <script src="//unpkg.com/jodit@4.1.16/es2021/jodit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endassets

<script>
    flatpickr(".date", { dateFormat: "Y-m-d", disableMobile: "true" });

    $wire.on('confirm-delete-gambar', (e) => {
        Swal.fire({
            title: 'Hapus Gambar',
            text: `Item yang kamu pilih gambarnya akan dihapus, lanjutkan ?`,
            icon: "question",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.hapusGambar();
            }
        });
    });
</script>