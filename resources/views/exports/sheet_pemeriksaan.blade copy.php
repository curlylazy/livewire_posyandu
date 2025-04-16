<!-- @php
    $pageTitle = "font-weight: bold; font-size: 15pt; width: 100px";
    $pageSubTitle = "font-weight: bold; font-size: 12pt; width: 100px";
    $heading = "font-weight: bold; font-size: 15pt; text-align: center; background-color: #FFB6C1";
    $rowSize200 = "font-weight: bold; width: 200px;";
    $rowSize250 = "font-weight: bold; width: 250px;";
    $rowSize300 = "font-weight: bold; width: 300px;";
    $rowSize350 = "font-weight: bold; width: 350px;";
    $rowSize400 = "font-weight: bold; width: 400px;";

    $pageResult = "font-weight: bold; font-size: 14pt;";
@endphp

<table>
    <thead>
        <tr>
            <th style="{!! $pageTitle !!}" colspan="2">{{ $page_title }}</th>
        </tr>
        <tr>
            <th style="{!! $pageSubTitle !!}" colspan="2">Tahun : {{ $tahun }}</th>
        </tr>
        <tr>
            <th style="{!! $pageSubTitle !!}" colspan="2">Bulan : {{ $bulan }}</th>
        </tr>
        <tr>

        </tr>
    </thead>

    @if($kategori_periksa == "nifas")

    @else
        <thead>
            <tr>
                <th style="{!! $heading !!}" colspan="9">DATA</th>
                <th style="{!! $heading !!}" colspan="5">Hasil Penimbangan/Pengukuran/Pemeriksaan</th>
                <th style="{!! $heading !!}" colspan="4">Skrining TBC</th>
                <th style="{!! $heading !!}" colspan="3">Kelas Ibu Hamil</th>
                <th style="{!! $heading !!}" colspan="6">Pemberian TTD & MT Bumil KEK</th>
                <th style="{!! $heading !!}" colspan="3">Kelas Ibu Hamil</th>
            </tr>
        </thead>
        <thead>
            <tr>
                {{-- DATA --}}
                <th style="font-weight: bold; height: 100px;">No</th>
                <th style="{!! $rowSize200 !!}">NIK</th>
                <th style="{!! $rowSize250 !!}">Nama Ibu</th>
                <th style="{!! $rowSize200 !!}">Tanggal Lahir</th>
                <th style="{!! $rowSize200 !!}">Umur</th>
                <th style="{!! $rowSize250 !!}">Alamat</th>
                <th style="{!! $rowSize200 !!}">No Hp</th>
                <th style="{!! $rowSize200 !!}">Hamil Ke</th>
                <th style="{!! $rowSize200 !!}">Minggu Ke</th>

                {{-- *** Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
                <th style="{!! $rowSize200 !!}">Berat Badan (Kg)</th>
                <th style="{!! $rowSize200 !!}">Sesuai Kurva Buku KIA</th>
                <th style="{!! $rowSize200 !!}">LILA (cm)</th>
                <th style="{!! $rowSize200 !!}">Tekanan Darah</th>
                <th style="{!! $rowSize200 !!}">Sesuai Kurva Buku KIA</th>

                {{-- *** Skrining TBC --}}
                <th style="{!! $rowSize250 !!}">Batuk Terus Menerus</th>
                <th style="{!! $rowSize300 !!}">Demam Lebih ≥2 minggu</th>
                <th style="{!! $rowSize350 !!}">Berat Badan Tidak Naik/Turun Dalam 2 Bulan</th>
                <th style="{!! $rowSize350 !!}">Kontak Erat Dengan Pasien TBC</th>

                {{-- Pemberian TTD & MT Bumil KEK --}}
                <th style="{!! $rowSize350 !!}">Diberikan Tablet Oleh Nakes ?</th>
                <th style="{!! $rowSize200 !!}">Jumlah Tablet</th>
                <th style="{!! $rowSize350 !!}">Konsumsi Tablet Tambah Darah</th>
                <th style="{!! $rowSize350 !!}">Diberikan MT Bumil Kek Oleh Nakes ?</th>
                <th style="{!! $rowSize350 !!}">MT Untuk Bumil KEK</th>
                <th style="{!! $rowSize300 !!}">Konsumsi MT Bumil KEK</th>

                {{-- Kelas Ibu Hamil --}}
                <th style="{!! $rowSize300 !!}">Mengikut Kelas Ibu Hamil</th>
                <th style="{!! $rowSize300 !!}">Edukasi yang Diberikan</th>
                <th style="{!! $rowSize300 !!}">Rujuk Pustu/Puskesmas/Rumah Sakit</th>
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
    @endif
</table>

{{-- <table>
    <thead>
        <tr><th colspan="2" style="{!! $pageResult !!}">Total Kunjungan :</th></tr>
        <tr><th colspan="2" style="{!! $pageResult !!}">{{ $no }} Ibu</th></tr>
    </thead>
</table> --}} -->
