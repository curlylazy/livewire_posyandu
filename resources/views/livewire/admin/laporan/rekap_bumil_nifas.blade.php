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
                <a class="btn btn-outline-success" type="button" wire:click='onClickExportExcel' target="_blank"><i class="fas fa-file-export"></i> Export Excel</a>
            </div>

            <form autocomplete="off">
                <div class="row g-2 mb-3">
                    <div class="col-12 col-md-12">
                        <div class="form-floating">
                            <select type="text" class="form-control" id="tahun" wire:model='tahun'>
                                <option value="">Pilih Tahun</option>
                                @foreach (Option::tahun() as $data)
                                    <option value="{{ $data['value'] }}">{{ $data['name'] }}</option>
                                @endforeach
                            </select>
                            <label for="tahun">Tahun</label>
                        </div>
                    </div>
                </div>
            </form>

            {{-- *** Large Device --}}
            <x-partials.viewlarge>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Bulan</th>
                                <th scope="col">Bumil Datang</th>
                                <th scope="col">Nifas Datang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataRow as $row)
                                <tr role="button">
                                    <td>{{ $row->periode }}</td>
                                    <td>{{ $row->jml_bumil_datang }}</td>
                                    <td>{{ $row->jml_nifas_datang }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-partials.viewlarge>

            {{-- *** Mobile --}}
            <x-partials.viewsmall>
                <div class="row g-2">
                    <hr />
                    @foreach ($dataRow as $row)
                        <div class="col-12 col-md-12">
                            <div class="card" role="button">
                                <div class="card-body px-2 py-2">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-partials.viewsmall>
        </div>
    </div>

</div>
