<table>
    <thead>
        <tr>
            <td></td>
            <td style="{!! CssExcel::$pageTitle !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$rowHeight100px !!}" colspan="12">
                {{ $page_title }} <br/>
                POSYANDU :
            </td>
        </tr>
        {!! CssExcel::rowBreak(2) !!}
    </thead>
</table>

{{-- *** data pasien --}}
<table>
    <thead>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Dusun/RT/RW</th>
            <th colspan="3">: </th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Desa/Kelurahan/Negari</th>
            <th colspan="3">: </th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Kecamatan</th>
            <th colspan="3">: </th>
        </tr>
    </thead>
</table>

{{-- *** header name --}}
<table>
    <thead>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="3">Bulan dan Tahun</th>

            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="6">Jumlah Sasaran</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="7">Jumlah Ibu Hamil/Nifas/Menyusui dengan Hasil Penimbangan/Pengukuran/Pemeriksaan</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="3">TTD</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="3">PMT Bumil KEK</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2" rowspan="2">Jumlah Ibu Hamil mengikuti Kelas Ibu Hamil</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2" rowspan="2">Jumlah Ibu Nifas mendapatkan Vitamin A</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2" rowspan="2">Jumlah Ibu Nifas/Menyusui mengikuti KB Pasca Persalinan</th>
            <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="3">Jumlah Ibu Hamil/Nifas/Menyusui mendapatkan Edukasi</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="2" colspan="2">Jumlah Sasaran yang Dirujuk</th>
        </tr>

        <tr>
            {{-- *** Jumlah Sasaran --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="2">Ibu Hamil</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="2">Ibu Nifas/ Menyusui</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Datang</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Tidak Datang</th>

            {{-- *** Jumlah Ibu Hamil/Nifas/Menyusui dengan Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <th style="{!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Berat Badan</th>
            <th style="{!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Lingkar Lengan Atas</th>
            <th style="{!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Tekanan Darah</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="2">Bergejala TBC (memenuhi 2 gejala)</th>

            {{-- *** TTD --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="2">Jumlah Ibu hamil mendapatkan TTD</th>
            <th style="{!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Ibu Hamil Konsumsi TTD</th>

            {{-- *** PMT Bumil KEK --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="2">Jumlah Ibu hamil yang mendapatkan PMT Bumil KEK</th>
            <th style="{!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Ibu hamil konsumsi PMT</th>
        </tr>

         <tr>
            {{-- *** Jumlah Sasaran --}}
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Ibu Hamil</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Ibu Nifas/ Menyusui</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Ibu Hamil</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Ibu Nifas/ Menyusui</th>

            {{-- *** Jumlah Ibu Hamil/Nifas/Menyusui dengan Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Hijau</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Merah</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Hijau</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Merah/KEK</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Hijau</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Merah</th>

            {{-- *** TTD --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Setiap Hari</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Tidak</th>

            {{-- *** PMT Bumil KEK --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Setiap Hari</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Tidak</th>

            {{-- *** Jumlah Ibu Hamil mengikuti Kelas Ibu Hamil --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Ya</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Tidak</th>

            {{-- *** Jumlah Ibu Nifas/Menyusui mengikuti KB Pasca Persalinan --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Ya</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Tidak</th>

            {{-- *** Jumlah Ibu Nifas/Menyusui mengikuti KB Pasca Persalinan --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Ya</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Tidak</th>

            {{-- *** Jumlah sasaran yang dirujuk --}}
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Ibu Hamil</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Ibu Nifas/Menyusui</th>
        </tr>

        <tr>
            @for ($i = 1; $i <=29; $i++)
                <th style="{!! CssExcel::$rowHeight25px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">{{ $i }}</th>
            @endfor
        </tr>
    </thead>

    {{-- *** Fill data disini --}}
    <tbody>
        @foreach ($dataRows as $row)
            <tr>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->periode }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_bumil }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_nifas }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_bumil_datang }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_nifas_datang }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_bumil_tidak_datang }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_nifas_tidak_datang }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_sesuai_kurva_bb }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_tidak_sesuai_kurva_bb }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_sesuai_lila }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_tidak_sesuai_lila }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_sesuai_tekanan_darah }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_tidak_sesuai_tekanan_darah }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_bergejala_tbc }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_ibu_hamil_ttd }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_konsumsi_tablet_tiap_hari }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_konsumsi_tablet_tidak }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_bumil_kek }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_bumil_kek_tiap_hari }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_bumil_kek_tidak }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_bumil_kelas_ibu_hamil_ya }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_bumil_kelas_ibu_hamil_tidak }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_nifas_vitamin_a_ya }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_nifas_vitamin_a_tidak }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_nifas_kb_ya }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_nifas_kb_tidak }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_bumil_nifas_edukasi }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_rujuk_bumil }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->jml_rujuk_nifas }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
