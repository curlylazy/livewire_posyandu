<table>
    <thead>
        <tr>
            <td></td>
            <td style="{!! CssExcel::$pageTitle !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$rowHeight100px !!}" colspan="12">
                KARTU BANTU PEMERIKSAAN IBU HAMIL/NIFAS/MENYUSUI <br/>
                {{ $page_title }}
            </td>
        </tr>
        {!! CssExcel::rowBreak(2) !!}
    </thead>
</table>

{{-- *** data pasien --}}
<table>
    <thead>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Nama Pasien</th>
            <th>: {{ $dataPasien->namapasien }}</th>

            {!! CssExcel::columnBreak(3) !!}
            <th colspan="2" style="{!! CssExcel::$rowSize250Light !!}">Dusun/RT/RW</th>
            <th colspan="5">: </th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">NIK</th>
            <th>: {{ $dataPasien->nik }}</th>

            {!! CssExcel::columnBreak(3) !!}
            <th colspan="2" style="{!! CssExcel::$rowSize250Light !!}">Desa/Kelurahan/Nagari</th>
            <th colspan="5">: </th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Tanggal Lahir / Umur</th>
            <th>: {{ IDateTime::formatDate($dataPasien->tgl_lahir) }} / {{ $dataPasien->umur }} Tahun</th>

            {!! CssExcel::columnBreak(3) !!}
            <th colspan="2" style="{!! CssExcel::$rowSize250Light !!}">Kecamatan</th>
            <th colspan="5">: </th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Nama Suami</th>
            <th>: {{ $dataPasien->namasuami }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Alamat</th>
            <th colspan="2">: {{ $dataPasien->alamat }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">No HP</th>
            <th>: {{ $dataPasien->nohp }}</th>
        </tr>

        {!! CssExcel::rowBreak(2) !!}

        <tr>
            <th style="{!! CssExcel::$rowSize250 !!}">Ibu Hamil</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Jarak dengan Anak Sebelumnya</th>
            <th>: {{ $dataPasien->jarakkehamilan }} Tahun</th>

            {!! CssExcel::columnBreak(3) !!}
            <th style="{!! CssExcel::$rowSize250Light !!}">Hamil Anak ke</th>
            <th>: {{ $dataPasien->q_hamil_ke }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Berat Badan</th>
            <th>: {{ $dataPasien->beratbadan }} Kg</th>

            {!! CssExcel::columnBreak(3) !!}
            <th style="{!! CssExcel::$rowSize250Light !!}">Tinggi Badan</th>
            <th>: {{ $dataPasien->tinggibadan }} Cm</th>
        </tr>
    </thead>
</table>

{{-- *** header name --}}
<table>
    <thead>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgPink !!}" rowspan="4">Waktu Ke Posyandu (Tanggal/Bulan/Tahun)</th>
            <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgPink !!}" rowspan="4">Usia Kehamilan</th>

            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$rowSize250Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="10">Hasil Penimbangan/Pengukuran/Pemeriksaan</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$rowSize250Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="4">Pemberian TTD dan MT Bumil KEK</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$rowSize200Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="2">Kelas Ibu Hamil</th>

            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$rowSize200Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgPurple !!}" rowspan="4">Edukasi yang Diberikan</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$rowSize200Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}" rowspan="4">Rujuk Pustu/Puskesmas/Rumah Sakit</th>
        </tr>

        <tr>
            {{-- Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Berat Badan</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Lingkar Lengan Atas</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Tekanan Darah</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="4">Skrining TBC</th>

            {{-- Pemberian TTD dan MT Bumil KEK --}}
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Tablet Tambah Darah</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Makanan Tambahan KEK</th>
        </tr>

        <tr>
            {{-- Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="6">(Jika hasil: tidak/merah maka rujuk ke Pustu / Puskesmas)</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="4">(Jika 2 gejala terpenuhi maka rujuk ke Pustu/Puskesmas)</th>

            {{-- Pemberian TTD dan MT Bumil KEK --}}
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="4">(Jika konsumsi tidak setiap hari maka berikan edukasi)</th>

            {{-- Kelas Ibu Hamil --}}
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Jika Tidak Diberikan Edukasi</th>
        </tr>

        <tr>
            {{-- Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">BB (Kg)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Sesuai kurva Buku KIA Ya (hijau)/Tidak (merah)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">Lila (Cm)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">23.5cm (hijau) / < 23.5cm (merah)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">Sistole / Diastole (mm/Hg)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Sesuai kurva Buku KIAYa (hijau)/ Tidak (merah)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Batuk terus menerus Ya / Tidak</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Demam lebih dari ≥2 minggu Ya / Tidak</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">BB tidak naik atau turun  dalam 2 bulan berturut-turut Ya / Tidak</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Kontak erat dengan Pasien TBC Ya / Tidak</th>

            {{-- Pemberian TTD dan MT Bumil KEK --}}
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Jika nakes memberikan TTD Tuliskan jumlah tablet</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Konsumsi Tablet Tambah Darah Setiap hari / Tidak setiap hari</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Jika nakes memberikan MT Bumil KEK, Tuliskan komposisi dan jumlah porsi</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Konsumsi MT Bumil KEK Setiap hari / Tidak setiap hari</th>

            {{-- Kelas Ibu Hamil --}}
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize200Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgPurple !!}">Mengikuti Kelas Ibu Ya / Tidak</th>
        </tr>

        <tr>
            {{-- Number --}}
            @for ($i = 1; $i <=19; $i++)
                <th style="{!! CssExcel::$rowHeight25px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">{{ $i }}</th>
            @endfor
        </tr>
    </thead>

     {{-- *** Fill data disini --}}
    <tbody>
        @foreach ($dataRows as $row)

            @php
                $lilaKurang235 = ($row->periksa_lila < 23.5);
            @endphp

            <tr>
                <td style="{!! CssExcel::$textCenter !!}">{{ IDateTime::formatDate($row->tgl_periksa) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">Minggu ke - {{ $row->hamil_ke }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->periksa_bb }}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground($row->is_sesuai_kurva_bb) !!}">{!! ($row->is_sesuai_kurva_bb) ? "✓" : "✗" !!}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->periksa_lila }}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground($lilaKurang235) !!}">{!! ($lilaKurang235) ? "Ya" : "Tidak" !!}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->periksa_tekanan_darah }}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground($row->is_sesuai_kurva_tekanan_darah) !!}">{!! ($row->is_sesuai_kurva_tekanan_darah) ? "✓" : "✗" !!}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground($row->is_batuk) !!}">{!! ($row->is_batuk) ? "Ya" : "Tidak" !!}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground($row->is_demam_ya) !!}">{!! ($row->is_demam_ya) ? "Ya" : "Tidak" !!}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground($row->is_bb_tidak_naik_turun) !!}">{!! ($row->is_bb_tidak_naik_turun) ? "Ya" : "Tidak" !!}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground($row->is_kontak_pasien_tbc) !!}">{!! ($row->is_kontak_pasien_tbc) ? "Ya" : "Tidak" !!}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ ($row->is_beri_tablet) ? "Ya ($row->jml_tablet)" : 'Tidak' }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ ($row->konsumsi_tablet) ? "Setiap Hari" : "Tidak Setiap Hari" }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ ($row->is_beri_mt) ? "Ya - $row->mt_bumil" : "Tidak" }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ ($row->konsumsi_mt_bumil) ? "Setiap Hari" : "Tidak Setiap Hari" }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ ($row->is_kelas_bumil) ? "Ya" : "Tidak" }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->edukasi }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ ($row->is_rujuk) ? "Ya" : "Tidak" }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
