@php
    $pageTitle = "font-weight: bold; font-size: 15pt; width: 100px";
    $pageSubTitle = "font-weight: bold; font-size: 12pt; width: 100px";
    $heading = "font-weight: bold; font-size: 15pt; text-align: center; background-color: #FFB6C1; height: 50px;";
    $rowSize200 = "font-weight: bold; width: 200px;";
    $rowSize250 = "font-weight: bold; width: 250px;";
    $rowSize300 = "font-weight: bold; width: 300px;";
    $rowSize350 = "font-weight: bold; width: 350px;";
    $rowSize400 = "font-weight: bold; width: 400px;";

    $pageResult = "font-weight: bold; font-size: 14pt;";
@endphp

<table>

    <thead>
        <tr><th style="{!! $pageTitle !!}" colspan="2">{{ $page_title }}</th></tr>
        <tr><th style="{!! $pageSubTitle !!}" colspan="2">Tahun : {{ $tahun }}</th></tr>
        <tr><th style="{!! $pageSubTitle !!}" colspan="2">Bulan : {{ $bulan }}</th></tr>
        <tr></tr>
    </thead>

    @if($kategori_periksa == "nifas")
        @include('exports.sheet_pemeriksaan_nifas', ["dataRows" => $dataRows])
    @else
        @include('exports.sheet_pemeriksaan_bumil', ["dataRows" => $dataRows])
    @endif
</table>

<table>
    <thead>
        <tr>
            <th colspan="2" style="{!! $pageResult !!}">Total Kunjungan :</th>
            <th colspan="2" style="{!! $pageResult !!}">{{ count($dataRows) }} Ibu</th>
        </tr>
    </thead>
</table>
