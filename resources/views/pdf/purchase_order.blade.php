@use('Illuminate\Support\Facades\Vite')

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cetak Bukti PO | #INV-{{ Str::replace('INVOICE', '', $dataPesanHd->noinvoice) }}</title>
        <link href="{{ resource_path('assets/pdf/template.css') }}" rel="stylesheet" type="text/css">

        <style>
            @font-face {
                font-family: 'sans_serif';
                font-style: normal;
                font-weight: 400;
                src: url('{{ storage_path('fonts/sans_serif.ttf') }}') format('truetype');
            }

            @font-face {
                font-family: 'roboto';
                font-style: normal;
                font-weight: 400;
                src: url('{{ storage_path('fonts/roboto.ttf') }}') format('truetype');
            }

            body {
                font-family: 'roboto';
            }
        </style>
    </head>
    <body>

        @include('pdf.watermark')

        <div style="width: 90%;">
            <header class="clearfix">
                <div id="logo">
                    <img src="{{ public_path('logo.png') }}">
                </div>
                <div id="company">
                    <h2 class="name"><strong>{{ config('app.webname') }}</strong></h2>
                    <div>{{ config('app.alamat') }}, {{ config('app.kodepos') }}</div>
                    <div>{{ config('app.alamat2') }}</div>
                    <div><a href="tel:{{ config('app.notelepon') }}">{{ config('app.notelepon') }}</a> | <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></div>
                </div>
            </header>

            <main>
                <div id="details" class="clearfix">
                    <div id="client">
                        <div class="to">INVOICE KEPADA:</div>
                        <h2 class="name">{{ $dataPesanHd->namapelanggan }}</h2>
                        <div class="address">{{ $dataPesanHd->alamat }}</div>
                        <div class="email"><a href="mailto:john@example.com">{{ $dataPesanHd->email }}</a></div>
                    </div>
                    <div id="invoice">
                        <h1>#INV-{{ Str::replace('INVOICE', '', $dataPesanHd->noinvoice) }}</h1>
                        <div class="date">Tanggal Invoice: {{ IDateTime::formatDate($dataPesanHd->created_at) }}</div>
                        <div class="date">Dikirim: {{ IDateTime::formatDate($dataPesanHd->tgl_pengiriman) }}</div>
                        <div class="date">Status Pesan: {{ GetString::getStatusPesanan($dataPesanHd->statuspesan) }}</div>
                        <div class="date">Status Bayar: {{ GetString::getStatusBayar($dataPesanHd->statusbayar) }}</div>
                    </div>
                </div>

                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            {{-- <th class="no">#</th> --}}
                            <th class="desc">DESCRIPTION</th>
                            <th class="unit">UNIT PRICE</th>
                            <th class="qty">QTY</th>
                            <th class="total" style="text-align: right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPesanDt as $data)
                            <tr>

                                {{-- *** jika opsi iscetakimage true, maka tampilkan image --}}
                                @if($dataPesanHd->iscetakimage)
                                    <td class="desc">
                                        <img src="{{ ImageUtils::getImagePdf($data->gambarproduk) }}" style="float: left; width: 80px; height: 80px; object-fit: cover; border-radius: 10px;" />
                                        <div style="float: left; margin-left: 10px; width: 200px;">
                                            <h3>{{ $data->namaproduk }}</h3>
                                            Warna : {{ $data->warna }}<br />
                                            Size : {{ $data->ukuran }}<br />
                                            Kain : {{ $data->namajeniskain }}<br />
                                        </div>
                                        <div style="clear: both;"></div>
                                    </td>
                                @else
                                    <td class="desc">
                                        <h3>{{ $data->namaproduk }}</h3>
                                        Warna : {{ $data->warna }}<br />
                                        Size : {{ $data->ukuran }}<br />
                                        Kain : {{ $data->namajeniskain }}<br />
                                    </td>
                                @endif

                                <td class="unit">Rp{{ Number::format($data->hargajual) }}</td>
                                <td class="qty">{{ $data->qty }}</td>
                                <td class="total">Rp{{ Number::format($data->hargajual * $data->qty) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="2">Total</td>
                            <td>Rp{{ Number::format($dataPesanHd->totalbayar) }}</td>
                        </tr>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="2">DP (-)</td>
                            <td>Rp{{ Number::format($dataPesanHd->dp) }}</td>
                        </tr>
                        <tr>
                            <td colspan="1"></td>
                            <td colspan="2">Grand Total</td>
                            <td>Rp{{ Number::format($dataPesanHd->totalbayar - $dataPesanHd->dp) }}</td>
                        </tr>
                        {{-- <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TAX 25%</td>
                            <td>$1,300.00</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>$6,500.00</td>
                        </tr> --}}
                    </tfoot>
                </table>

                <div>
                    <p>
                        <strong style="font-size: 15pt">Terima Kasih</strong><br/>
                        Kami berterima kasih atas pembelian Anda. Semoga Anda puas dengan produk kami, dan kami menantikan kunjungan Anda berikutnya
                    </p>
                </div>
                {{-- <div id="notices">
                    <strong style="font-size: 15pt">Terima Kasih</strong><br/>
                    <div class="notice">Kami berterima kasih atas pembelian Anda. Semoga Anda puas dengan produk kami, dan kami menantikan kunjungan Anda berikutnya</div>
                </div> --}}
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>

    </body>
</html>
