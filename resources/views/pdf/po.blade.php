<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Cetak Invoice | {{ $dataPesanHd->noinvoice }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: "Karla", system-ui;
                font-optical-sizing: auto;
                font-style: normal;
            }

            #watermark {
                position: fixed;

                /**
                    Set a position in the page for your image
                    This should center it vertically
                **/
                bottom:   12cm;
                left:     4cm;

                /** Change image dimensions**/
                width:    8cm;
                height:   8cm;

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }
        </style>

    </head>
    <body>
        <div id="watermark">
            <img src="{{ public_path('logo.png') }}" style="opacity: 0.1;" height="500" width="500" />
        </div>

        <section class="py-3 py-md-5">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="d-flex mb-4">
                        <div class="flex-grow-1">
                            <img src="{{ public_path('logo.png') }}" class="img-fluid" alt="BootstrapBrain Logo" width="80">
                        </div>
                        <div class="d-flex flex-column text-end">
                            <h3 class="text-right mb-0">{{ config('app.webname') }}</h3>
                            <div class="mt-0" style="font-size: 11pt;">{{ config('app.alamat') }}</div>
                            <div class="mt-0" style="font-size: 11pt;">WA :{{ config('app.wa') }} - Email : {{ config('app.email') }}</div>
                        </div>
                    </div>

                    <hr />

                    <div class="col-12">
                        <div class="row mb-3">
                            <div class="col-8">
                                <h4>Tagihan Kepada</h4>
                                <address>
                                    <strong>{{ $dataPesanHd->namapelanggan }}</strong><br>
                                    {{ $dataPesanHd->alamat }}<br>
                                    Email : {{ $dataPesanHd->email }}<br>
                                    No Hp : {{ $dataPesanHd->nohp }}<br>
                                </address>
                            </div>
                            <div class="col-4 text-end">
                                <h4>Invoice #{{ Str::replace('INVOICE', '', $dataPesanHd->noinvoice) }}</h4>
                                <div class="d-flex flex-column">
                                    Tanggal : {{ Carbon\Carbon::parse($dataPesanHd->created_at)->format('d F Y') }} <br />
                                    Dikirim : {{ Carbon\Carbon::parse($dataPesanHd->tgl_pengiriman)->format('d F Y') }} <br />
                                    {!! ($dataPesanHd->statuslunas) ? '<div class="fw-bold text-success">Lunas</div>' : '<div class="fw-bold text-danger">Belum Lunas</div>' !!} <br />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-uppercase">Produk</th>
                                            <th scope="col" class="text-uppercase">Jenis Kain</th>
                                            <th scope="col" class="text-uppercase">Warna</th>
                                            <th scope="col" class="text-uppercase">Ukuran</th>
                                            <th scope="col" class="text-uppercase">Qty</th>
                                            <th scope="col" class="text-uppercase text-end">Harga</th>
                                            <th scope="col" class="text-uppercase text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach ($dataPesanDt as $data)
                                            <tr>
                                                {{-- <td>
                                                    <b>{{ $data->namaproduk }}</b><br/>
                                                    Warna : {{ $data->warna }}<br />
                                                    Ukuran : {{ $data->ukuran }}<br />
                                                </td> --}}
                                                <td>{{ $data->namaproduk }}</td>
                                                <td>{{ $data->namajeniskain }}</td>
                                                <td>{{ $data->warna }}</td>
                                                <td>{{ $data->ukuran }}</td>
                                                <th scope="row">{{ $data->qty }}</th>
                                                <td class="text-end">Rp{{ number_format($data->hargapokok) }}</td>
                                                <td class="text-end">Rp{{ number_format($data->hargapokok * $data->qty) }}</td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <th scope="row" colspan="6" class="text-uppercase text-end">Total</th>
                                            <td class="text-end">Rp{{ number_format($dataPesanHd->totalbayar) }}</td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column mt-4">
                            <div style="width: 600px;">
                                <b>INFO Pembayaran</b><br/>
                                Pembayaran Bisa Melakukan Transfer ke Rekening<br/>
                                BCA - 738374849594 - A.N : Made Odin Laksmana<br />
                                Mohon Melakukan Konfirmasi ke WA : {{ config('app.wa') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
