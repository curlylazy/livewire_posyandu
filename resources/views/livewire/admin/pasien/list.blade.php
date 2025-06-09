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

    <livewire:partial.modal-pasien
        judulModal="Daftar Ibu"
        pilihanayahibu="perempuanDewasa"
        @selectpasien="modalSelectPasien($event.detail.data)"
    />

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
                        <div class="col-12 col-lg-3 col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="kategoripasien" wire:model='kategoripasien' wire:change='commitPage'>
                                    <option value="">Semua Kategori</option>
                                    @foreach (Option::kategoriPasien() as $data)
                                        <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                                <label for="kategoripasien">Kategori Pasien</label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="status" wire:model='status' wire:change='commitPage'>
                                    <option value="">Semua Pasien</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                <label for="status">Status Pasien</label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="kategoriumur" wire:model='kategoriumur' wire:change='commitPage'>
                                    <option value="">Semua Kategori Umur</option>
                                    @foreach (Option::kategoriUmur() as $data)
                                        <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                                <label for="kategoriumur">Kategori Umur</label>
                            </div>
                        </div>

                        <div class="col-12 col-lg-3 col-md-4">
                            <div class="input-group">
                                <div class="form-floating pe-none">
                                    <input type="text" class="form-control" id="namaibu" wire:model='namaibu' placeholder="">
                                    <label for="namaibu">Ibu</label>
                                </div>
                                <button type="button" class="input-group-text" wire:click='$dispatch("open-modal", { namamodal : "modalPasien" })'><i class="fas fa-search"></i></button>
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
                                    <th scope="col">NIK</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">JK</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Kategori Umur</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Umur</th>
                                    <th scope="col" x-show="$wire.status == ''" x-cloak>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataRow as $row)
                                    <tr role="button" wire:click='selectData({{ $row }})'>
                                        <td>{{ FilterString::filterString($row->nik) }}</td>
                                        <td>{{ $row->namapasien }}</td>
                                        <td>{{ $row->jk }}</td>
                                        <td>{{ FilterString::filterString(Str::title($row->kategoripasien)) }}</td>
                                        <td>{{ $row->kategoriumur }}</td>
                                        <td>{{ IDateTime::formatDate($row->tgl_lahir) }}</td>

                                        @if($row->kategoriumur == 'Balita')
                                            <td>{{ Str::title($row->umur_tahun_bulan) }}</td>
                                        @else
                                            <td>{{ $row->umur }} Tahun</td>
                                        @endif

                                        <td x-show="$wire.status == ''" class="{{ $row->status == 1 ? 'text-success' : 'text-danger' }} fw-bold" x-cloak>{{ $row->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
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
                    <a class="btn btn-lg btn-outline-primary" href="{{ url("admin/$pageName/detail/$selectedKode") }}" role="button"><i class="fas fa-user"></i> Detail</a>
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
