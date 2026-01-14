<div>

    @script
        <script>
            $wire.on('selected-data', (e) => {
                $wire.selectedNama = e.data.namapasien;
                $wire.selectedKode = e.data.kodepemeriksaan;
                $wire.dispatch('open-modal', { namamodal: "modalPilihData" });
            });

            $wire.on('edit', (e) => {
                Livewire.navigate(`{{ url("admin/$pageName/bayi/edit") }}/${$wire.selectedKode}`);
            });

            $wire.on('detail', (e) => {
                Livewire.navigate(`{{ url("admin/$pageName/bayi/detail") }}/${$wire.selectedKode}`);
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
    @endscript

    <livewire:partial.modal-year-month-picker
        wire:model="bulan"
        wire:model="tahun"
        @selectdateyear="getSetPeriode($event.detail.data)"
    />

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item active"><span>{{ $pageTitle }} Test</span></li>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <a class="btn btn-outline-secondary" type="button" href="{{ url("admin/") }}"><i class="fas fa-arrow-left"></i></a>
                    <a class="btn btn-outline-primary" role="button" href="{{ url("admin/$pageName/$subPage/add") }}" wire:navigate><i class="fas fa-plus"></i> Tambah</a>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="katakunci" wire:model='katakunci' placeholder="" wire:keydown.enter='$commit'>
                        <label for="katakunci">Katakunci</label>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" class="form-control pe-none" id="yearmonth_keterangan" value="{{ IDateTime::formatDate("$tahun-$bulan-01", "MMMM Y") }}" placeholder="">
                            <label for="tgl_keterangan">Periode Pemeriksaan</label>
                        </div>
                        @if(!empty($tgl_dari))
                            <button class="btn btn-outline-secondary" type="button" x-on:click="$wire.bulan = ''; $wire.tahun = ''; $wire.readData();"><i class="fas fa-close"></i></button>
                        @endif
                        <button class="btn btn-outline-secondary" type="button" wire:click='getSetPeriode'><i class="fas fa-calendar"></i></button>
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
                                    <th scope="col">Nama Bayi</th>
                                    <th scope="col">Nama Ibu</th>
                                    <th scope="col">Tanggal Lahir</th>
                                    <th scope="col">Umur Bayi</th>
                                    <th scope="col">Tanggal Periksa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataRow as $row)
                                    <tr role="button" wire:click='$dispatch("selected-data", { data : {{ $row }} })'>
                                        <td>{{ $row->nik }}</td>
                                        <td>{{ $row->namapasien }}</td>
                                        <td>{{ $row->namaibu }}</td>
                                        <td>{{ IDateTime::formatDate($row->tgl_lahir) }}</td>
                                        <td>{{ IDateTime::dateDiffFormat($row->tgl_lahir) }}</td>
                                        <td>{{ IDateTime::formatDate($row->tgl_periksa) }}</td>
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
                                <div class="card" role="button" wire:click='$dispatch("selected-data", { data : {{ $row }} })'>
                                    <div class="card-body px-2 py-2">
                                        <div class="h5 mb-1">{{ $row->namabayi }}</div>
                                        <div>Ibu {{ $row->namapasien }}</div>
                                        <div>{{ $row->namabayi }}</div>
                                        <div>{{ IDateTime::formatDate($row->tgl_lahir_bayi) }}</div>
                                        <div>{{ IDateTime::dateDiffFormat($row->tgl_lahir_bayi) }}</div>
                                        <div>{{ IDateTime::formatDate($row->tgl_periksa) }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </x-partials.viewsmall>
            </x-partials.containerdata>

            {{-- *** Modal Selected --}}
            <x-partials.modalselected>
                <x-slot:pageTitle><span wire:text="pageTitle"></span></x-slot>
                <x-slot:selectedNama><span wire:text="selectedNama"></span></x-slot>
                <div class="d-grid gap-2" x-data="{ selectedKode: $wire.entangle('selectedKode'), pageName: $wire.entangle('pageName')}">
                    <button type="button" class="btn btn-lg btn-outline-primary" data-coreui-dismiss="modal" wire:click='$dispatch("edit")'><i class="fa-solid fa-edit"></i> Edit</button>
                    <button type="button" class="btn btn-lg btn-outline-primary" data-coreui-dismiss="modal" wire:click='$dispatch("detail")'><i class="fa-solid fa-stethoscope"></i> Detail</button>
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
