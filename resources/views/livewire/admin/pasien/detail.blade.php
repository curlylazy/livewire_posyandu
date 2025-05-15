<div>
    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item"><a href="{{ url('/admin/pasien') }}" class="text-decoration-none"><span>Pasien</span></a></li>
        <li class="breadcrumb-item active"><span>{{ $pageTitle }}</span></li>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>
            <div class="mb-3">
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex gap-1">
                        <a class="btn btn-outline-secondary" type="button" href="{{ url("admin/") }}"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>

            {{-- <div class="row g-3">
                <div class="col-md-12">
                    <label>NIK</label>
                    <h5>{{ FilterString::filterString($dataPasien->nik) }}</h5>
                </div>
                <div class="col-md-12">
                    <label>Nama Pasien</label>
                    <h5>{{ FilterString::filterString($dataPasien->namapasien) }}</h5>
                </div>
                <div class="col-md-12">
                    <label>Alamat</label>
                    <h5>{{ FilterString::filterString($dataPasien->alamat) }}</h5>
                </div>
            </div> --}}

            <div class="row g-3">
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">NIK</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->nik) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Nama Pasien</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->namapasien) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Tanggal Lahir</div>
                        <div class="h5">{{ IDateTime::formatDate($dataPasien->tgl_lahir) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Alamat</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->alamat) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">No Telepon</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->nohp) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Berat Badan</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->beratbadan) }}</div>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="h4">Data Balita</div>
                </div>

                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Berat Badan Lahir</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->beratbadan_lahir) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Tinggi Badan Lahir</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->tinggibadan_lahir) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Ayah</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->namaayah) }}</div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex border-bottom">
                        <div class="h6 fw-normal flex-grow-1">Ibu</div>
                        <div class="h5">{{ FilterString::filterString($dataPasien->namaibu) }}</div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
