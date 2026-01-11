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
        <th style="{!! $heading !!}" colspan="8">Data Pasien</th>
        <th style="{!! $heading !!}" colspan="1">Info Pemeriksaan</th>
        <th style="{!! $heading !!}" colspan="4">Hasil Penimbangan/Pengukuran/Pemeriksaan</th>
        <th style="{!! $heading !!}" colspan="4">Hasil Skrining TBC</th>
        <th style="{!! $heading !!}" colspan="6">Bayi Balita mendapatkan</th>
        <th style="{!! $heading !!}" colspan="6">Hasil Penimbangan Pengukuran</th>
        <th style="{!! $heading !!}" colspan="2">Lainnya</th>
    </tr>
</thead>
<thead>
    <tr>
        {{-- Data Pasien --}}
        <th style="{!! CssExcel::$rowSize50Light !!} {!! CssExcel::$bgGray !!}">No</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">NIK</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Nama Pasien</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Nama Ibu</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Nama Ayah</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Tanggal Lahir</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Umur</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Alamat</th>

        {{-- Info Pemeriksaan --}}
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Tanggal Pemeriksaan</th>

        {{-- Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Berat Badan</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Lingkar Lengan Atas (LILA)</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Tinggi Badan</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Lingkar Kepala</th>

        {{-- Hasil Skrining TBC --}}
        <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$bgGray !!}">Pasien batuk terus menerus ?</th>
        <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$bgGray !!}">Pasien demam lebih dari 2 minggu ?</th>
        <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$bgGray !!}">BB tidak naik atau turun dalam 2 bulan berturut-turut ?</th>
        <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$bgGray !!}">Pasien ada kontak erat dengan pasien TBC ?</th>

        {{-- Bayi/Balita mendapatkan --}}
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">ASI Ekslusif ?</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">MP ASI ?</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Imunisasi ?</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Vitamin A ?</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Obat Cacing ?</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">MT Pangan Lokal Untuk Pemulihan ?</th>

        {{-- Hasil Penimbangan Pengukuran --}}
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Berat Badan Naik ?</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Kesimpulan Berat Badan</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Kesimpulan Tinggi Badan</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Kesimpulan Lingkar Kepala</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Kesimpulan Gizi BB</th>
        <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$bgGray !!}">Kesimpulan Gizi Lila</th>

        {{-- Edukasi Konseling --}}
        <th style="{!! CssExcel::$rowSize300Light !!} {!! CssExcel::$bgGray !!}">Edukasi / Konseling ?</th>
        <th style="{!! CssExcel::$rowSize100Light !!} {!! CssExcel::$bgGray !!}">Ada Gejala Sakit ?</th>
    </tr>
</thead>

<tbody>
    @foreach($dataRows as $data)
        <tr>
            {{-- Data Pasien --}}
            <td>{{ $loop->index }}</td>
            <td>{{ $data->nik }}</td>
            <td>{{ $data->namapasien }}</td>
            <td>{{ $data->namaibu }}</td>
            <td>{{ $data->namaayah }}</td>
            <td>{{ IDateTime::formatDate($data->tgl_lahir_pasien) }}</td>
            <td>{{ IDateTime::dateDiff($data->tgl_lahir_pasien) }} Tahun</td>
            <td>{{ $data->alamat }}</td>

            {{-- Info Pemeriksaan --}}
            <td>{{ IDateTime::formatDate($data->tgl_periksa) }}</td>

            {{-- Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <td>{{ $data->periksa_bb }}</td>
            <td>{{ $data->periksa_lila }}</td>
            <td>{{ $data->periksa_tinggi_badan }}</td>
            <td>{{ $data->periksa_lingkar_kepala }}</td>

            {{-- Hasil Skrining TBC --}}
            <td>{{ Option::getYaAtauTidak($data->is_batuk) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_demam) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_bb_tidak_naik_turun) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_kontak_pasien_tbc) }}</td>

            {{-- Bayi/Balita mendapatkan --}}
            <td>{{ Option::getYaAtauTidak($data->is_asi_ekslusif) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_mpasi_sesuai) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_imunisasi_lengkap) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_beri_vit_a) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_beri_obat_cacing) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_mt_pangan_lokal_pemulihan) }}</td>

            {{-- Hasil Penimbangan Pengukuran --}}
            <td class="fw-bold">{{ Option::getYaAtauTidak($data->kesimpulan_berat_badan_naik) }}</td>
            <td class="fw-bold">{{ Option::getOptionName(Option::$optNameKesimpulanBB, $data->kesimpulan_berat_badan) }}</td>
            <td class="fw-bold">{{ Option::getOptionName(Option::$optNameKesimpulanTinggiBadan, $data->kesimpulan_tinggi_badan) }}</td>
            <td class="fw-bold">{{ Option::getOptionName(Option::$optNameKesimpulanLila, $data->kesimpulan_lingkar_kepala) }}</td>
            <td class="fw-bold">{{ Option::getOptionName(Option::$optNameKesimpulanGiziBB, $data->kesimpulan_gizi_bb) }}</td>
            <td class="fw-bold">{{ Option::getOptionName(Option::$optNameKesimpulanGiziLila, $data->kesimpulan_gizi_lila) }}</td>

            {{-- Lainnya --}}
            <td>{{ $data->edukasi }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_gejala_sakit) }}</td>
        </tr>
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
            <th colspan="2" style="{!! $pageResult !!}">{{ count($dataRows) }} Bayi</th>
        </tr>
    </thead>
</table>
