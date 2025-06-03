<div>

    <livewire:partial.modal-pasien
        :judulModal="$judulModalPasien"
        :kategoriumur="$kategoriumur"
        :jk="$jk"
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
            <div class="mb-3 d-flex flex-column flex-md-row gap-2">
                <a class="btn btn-outline-secondary" type="button" href="{{ url("admin/") }}"><i class="fas fa-arrow-left"></i></a>
                <button class="btn btn-outline-primary" type="button" wire:click='onClickOpenModalPasien'><i class="fas fa-search"></i> Pilih Pasien</button>
                <button x-cloak x-show="$wire.nik != ''" class="btn btn-outline-success" type="button" wire:click='onClickExportToExcel'><i class="fas fa-file-export"></i> Export Excel</button>
            </div>

            @if(!empty($nik))
                <div>
                    <h6>Nama Pasien : {{ $namapasien }}</h6>
                    <h6>NIK : {{ $nik }}</h6>
                </div>
                <div x-cloak x-show="$wire.kategori_periksa == 'bumil'">
                    <div class="d-flex h6 align-items-center gap-2">
                        <div>Hamil Ke ?:</div>
                        <div>
                            @for ($i=1;$i<=$hamil_ke;$i++)
                                <button type="button" wire:click='onClikSetHamilKe("{{ $i }}")' @class(['btn btn-sm', 'btn-outline-secondary' => true, 'btn-primary text-white' => $q_hamil_ke == $i]) >{{ $i }}</button>
                            @endfor
                        </div>
                    </div>
                </div>
            @endif

            <x-partials.containerdata :dataRows="$dataRow">
                <hr />
                <div class="row g-3">
                    @foreach ($dataRow as $row)
                        <div class="col-12">
                            <div class="d-flex justify-content-between mb-2">
                                <h6>Periode : {{ IDateTime::formatDate($row->tgl_periksa) }}</h6>
                                <a href="{{ url("admin/pemeriksaan/detail/$row->kodepemeriksaan?kategori_periksa=$kategori_periksa") }}" class="btn btn-sm btn-outline-secondary"> Cek Detail</a>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item d-flex flex-md-row flex-column" x-cloak x-show="$wire.kategori_periksa == 'bumil'">
                                    <div class="flex-grow-1">Hamil Ke ?:</div>
                                    <div class="fw-bold">{{ $row->hamil_ke }}</div>
                                </li>
                                <li class="list-group-item d-flex flex-md-row flex-column">
                                    <div class="flex-grow-1">Berat Badan / Sesuai Kurva ?:</div>
                                    <div class="fw-bold">{{ ($kategori_periksa == "nifas") ? $row->periksa_bb_bayi : $row->periksa_bb }} Kg / {{ Option::getYaAtauTidak($row->is_sesuai_kurva_bb) }}</div>
                                </li>
                                <li class="list-group-item d-flex flex-md-row flex-column">
                                    <div class="flex-grow-1">Lingkar Lengan Atas (LILA) :</div>
                                    <div class="fw-bold">{{ $row->periksa_lila }}</div>
                                </li>
                                <li class="list-group-item d-flex flex-md-row flex-column">
                                    <div class="flex-grow-1">Tekanan Darah / Sesuai Kurva ?:</div>
                                    <div class="fw-bold">{{ $row->periksa_tekanan_darah }} Kg / {{ Option::getYaAtauTidak($row->is_sesuai_kurva_tekanan_darah) }}</div>
                                </li>

                                @if($kategori_periksa == "bumil")
                                    <li class="list-group-item d-flex  flex-md-row flex-column">
                                        <div class="flex-grow-1">Hamil Ke / Minggu Ke :</div>
                                        <div class="fw-bold">{{ $row->hamil_ke }} / {{ $row->minggu_ke }}</div>
                                    </li>
                                @endif

                                @if($kategori_periksa == "nifas")
                                    <li class="list-group-item d-flex flex-md-row flex-column">
                                        <div class="flex-grow-1">Nama Bayi :</div>
                                        <div class="fw-bold">{{ $row->namabayi }}</div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endforeach
                </div>
            </x-partials.containerdata>

            {{-- *** Modal Selected --}}
            <x-partials.modalselected>
                <x-slot:pageTitle>{{ $pageTitle }}</x-slot>
                <x-slot:selectedNama>{{ $selectedNama }}</x-slot>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-outline-primary" href="{{ url("admin/$pageName/edit/$selectedKode?kategori_periksa=$kategori_periksa") }}" role="button" wire:navigated><i class="fas fa-edit"></i> Edit</a>
                    <a class="btn btn-lg btn-outline-primary" href="{{ url("admin/$pageName/detail/$selectedKode?kategori_periksa=$kategori_periksa") }}" role="button" wire:navigated><i class="fas fa-stethoscope"></i> Detail</a>
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
