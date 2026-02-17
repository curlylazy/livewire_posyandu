<div>

    @script
        <script>

            $wire.on('selected-data', (e) => {
                $wire.selectedNama = e.data.namauser;
                $wire.selectedKode = e.data.kodeuser;
                $wire.dispatch('open-modal', { namamodal: "modalPilihData" });
            });

            $wire.on('confirm-delete', (e) => {
                Swal.fire({
                    title: 'Hapus Data',
                    text: `Hapus data ${e.nama} dari sistem, lanjutkan ?`,
                    icon: "question",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.hapus(e.kode);
                        $wire.dispatch('close-modal', { namamodal: "modalPilihData" });
                    }
                });
            });
        </script>
    @endscript

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item active"><span>{{ $pageTitle }}</span></li>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>
            <div class="d-flex flex-column gap-2 mb-3">
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
                    <div class="col-12 col-lg-3 col-md-4">
                            <div class="form-floating">
                                <select type="text" class="form-control" id="kodeposyandu" wire:model='kodeposyandu' wire:change='commitPage'>
                                    <option value="">Pilih Posyandu</option>
                                    @foreach ($dataPosyandu as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                <label for="kodeposyandu">Posyandu</label>
                            </div>
                        </div>
                </div>
            </div>

            {{-- *** Large Device --}}
            <x-partials.viewlarge>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Posyandu</th>
                                <th scope="col">Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataRow as $row)
                                <tr role="button" wire:click='$dispatch("selected-data", { data : {{ $row }} })'>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->namauser }}</td>
                                    <td>{{ $row->posyandu->namaposyandu ?? "(Belum Ditentukan)" }}</td>
                                    <td>{{ $row->akses }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-partials.viewlarge>

            {{-- *** Mobile --}}
            <x-partials.viewsmall>
                <div class="row g-2">
                    @foreach ($dataRow as $row)
                        <div class="col-12 col-md-4">
                            <div class="card" role="button" wire:click='selectData({{ $row }})'>
                                <div class="card-body px-2 py-2">
                                    <div class="h5 mb-1">{{ $row->username }}</div>
                                    <div>{{ $row->namauser }}</div>
                                    <div>{{ $row->posyandu->namaposyandu ?? "(Belum Ditentukan)" }}</div>
                                    <div>{{ $row->akses }}</div>
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
                    <a class="btn btn-lg btn-outline-primary" id="edit" role="button" :href="`/admin/${pageName}/edit/${selectedKode}`" wire:navigate><i class="fas fa-edit"></i> Edit</a>
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
