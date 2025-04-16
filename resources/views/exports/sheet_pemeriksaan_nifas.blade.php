<thead>
    <tr>
        <th style="{!! $heading !!}" colspan="14">DATA</th>
        <th style="{!! $heading !!}" colspan="5">Hasil Penimbangan/Pengukuran/Pemeriksaan</th>
        <th style="{!! $heading !!}" colspan="4">Skrining TBC</th>
        <th style="{!! $heading !!}" colspan="4">Pemberian Vit A, Menyusui dan KB</th>
        <th style="{!! $heading !!}" colspan="2">Edukasi</th>
    </tr>
</thead>
<thead>
    <tr>
        {{-- DATA --}}
        <th style="font-weight: bold; height: 100px;">No</th>
        <th style="{!! $rowSize200 !!}">NIK</th>
        <th style="{!! $rowSize300 !!}">Nama Ibu Nifas / Menyusui</th>
        <th style="{!! $rowSize300 !!}">Nama Suami</th>
        <th style="{!! $rowSize300 !!}">Nama Bayi</th>
        <th style="{!! $rowSize250 !!}">Tanggal Lahir</th>
        <th style="{!! $rowSize200 !!}">Umur</th>
        <th style="{!! $rowSize300 !!}">Alamat</th>
        <th style="{!! $rowSize300 !!}">No HP</th>
        <th style="{!! $rowSize200 !!}">Tinggi Badan</th>
        <th style="{!! $rowSize200 !!}">Anak Ke</th>
        <th style="{!! $rowSize350 !!}">Tanggal Bersalin</th>
        <th style="{!! $rowSize350 !!}">Tempat Bersalin</th>
        <th style="{!! $rowSize300 !!}">Cara Bersalin</th>

        {{-- Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
        <th style="{!! $rowSize200 !!}">Berat Badan (Kg)</th>
        <th style="{!! $rowSize200 !!}">Sesuai Kurva Buku KIA</th>
        <th style="{!! $rowSize200 !!}">LILA (cm)</th>
        <th style="{!! $rowSize200 !!}">Tekanan Darah</th>
        <th style="{!! $rowSize200 !!}">Sesuai Kurva Buku KIA</th>

        {{-- Skrining TBC --}}
        <th style="{!! $rowSize250 !!}">Batuk Terus Menerus</th>
        <th style="{!! $rowSize300 !!}">Demam Lebih ≥2 minggu</th>
        <th style="{!! $rowSize350 !!}">Berat Badan Tidak Naik/Turun Dalam 2 Bulan</th>
        <th style="{!! $rowSize350 !!}">Kontak Erat Dengan Pasien TBC</th>

        {{-- Pemberian Vit A, Menyusui dan KB --}}
        <th style="{!! $rowSize350 !!}">Nakes Berikan Vitamin A</th>
        <th style="{!! $rowSize350 !!}">Jumlah Konsumsi Vitamin A</th>
        <th style="{!! $rowSize250 !!}">Apakah Menyusui</th>
        <th style="{!! $rowSize350 !!}">Mengikuti KB Pasca Persalinan</th>

        {{-- Edukasi --}}
        <th style="{!! $rowSize300 !!}">Edukasi yang Diberikan</th>
        <th style="{!! $rowSize350 !!}">Rujuk Pustu/Puskesmas/Rumah Sakit</th>
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
            <td>{{ $data->nama_suami }}</td>
            <td>{{ $data->namabayi }}</td>
            <td>{{ IDateTime::formatDate($data->tgl_lahir_bayi) }}</td>
            <td>{{ IDateTime::dateDiffFormat($data->tgl_lahir_bayi) }}</td>
            <td>{{ $data->alamat }}</td>
            <td>{{ $data->nohp }}</td>
            <td>{{ $data->tinggibadan }} cm</td>
            <td>{{ $data->anakke }}</td>
            <td>{{ IDateTime::formatDate($data->tgl_bersalin) }}</td>
            <td>{{ $data->tempatbersalin }}</td>
            <td>{{ Option::getOptionName(Option::$optNameCaraBersalin, $data->carabersalin) }}</td>

            {{-- Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <td>{{ $data->periksa_bb_bayi }} kg</td>
            <td>{{ Option::getSesuaiAtauTidak($data->is_sesuai_kurva_bb) }}</td>
            <td>{{ $data->periksa_lila }}</td>
            <td>{{ $data->periksa_tekanan_darah }}</td>
            <td>{{ Option::getSesuaiAtauTidak($data->is_sesuai_kurva_tekanan_darah) }}</td>

            {{-- *** Skrining TBC --}}
            <td>{{ Option::getYaAtauTidak($data->is_batuk) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_demam) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_bb_tidak_naik_turun) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_kontak_pasien_tbc) }}</td>

            {{-- Pemberian Vit A, Menyusui dan KB --}}
            <td>{{ Option::getYaAtauTidak($data->is_beri_vit_a) }}</td>
            <td>{{ Number::format($data->jml_tablet_vit_a) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_menyusui) }}</td>
            <td>{{ Option::getYaAtauTidak($data->is_kb) }}</td>

            {{-- Edukasi --}}
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
