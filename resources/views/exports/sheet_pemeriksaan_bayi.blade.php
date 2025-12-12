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

    <thead>
    <tr>
        <th style="{!! $heading !!}" colspan="9">DATA</th>
        <th style="{!! $heading !!}" colspan="5">Hasil Penimbangan/Pengukuran/Pemeriksaan</th>
        <th style="{!! $heading !!}" colspan="4">Skrining TBC</th>
        <th style="{!! $heading !!}" colspan="6">Pemberian TTD dan MT Bumil KEK</th>
        <th style="{!! $heading !!}" colspan="3">Kelas Ibu Hamil</th>
    </tr>
</thead>
<thead>
    <tr>
        {{-- DATA --}}
        <th style="font-weight: bold; height: 100px;">No</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">NIK</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Nama Ibu</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Tanggal Lahir</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Umur</th>
        <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$bgGray !!}">Alamat</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">No Hp</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Hamil Ke</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Minggu Ke</th>

        {{-- *** Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Berat Badan (Kg)</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Sesuai Kurva Buku KIA</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">LILA (cm)</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Tekanan Darah</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Sesuai Kurva Buku KIA</th>

        {{-- *** Skrining TBC --}}
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Batuk Terus Menerus</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Demam Lebih ≥2 minggu</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Berat Badan Tidak Naik/Turun Dalam 2 Bulan</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Kontak Erat Dengan Pasien TBC</th>

        {{-- Pemberian TTD & MT Bumil KEK --}}
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Diberikan Tablet Oleh Nakes ?</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Jumlah Tablet</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Konsumsi Tablet Tambah Darah</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Diberikan MT Bumil Kek Oleh Nakes ?</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">MT Untuk Bumil KEK</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Konsumsi MT Bumil KEK</th>

        {{-- Kelas Ibu Hamil --}}
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Mengikut Kelas Ibu Hamil</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Edukasi yang Diberikan</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Rujuk Pustu/Puskesmas/Rumah Sakit</th>
    </tr>
</thead>
<tbody>
    @php
        $no = 1;
    @endphp

    @foreach($dataRows as $data)
        <tr>
            {{-- *** Data --}}
            <td>{{ $no }}</td>
            <td>{{ $data->nik }}</td>
            <td>{{ $data->namapasien }}</td>
            <td>{{ IDateTime::formatDate($data->tgl_lahir_pasien) }}</td>
            <td>{{ IDateTime::dateDiff($data->tgl_lahir_pasien) }} Tahun</td>
            <td>{{ $data->alamat }}</td>
            <td>{{ $data->nohp }}</td>
            <td>{{ $data->periksa_hamil_ke }}</td>
            <td>{{ $data->periksa_minggu_ke }}</td>

            {{-- *** Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <td>{{ $data->periksa_bb }}</td>
            <td>{{ Option::getSesuaiAtauTidak($data->is_sesuai_kurva_bb) }}</td>
            <td>{{ $data->periksa_lila }}</td>
            <td>{{ $data->periksa_tekanan_darah }}</td>
            <td>{{ Option::getSesuaiAtauTidak($data->is_sesuai_kurva_tekanan_darah) }}</td>

            {{-- *** Skrining TBC --}}
            <td>{{ Option::getYaAtauTidak($data->is_batuk) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_demam) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_bb_tidak_naik_turun) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_kontak_pasien_tbc) }}</td>

            {{-- Pemberian TTD & MT Bumil KEK --}}
            <td>{{ Option::getYaAtauTidak($data->is_beri_tablet) }}</td>
            <td>{{ Number::format($data->jml_tablet) }}</td>
            <td>{{ Option::getKonsumsiHarian($data->konsumsi_tablet) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_beri_mt) }}</td>
            <td>{{ $data->mt_bumil }}</td>
            <td>{{ Option::getKonsumsiHarian($data->konsumsi_mt_bumil) }}</td>

            {{-- Kelas Ibu Hamil --}}
            <td>{{ Option::getYaAtauTidak($data->is_kelas_bumil) }}</td>
            <td>{{ $data->edukasi }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_rujuk) }}</td>
        </tr>

        @php
            $no++;
        @endphp
    @endforeach

    <tr></tr>
    <tr></tr>
    <tr></tr>
</tbody>
</table>

<table>
    <thead>
        <tr>
            <th colspan="2" style="{!! $pageResult !!}">Total Kunjungan :</th>
            <th colspan="2" style="{!! $pageResult !!}">{{ count($dataRows) }} Ibu</th>
        </tr>
    </thead>
</table>
