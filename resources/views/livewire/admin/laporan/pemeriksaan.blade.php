<div>

    @assets
        <script src="https://cdn.jsdelivr.net/npm/sharer.js@0.5.2/sharer.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endassets

    @script
        <script>

            document.addEventListener('livewire:navigated', (event) => {
                flatpickr(".date", { dateFormat: "Y-m-d", disableMobile: "true" });
            });

            $wire.on('selected-modal-open', (e) => {
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
                    }
                });
            });
        </script>
    @endscript

    <livewire:partial.modal-year-month />

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item active"><span>{{ $pageTitle }}</span></li>
    </x-slot>


    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>

            <div class="mb-2">
                <a class="btn btn-outline-secondary" type="button" href="{{ url('/admin') }}" wire:navigate><i class="fas fa-arrow-left"></i></a>
                <a class="btn btn-outline-secondary" type="button" wire:click='readData'><i class="fas fa-search"></i> Cari</a>
                <a class="btn btn-outline-primary" type="button" wire:click='onClickCetak' target="_blank"><i class="fas fa-print"></i> Cetak</a>
                <a class="btn btn-outline-success" type="button" wire:click='onClickExportExcel' target="_blank"><i class="fas fa-file-export"></i> Export Excel</a>
            </div>

            <form autocomplete="off">
                <div class="row g-2 mb-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="katakunci" wire:model='katakunci' placeholder="" wire:keydown.enter='$commit'>
                            <label for="katakunci">Katakunci</label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="text" class="form-control pe-none" id="yearmonth_keterangan" value="{{ IDateTime::formatDate("$tahun-$bulan-01", "MMMM Y") }}" placeholder="">
                                <label for="tgl_keterangan">Periode Pemeriksaan</label>
                            </div>
                            @if(!empty($tgl_dari))
                                <button class="btn btn-outline-secondary" type="button" x-on:click="$wire.bulan = ''; $wire.tahun = ''; $wire.readData();"><i class="fas fa-close"></i></button>
                            @endif
                            <button class="btn btn-outline-secondary" type="button" wire:click='setYearMonth'><i class="fas fa-calendar"></i></button>
                        </div>
                    </div>
                </div>
            </form>

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
                    <hr />
                    @if($kategori_periksa == 'nifas')
                        @foreach ($dataRow as $row)
                            <div class="col-12 col-md-12">
                                <div class="card" role="button" wire:click='selectData({{ $row }})'>
                                    <div class="card-body px-2 py-2">
                                        <div class="h5 mb-1">{{ $row->namabayi }}</div>
                                        <div>Ibu {{ $row->namapasien }}</div>
                                        <div>{{ $row->namabayi }}</div>
                                        <div>BB : {{ Number::format($row->beratbadan) }} kg</div>
                                        <div>Tinggi : {{ Number::format($row->tinggibadan) }} cm</div>
                                        <div>{{ IDateTime::formatDate($row->tgl_lahir_bayi) }}</div>
                                        <div>{{ IDateTime::dateDiffFormat($row->tgl_lahir_bayi) }}</div>
                                        <div>{{ IDateTime::formatDate($row->tgl_periksa) }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($dataRow as $row)
                            <div class="col-12 col-md-12">
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

            <div class="row justify-content-end">
                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-between">
                            <div class="fs-4 mt-0">Total Kunjungan:</div>
                            <div class="fs-4">{{ Number::format($totalKunjungan) }} Orang</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- *** Modal Selected --}}
            <x-partials.modalselected>
                <x-slot:pageTitle>{{ $pageTitle }}</x-slot>
                <x-slot:selectedNama>{{ $selectedNama }}</x-slot>
                <div class="d-grid gap-2">
                    <a role="button" class="btn btn-lg btn-outline-primary" href="{{ url("admin/$pageName/edit/$selectedKode") }}"><i class="fas fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-lg btn-outline-primary" data-coreui-dismiss="modal" wire:click='$dispatch("on-modalshare-readdata", { kode: "{{ $selectedKode }}" })'><i class="fas fa-share"></i> Share</button>
                    <button type="button" class="btn btn-lg btn-outline-primary" data-coreui-dismiss="modal" wire:click='cetak("{{ $selectedNoInvoice }}")'><i class="fas fa-print"></i> Cetak</button>
                    <button type="button" class="btn btn-lg btn-outline-danger" data-coreui-dismiss="modal" wire:click='$dispatch("confirm-delete", { kode: "{{ $selectedKode }}", nama: "{{ $selectedNama }}" })'><i class="fas fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-lg btn-outline-secondary" data-coreui-dismiss="modal"><i class="fas fa-close"></i> Batal</button>
                </div>
            </x-partials.modalselected>

        </div>
    </div>

</div>
