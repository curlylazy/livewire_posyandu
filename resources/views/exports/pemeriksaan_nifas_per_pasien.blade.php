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
            <th colspan="3">: {{ $dataPasien->namapasien }}</th>

            {!! CssExcel::columnBreak(3) !!}
            <th colspan="2" style="{!! CssExcel::$rowSize250Light !!}">Dusun/RT/RW</th>
            <th colspan="5">: </th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">NIK</th>
            <th colspan="3">: {{ $dataPasien->nik }}</th>

            {!! CssExcel::columnBreak(3) !!}
            <th colspan="2" style="{!! CssExcel::$rowSize250Light !!}">Desa/Kelurahan/Nagari</th>
            <th colspan="5">: </th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Tanggal Lahir / Umur</th>
            <th colspan="3">: {{ IDateTime::formatDate($dataPasien->tgl_lahir) }} / {{ $dataPasien->umur }} Tahun</th>

            {!! CssExcel::columnBreak(3) !!}
            <th colspan="2" style="{!! CssExcel::$rowSize250Light !!}">Kecamatan</th>
            <th colspan="5">: </th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Nama Suami</th>
            <th colspan="3">: {{ $dataPasien->namasuami }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Alamat</th>
            <th colspan="3">: {{ $dataPasien->alamat }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">No HP</th>
            <th colspan="3">: {{ $dataPasien->nohp }}</th>
        </tr>

        {!! CssExcel::rowBreak(2) !!}

        <tr>
            <th style="{!! CssExcel::$rowSize250 !!}">Ibu Nifas / Menyusui</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Nama Anak</th>
            <th colspan="2">: {{ $dataPasien->namabayi }} </th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Tanggal Bersalin</th>
            <th colspan="2">: {{ IDateTime::formatDate($dataPasien->bayi_tgl_bersalin) }} </th>

            {!! CssExcel::columnBreak(3) !!}
            <th style="{!! CssExcel::$rowSize250Light !!}" colspan="2">Tempat Bersalin</th>
            <th colspan="2">: {{ $dataPasien->bayi_tempatbersalin }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Anak Ke</th>
            <th colspan="2">: {{ $dataPasien->bayi_anakke }} </th>

            {!! CssExcel::columnBreak(3) !!}
            <th style="{!! CssExcel::$rowSize250Light !!}" colspan="2">Cara Bersalin</th>
            <th colspan="2">: {{ Option::getOptionName(Option::$optNameCaraBersalin, $dataPasien->bayi_carabersalin) }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Berat Badan</th>
            <th colspan="2">: {{ $dataPasien->bayi_beratbadan }} Kg</th>

            {!! CssExcel::columnBreak(3) !!}
            <th style="{!! CssExcel::$rowSize250Light !!}" colspan="2">Tinggi Badan</th>
            <th>: {{ $dataPasien->bayi_tinggibadan }} Cm</th>
        </tr>
    </thead>
</table>

{{-- *** header name --}}
<table>
    <thead>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgPink !!}" rowspan="4">Waktu Ke Posyandu (Tanggal/Bulan/Tahun)</th>

            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$rowSize250Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="10">Hasil Penimbangan/Pengukuran/Pemeriksaan</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$rowSize250Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="4">Pemberian Vit A, Menyusui dan KB</th>

            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$rowSize200Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgPurple !!}" rowspan="4">Edukasi yang Diberikan</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$rowSize200Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}" rowspan="4">Rujuk Pustu/Puskesmas/Rumah Sakit</th>
        </tr>

        <tr>
            {{-- Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Berat Badan</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Lingkar Lengan Atas</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Tekanan Darah</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="4">Skrining TBC</th>

            {{-- Pemberian Vit A, Menyusui dan KB --}}
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Vitamin A</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Menyusui</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">KB</th>
        </tr>

        <tr>
            {{-- Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="6">(Jika hasil: tidak/merah maka rujuk ke Pustu / Puskesmas)</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="4">(Jika 2 gejala terpenuhi maka rujuk ke Pustu/Puskesmas)</th>

            {{-- Pemberian Vit A, Menyusui dan KB --}}
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="4">Jika sasaran tidak : konsumsi Vit A, menyusui dan KB berikan edukasi</th>
        </tr>

        <tr>
            {{-- Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">BB (Kg)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Sesuai kurva Buku KIA Ya (hijau)/Tidak (merah)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">Lila (Cm)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">23.5cm (hijau) / < 23.5cm (merah)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">Sistole / Diastole (mm/Hg)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Sesuai kurva Buku KIAYa (hijau)/ Tidak (merah)</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">Batuk terus menerus Ya / Tidak</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Demam lebih dari ≥2 minggu Ya / Tidak</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">BB tidak naik atau turun  dalam 2 bulan berturut-turut Ya / Tidak</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Kontak erat dengan Pasien TBC Ya / Tidak</th>

            {{-- Pemberian Vit A, Menyusui dan KB --}}
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Jika nakes memberikan Vit A tuliskan jumlah kapsul</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Konsumsi Vit A Ya / Tidak</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Menyusui Ya / Tidak</th>
            <th style="{!! CssExcel::$rowHeight200px !!} {!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Mengikuti KB Pasca Persalinan Ya / Tidak</th>
        </tr>

        <tr>
            {{-- Number --}}
            @for ($i = 1; $i <=17; $i++)
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
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->periksa_bb }}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground($row->is_sesuai_kurva_bb) !!}">{!! ($row->is_sesuai_kurva_bb) ? "Ya" : "Tidak" !!}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->periksa_lila }}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground($lilaKurang235) !!}">{!! ($lilaKurang235) ? "Ya" : "Tidak" !!}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->periksa_tekanan_darah }}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground($row->is_sesuai_kurva_tekanan_darah) !!}">{!! ($row->is_sesuai_kurva_tekanan_darah) ? "✓" : "✗" !!}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground(!$row->is_batuk) !!}">{!! ($row->is_batuk) ? "Ya" : "Tidak" !!}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground(!$row->is_demam_ya) !!}">{!! ($row->is_demam_ya) ? "Ya" : "Tidak" !!}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground(!$row->is_bb_tidak_naik_turun) !!}">{!! ($row->is_bb_tidak_naik_turun) ? "Ya" : "Tidak" !!}</td>
                <td style="{!! CssExcel::$textCenter !!} {!! CssExcel::setBackground(!$row->is_kontak_pasien_tbc) !!}">{!! ($row->is_kontak_pasien_tbc) ? "Ya" : "Tidak" !!}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ ($row->is_beri_vit_a) ? "Ya ($row->jml_tablet_vit_a)" : 'Tidak' }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ ($row->is_konsumsi_vit_a) ? "Ya" : "Tidak" }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ ($row->is_menyusui) ? "Ya" : "Tidak" }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ ($row->is_kb) ? "Ya" : "Tidak" }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->edukasi }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ ($row->is_rujuk) ? "Ya" : "Tidak" }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
