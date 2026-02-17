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

            @if($kategori_periksa == "nifas")
                <thead>
                    <tr>
                        <th style="width: 20px;">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Ibu</th>
                        <th scope="col">Nama Anak</th>
                        <th scope="col">BB</th>
                        <th scope="col">Tinggi</th>
                        <th scope="col">Tgl Lahir</th>
                        <th scope="col">Umur</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $no = 1;
                    @endphp

                    @foreach($dataRows as $data)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data->nik }}</td>
                            <td>{{ $data->namapasien }}</td>
                            <td>{{ $data->namabayi }}</td>
                            <td>{{ $data->periksa_bb_bayi }} kg</td>
                            <td>{{ $data->periksa_tinggi_badan }} cm</td>
                            <td>{{ IDateTime::formatDate($data->tgl_lahir_bayi) }}</td>
                            <td>{{ IDateTime::dateDiffFormat($data->tgl_lahir_bayi) }}</td>
                        </tr>

                        @php
                            $no++;
                        @endphp
                    @endforeach
                </tbody>
            @else
                <thead>
                    <tr>
                        <th style="width: 20px;">No</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Suami</th>
                        <th scope="col">BB</th>
                        <th scope="col">LILA</th>
                        <th scope="col">Hamil Ke</th>
                        <th scope="col">Minggu Ke</th>
                        <th scope="col">Tgl Lahir</th>
                        <th scope="col">Umur</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $no = 1;
                    @endphp

                    @foreach($dataRows as $data)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $data->nik }}</td>
                            <td>{{ $data->namapasien }}</td>
                            <td>{{ $data->nama_suami }}</td>
                            <td>{{ $data->periksa_bb }} kg</td>
                            <td>{{ $data->periksa_lila }} cm</td>
                            <td>{{ $data->periksa_hamil_ke }}</td>
                            <td>{{ $data->periksa_minggu_ke }}</td>
                            <td>{{ IDateTime::formatDate($data->tgl_lahir_pasien) }}</td>
                            <td>{{ IDateTime::dateDiff($data->tgl_lahir_pasien) }} Tahun</td>
                        </tr>

                        @php
                            $no++;
                        @endphp
                    @endforeach
                </tbody>
            @endif


        </table>

    </body>
</html>


