@php
    $pageTitle = "font-weight: bold; font-size: 15pt; width: 100px";
    $pageSubTitle = "font-weight: bold; font-size: 12pt; width: 100px";
    $heading = "font-weight: bold; font-size: 15pt; text-align: center; background-color: #FFB6C1; height: 50px;";
    $rowSize200 = "font-weight: bold; width: 200px;";
    $rowSize250 = "font-weight: bold; width: 250px;";
    $rowSize300 = "font-weight: bold; width: 300px;";
    $rowSize350 = "font-weight: bold; width: 350px;";
    $rowSize400 = "font-weight: bold; width: 400px;";

    $textCenter = "text-align: center;";

    $bgPink = "background-color: #DDC0B4;";
    $bgGray = "background-color: #D9D9D9;";
    $bgLightYellow = "background-color: #FDFD96;";
    $bgYellow = "background-color: #FFFFCC;";
    $bgLightBlue = "background-color: #D0D8E8;";
    $bgPurple = "background-color: #CCBBEB;";

    $rowSize100Light = "width: 100px;";
    $rowSize150Light = "width: 100px;";
    $rowSize200Light = "width: 200px;";
    $rowSize250Light = "width: 250px;";
    $rowSize300Light = "width: 300px;";
    $rowSize350Light = "width: 350px;";
    $rowSize400Light = "width: 400px;";

    $rowHeight25px = "height: 25px;";
    $rowHeight50px = "height: 50px;";
    $rowHeight100px = "height: 100px;";
    $rowHeight150px = "height: 150px;";
    $rowHeight200px = "height: 200px;";

    $pageResult = "font-weight: bold; font-size: 14pt;";
@endphp

<table>
    <thead>
        <tr><th style="{!! $pageTitle !!}" colspan="2">KARTU BANTU PEMERIKSAAN IBU HAMIL/NIFAS/MENYUSUI</th></tr>
        <tr><th style="{!! $pageTitle !!}" colspan="2">{{ $page_title }}</th></tr>
        <tr></tr>
    </thead>
</table>

{{-- *** data pasien --}}
<table>
    <thead>
        <tr>
            <th style="{!! $rowSize250Light !!}">Nama Pasien</th>
            <th>: {{ $dataPasien->namapasien }}</th>
        </tr>
        <tr>
            <th style="{!! $rowSize250Light !!}">NIK</th>
            <th>: {{ $dataPasien->nik }}</th>
        </tr>
        <tr>
            <th style="{!! $rowSize250Light !!}">Tanggal Lahir / Umur</th>
            <th>: {{ IDateTime::formatDate($dataPasien->tgl_lahir) }} / {{ $dataPasien->umur }} Tahun</th>
        </tr>
        <tr>
            <th style="{!! $rowSize250Light !!}">Nama Suami</th>
            <th>: {{ $dataPasien->namasuami }}</th>
        </tr>
        <tr>
            <th style="{!! $rowSize250Light !!}">Alamat</th>
            <th>: {{ $dataPasien->alamat }}</th>
        </tr>
        <tr>
            <th style="{!! $rowSize250Light !!}">No HP</th>
            <th>: {{ $dataPasien->nohp }}</th>
        </tr>

        <tr></tr>
        <tr></tr>
        <tr></tr>

        <tr>
            <th style="{!! $rowSize250 !!}">Ibu Hamil</th>
        </tr>
        <tr>
            <th style="{!! $rowSize250Light !!}">Jarak dengan Anak Sebelumnya</th>
            <th>: ............</th>
        </tr>
        <tr>
            <th style="{!! $rowSize250Light !!}">Berat Badan</th>
            <th>: ............ Kg</th>
        </tr>
        <tr>
            <th style="{!! $rowSize250Light !!}">Hamil Anak ke</th>
            <th>:</th>
        </tr>
        <tr>
            <th style="{!! $rowSize250Light !!}">Tinggi Badan</th>
            <th>:</th>
        </tr>
    </thead>
</table>

{{-- *** header name --}}
<table>
    <thead>
        <tr>
            <th style="{!! $rowSize250Light !!} {!! $textCenter !!} {!! $bgPink !!}" rowspan="4">Waktu Ke Posyandu (Tanggal/Bulan/Tahun)</th>
            <th style="{!! $rowSize250Light !!} {!! $textCenter !!} {!! $bgPink !!}" rowspan="4">Usia Kehamilan</th>

            <th style="{!! $rowHeight50px !!} {!! $rowSize250Light !!} {!! $textCenter !!} {!! $bgGray !!}" colspan="10">Hasil Penimbangan/Pengukuran/Pemeriksaan</th>
            <th style="{!! $rowHeight50px !!} {!! $rowSize250Light !!} {!! $textCenter !!} {!! $bgGray !!}" colspan="4">Pemberian TTD & MT Bumil KEK</th>
        </tr>

        <tr>
            {{-- Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <th style="{!! $rowHeight50px !!} {!! $textCenter !!} {!! $bgGray !!}" colspan="2">Berat Badan</th>
            <th style="{!! $rowHeight50px !!} {!! $textCenter !!} {!! $bgGray !!}" colspan="2">Lingkar Lengan Atas</th>
            <th style="{!! $rowHeight50px !!} {!! $textCenter !!} {!! $bgGray !!}" colspan="2">Tekanan Darah</th>
            <th style="{!! $rowHeight50px !!} {!! $textCenter !!} {!! $bgGray !!}" colspan="4">Skrining TBC</th>

            {{-- Pemberian TTD & MT Bumil KEK --}}
        </tr>

        <tr>
            <th style="{!! $rowHeight50px !!} {!! $textCenter !!} {!! $bgGray !!}" colspan="6">(Jika hasil: tidak/merah maka rujuk ke Pustu / Puskesmas)</th>
            <th style="{!! $rowHeight50px !!} {!! $textCenter !!} {!! $bgGray !!}" colspan="4">(Jika 2 gejala terpenuhi maka rujuk ke Pustu/Puskesmas)</th>
        </tr>

        <tr>
            <th style="{!! $rowHeight200px !!} {!! $rowSize150Light !!} {!! $textCenter !!} {!! $bgYellow !!}">BB (Kg)</th>
            <th style="{!! $rowHeight200px !!} {!! $rowSize150Light !!} {!! $textCenter !!} {!! $bgLightYellow !!}">Sesuai kurva Buku KIA Ya (hijau)/Tidak (merah)</th>
            <th style="{!! $rowHeight200px !!} {!! $rowSize150Light !!} {!! $textCenter !!} {!! $bgYellow !!}">Lila (Cm)</th>
            <th style="{!! $rowHeight200px !!} {!! $rowSize150Light !!} {!! $textCenter !!} {!! $bgLightYellow !!}">23.5cm (hijau) / < 23.5cm (merah)</th>
            <th style="{!! $rowHeight200px !!} {!! $rowSize150Light !!} {!! $textCenter !!} {!! $bgYellow !!}">Sistole / Diastole (mm/Hg)</th>
            <th style="{!! $rowHeight200px !!} {!! $rowSize150Light !!} {!! $textCenter !!} {!! $bgLightYellow !!}">Sesuai kurva Buku KIAYa (hijau)/ Tidak (merah)</th>
            <th style="{!! $rowHeight200px !!} {!! $rowSize150Light !!} {!! $textCenter !!} {!! $bgLightBlue !!}">Batuk terus menerus Ya / Tidak</th>
            <th style="{!! $rowHeight200px !!} {!! $rowSize150Light !!} {!! $textCenter !!} {!! $bgLightBlue !!}">Demam lebih dari ≥2 minggu Ya / Tidak</th>
            <th style="{!! $rowHeight200px !!} {!! $rowSize150Light !!} {!! $textCenter !!} {!! $bgLightBlue !!}">BB tidak naik atau turun  dalam 2 bulan berturut-turut Ya / Tidak</th>
            <th style="{!! $rowHeight200px !!} {!! $rowSize150Light !!} {!! $textCenter !!} {!! $bgLightBlue !!}">Kontak erat dengan Pasien TBC Ya / Tidak</th>
        </tr>

    </thead>
</table>
