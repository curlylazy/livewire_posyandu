<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\BlogModel;

new class extends Component
{
    use WithPagination;

    public $pageTitle = "Blog";
    public $pageName = "blog";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = BlogModel::search($this->katakunci)->paginate(20);
        return $data;
    }

    public function hapus($id)
    {
        $data = BlogModel::find($id);
        $namadata = $data->judul;
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
    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item active"><span>{{ $pageTitle }}</span></li>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>
            <div class="mb-3">
                <a class="btn btn-outline-secondary" type="button" href="{{ url("admin/") }}"><i class="fas fa-arrow-left"></i></a>
                <a class="btn btn-outline-primary" role="button" href="{{ url("admin/$pageName/add") }}" wire:navigate><i class="fas fa-plus"></i> Tambah</a>
                <input type="text" class="form-control mt-2" placeholder="masukkan kata kunci pencarian..." wire:model='katakunci' wire:keydown.enter='$commit'>
            </div>

            <x-partials.containerdata :dataRows="$dataRow">

                <div class="row g-4">
                    @foreach ($dataRow as $row)
                        <div class="col-md-3 col-12" wire:click='$dispatch("selected-data", { data : {{ $row }} })' role="button">
                            <div class="d-flex flex-column">
                                <img src="{{ ImageUtils::getImageThumb($row->gambarblog) }}" class="rounded mb-2" style="height: 250px; width: 100%; object-fit: cover;"/>
                                <div class="d-flex justify-content-between">
                                    <div class="fs-sm text-secondary">{{ IDateTime::formatDate($row->created_at) }}</div>
                                </div>
                                <h5 class="mt-0 text-justify">{{ Str::limit($row->judul, 50) }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{ $dataRow->links() }}

            </x-partials.containerdata>

            {{-- *** Modal Selected --}}
            <x-partials.modalselected>
                <x-slot:pageTitle><span wire:text="pageTitle"></span></x-slot>
                <x-slot:selectedNama><span wire:text="selectedNama"></span></x-slot>
                <div class="d-grid gap-2" x-data="{ selectedKode: $wire.entangle('selectedKode'), pageName: $wire.entangle('pageName')}">
                    <button type="button" class="btn btn-lg btn-outline-primary" data-coreui-dismiss="modal" wire:click='$dispatch("edit")'><i class="fa-solid fa-edit"></i> Edit</button>
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

{{-- *** Script --}}
<script>
    $wire.on('selected-data', (e) => {
        $wire.selectedNama = e.data.judul;
        $wire.selectedKode = e.data.kodeblog;
        $wire.dispatch('open-modal', { namamodal: "modalPilihData" });
    });

    $wire.on('edit', (e) => {
        Livewire.navigate(`/admin/${$wire.pageName}/${$wire.selectedKode}`);
    });

    $wire.on('confirm-delete', (e) => {
        Swal.fire({
            title: 'Hapus Data',
            text: `Hapus data ${$wire.selectedNama} dari sistem, lanjutkan ?`,
            icon: "question",
            showCancelButton: true,
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.hapus($wire.selectedKode);
                $wire.dispatch('close-modal', { namamodal: "modalPilihData" });
            }
        });
    });
</script>
