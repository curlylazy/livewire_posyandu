@php
    $pageTitle = "font-weight: bold; font-size: 15pt; width: 100px";
    $pageSubTitle = "font-weight: bold; font-size: 12pt; width: 100px";
    $heading = "font-weight: bold; font-size: 15pt; text-align: center; background-color: #FFB6C1; height: 50px;";
    $rowSize200 = "font-weight: bold; width: 200px;";
    $rowSize250 = "font-weight: bold; width: 250px;";
    $rowSize300 = "font-weight: bold; width: 300px;";
    $rowSize350 = "font-weight: bold; width: 350px;";
    $rowSize400 = "font-weight: bold; width: 400px;";

    $rowSize200Light = "font-weight: bold; width: 200px;";
    $rowSize250Light = "font-weight: bold; width: 250px;";
    $rowSize300Light = "font-weight: bold; width: 300px;";
    $rowSize350Light = "font-weight: bold; width: 350px;";
    $rowSize400Light = "font-weight: bold; width: 400px;";

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
    </thead>
</table>
