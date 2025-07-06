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

    <livewire:partial.modal-year-month-picker
        wire:model="bulan"
        wire:model="tahun"
        @selectdateyear="getSetPeriode($event.detail.data)"
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
            <div class="row g-3 mb-3">
                <div class="col-12">
                    <a class="btn btn-outline-secondary" type="button" href="{{ url("admin/") }}"><i class="fas fa-arrow-left"></i></a>
                    <a class="btn btn-outline-primary" role="button" href="{{ url("admin/$pageName/$subPage/add?kategori_periksa=$kategori_periksa") }}" wire:navigate><i class="fas fa-plus"></i> Tambah</a>
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
                            @if($kategori_periksa == 'nifas')
                                <thead>
                                    <tr>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Nama Ibu</th>
                                        <th scope="col">Nama Bayi</th>
                                        <th scope="col">Tanggal Lahir</th>
                                        <th scope="col">Umur Bayi</th>
                                        <th scope="col">Tanggal Periksa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataRow as $row)
                                        <tr role="button" wire:click='selectData({{ $row }})'>
                                            <td>{{ $row->nik }}</td>
                                            <td>{{ $row->namapasien }}</td>
                                            <td>{{ $row->namabayi }}</td>
                                            <td>{{ IDateTime::formatDate($row->tgl_lahir_bayi) }}</td>
                                            <td>{{ IDateTime::dateDiffFormat($row->tgl_lahir_bayi) }}</td>
                                            <td>{{ IDateTime::formatDate($row->tgl_periksa) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <thead>
                                    <tr>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Nama Ibu</th>
                                        <th scope="col">Hamil Ke</th>
                                        <th scope="col">BB</th>
                                        <th scope="col">LILA</th>
                                        <th scope="col">Tanggal Lahir</th>
                                        <th scope="col">Umur</th>
                                        <th scope="col">Tanggal Periksa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataRow as $row)
                                        <tr role="button" wire:click='selectData({{ $row }})'>
                                            <td>{{ $row->nik }}</td>
                                            <td>{{ $row->namapasien }}</td>
                                            <td>{{ $row->hamil_ke }}</td>
                                            <td>{{ Number::format($row->periksa_bb) }} kg</td>
                                            <td>{{ Number::format($row->periksa_lila) }} cm</td>
                                            <td>{{ IDateTime::formatDate($row->tgl_lahir_pasien) }}</td>
                                            <td>{{ IDateTime::dateDiff($row->tgl_lahir_pasien) }} Tahun</td>
                                            <td>{{ IDateTime::formatDate($row->tgl_periksa) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </x-partials.viewlarge>

                {{-- *** Mobile --}}
                <x-partials.viewsmall>
                    <div class="row g-2">

                        @if($kategori_periksa == 'nifas')
                            @foreach ($dataRow as $row)
                                <div class="col-12 col-md-4">
                                    <div class="card" role="button" wire:click='selectData({{ $row }})'>
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
                        @else
                            @foreach ($dataRow as $row)
                                <div class="col-12 col-md-4">
                                    <div class="card" role="button" wire:click='selectData({{ $row }})'>
                                        <div class="card-body px-2 py-2">
                                            <div class="h5 mb-1">{{ $row->namapasien }}</div>
                                            <div>{{ $row->nik }}</div>
                                            <div>BB : {{ Number::format($row->periksa_bb) }} kg</div>
                                            <div>LILA : {{ Number::format($row->periksa_lila) }} cm</div>
                                            <div>Tgl Lahir :{{ IDateTime::formatDate($row->tgl_lahir_pasien) }}</div>
                                            <div>Umur : {{ IDateTime::dateDiff($row->tgl_lahir_pasien) }} Tahun</div>
                                            <div>Periksa : {{ IDateTime::formatDate($row->tgl_periksa) }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </x-partials.viewsmall>
            </x-partials.containerdata>

            {{-- *** Modal Selected --}}
            <x-partials.modalselected>
                <x-slot:pageTitle>{{ $pageTitle }}</x-slot>
                <x-slot:selectedNama>{{ $selectedNama }}</x-slot>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-outline-primary" href="{{ url("admin/$pageName/$subPage/edit/$selectedKode?kategori_periksa=$kategori_periksa") }}" role="button" wire:navigated><i class="fas fa-edit"></i> Edit</a>
                    <a class="btn btn-lg btn-outline-primary" href="{{ url("admin/$pageName/$subPage/detail/$selectedKode?kategori_periksa=$kategori_periksa") }}" role="button" wire:navigated><i class="fas fa-stethoscope"></i> Detail</a>
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
