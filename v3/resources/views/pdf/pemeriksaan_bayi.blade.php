<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @include('pdf.helper.csstemplate')
        <link href="{{ public_path('asset_pdf/table.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body>

        @include('pdf.helper.watermark')
    	@include('pdf.helper.header', [
            'judul' => $pageTitle,
        ])

        <div>
            <div style="font-size: 15pt;">Periode Kunjungan : {{ IDateTime::formatDate("$tahun-$bulan-01", "MMMM Y") }}</div>
        </div>

        <table class="minimalistBlack" style="padding-top: 10px;">

            <thead>
                <tr>
                    <th style="width: 20px;">No</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Nama Ibu</th>
                    <th scope="col">Nama Ayah</th>
                    <th scope="col">BB</th>
                    <th scope="col">Tinggi</th>
                    <th scope="col">Tgl Lahir</th>
                    <th scope="col">Umur</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dataRows as $data)
                    <tr>
                        <td>{{ $loop->index }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->namapasien }}</td>
                        <td>{{ $data->namaibu }}</td>
                        <td>{{ $data->namaayah }}</td>
                        <td>{{ $data->periksa_bb }} kg</td>
                        <td>{{ $data->periksa_tinggi_badan }} cm</td>
                        <td>{{ IDateTime::formatDate($data->tgl_lahir_pasien) }}</td>
                        <td>{{ IDateTime::dateDiffFormat($data->tgl_lahir_pasien) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h5>Total Kunjungan : <b>{{ $dataRows->count() }}</b></h5>
    </body>
</html>


