<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PosyanduModel;

new class extends Component
{
    use WithPagination;

    public $pageTitle = "Posyandu";
    public $pageName = "posyandu";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "";

    public function mount()
    {

    }

    public function readData()
    {
        $data = PosyanduModel::search($this->katakunci)
                ->latest()
                ->paginate(20);

        return $data;
    }

    public function hapus($id)
    {
        $data = PosyanduModel::find($id);
        $namadata = $data->namaposyandu;
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
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex gap-1">
                        <a class="btn btn-outline-secondary" type="button" href="{{ url("admin/") }}"><i class="fas fa-arrow-left"></i></a>
                        <a class="btn btn-outline-primary" role="button" href="{{ url("admin/$pageName/add") }}" wire:navigate><i class="fas fa-plus"></i> Tambah</a>
                    </div>
                    <div class="row g-2">
                        <div class="col-12 col-lg-3 col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="katakunci" placeholder="masukkan kata kunci pencarian..." wire:model='katakunci' wire:keydown.enter='$commit'>
                                <label for="katakunci">Katakunci</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-partials.containerdata :dataRows="$dataRow">
                {{-- *** Large Device --}}
                <x-partials.viewlarge>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Posyandu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataRow as $row)
                                    <tr role="button" wire:click='$dispatch("selected-data", { "data" : {{ $row }} })'>
                                        <td>{{ $row->namaposyandu }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-partials.viewlarge>
            </x-partials.containerdata>

            {{-- *** Mobile --}}
            <x-partials.viewsmall>
                <div class="row g-2">
                    @foreach ($dataRow as $row)
                        <div class="col-12 col-md-4">
                            <div class="card" role="button" wire:click='$dispatch("selected-data", { "data" : {{ $row }} })'>
                                <div class="card-body px-2 py-2">
                                    <div class="h5 mb-1">{{ $row->namaposyandu }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-partials.viewsmall>

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
        $wire.selectedNama = e.data.namaposyandu;
        $wire.selectedKode = e.data.kodeposyandu;
        $wire.dispatch('open-modal', { namamodal: "modalPilihData" });
    });

    $wire.on('edit', (e) => {
        Livewire.navigate(`/admin/${$wire.pageName}/edit/${$wire.selectedKode}`);
    });

    $wire.on('confirm-delete', () => {
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
