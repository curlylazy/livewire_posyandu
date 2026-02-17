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
                    }
                });
            });
        </script>
    @endscript

    <x-partials.loader />

    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item active"><span>Test Data</span></li>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>

            <div class="input-group mb-3">
                <a class="btn btn-outline-secondary" type="button"><i class="fas fa-arrow-left"></i></a>
                <input
                    type="text" class="form-control" placeholder="masukkan kata kunci pencarian..."
                    wire:model='katakunci'
                    wire:keydown.enter='cariData' />
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataProduk as $row)
                        <tr>
                            <td>{{ $row->namaproduk }}</td>
                            <td>{{ Number::format($row->hargapokok) }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" wire:click='detail("{{ $row->kodeproduk }}")'><i class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-outline-danger" wire:click='$dispatch("confirm-delete", { kode : "{{ $row->kodeproduk }}", nama : "{{ $row->namaproduk }}" })'><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            <hr />
            @if(!empty($detailProduk))
                <h6>Detail Produk</h6>
                <p>
                    Nama Produk : {{ $detailProduk->namaproduk }}<br />
                    Harga Produk : {{ $detailProduk->hargapokok }}<br />
                    Kategori : {{ $detailProduk->namakategori }}<br />
                </p>
            @endif
        </div>
    </div>

</div>
