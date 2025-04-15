<div>

    @script
        <script>
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
            <div class="mb-3">
                <a class="btn btn-outline-secondary" type="button" href="{{ url("admin/") }}"><i class="fas fa-arrow-left"></i></a>
                <a class="btn btn-outline-primary" role="button" href="{{ url("admin/$pageName/add") }}" wire:navigate><i class="fas fa-plus"></i> Tambah</a>
                <input type="text" class="form-control mt-2" placeholder="masukkan kata kunci pencarian..." wire:model='katakunci' wire:keydown.enter='$commit'>
            </div>

            <x-partials.containerdata :dataRows="$dataRow">
                {{-- *** Large Device --}}
                <x-partials.viewlarge>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Umur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataRow as $row)
                                    <tr role="button" wire:click='selectData({{ $row }})'>
                                        <td>{{ $row->nik }}</td>
                                        <td>{{ $row->namapasien }}</td>
                                        <td>{{ Str::title($row->kategoripasien) }}</td>
                                        <td>{{ IDateTime::formatDate($row->tgl_lahir) }}</td>
                                        <td>{{ IDateTime::dateDiff($row->tgl_lahir) }} Tahun</td>
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
                            <div class="card" role="button" wire:click='selectData({{ $row }})'>
                                <div class="card-body px-2 py-2">
                                    <div class="h5 mb-1">{{ $row->namapasien }}</div>
                                    <div>{{ $row->nik }}</div>
                                    <div>{{ Str::title($row->kategoripasien) }}</div>
                                    <div>{{ IDateTime::formatDate($row->tgl_lahir) }}</div>
                                    <div>{{ IDateTime::dateDiff($row->tgl_lahir) }} Tahun</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-partials.viewsmall>

            {{-- *** Modal Selected --}}
            <x-partials.modalselected>
                <x-slot:pageTitle>{{ $pageTitle }}</x-slot>
                <x-slot:selectedNama>{{ $selectedNama }}</x-slot>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-outline-primary" href="{{ url("admin/$pageName/edit/$selectedKode") }}" role="button"><i class="fas fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-lg btn-outline-danger" data-coreui-dismiss="modal" wire:click='$dispatch("confirm-delete", { kode: "{{ $selectedKode }}", nama: "{{ $selectedNama }}" })'><i class="fas fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-lg btn-outline-secondary" data-coreui-dismiss="modal"><i class="fas fa-close"></i> Batal</button>
                </div>
            </x-partials.modalselected>

            <div class="text-center mt-4">
                {{ $dataRow->links() }}
            </div>
        </div>
    </div>

</div>
