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
            <th colspan="3">: {{ config('app.desa') }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Kecamatan</th>
            <th colspan="3">: {{ config('app.kecamatan') }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Tahun</th>
            <th colspan="3">: {{ $tahun }}</th>
        </tr>
    </thead>
</table>

{{-- *** header name --}}
<table>
    <thead>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="3">Bulan dan Tahun</th>

            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="6">Jumlah Sasaran</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="15">Jumlah Bayi/Balita/Apras dengan Hasil Penimbangan dan Pengukuran/Pemantauan/Pemeriksaan  </th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="7" rowspan="2">Jumlah Bayi Mendapatkan :</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="3">Jumlah Bayi Sakit</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2" rowspan="2">Jumlah Sasaran dirujuk</th>
        </tr>

        <tr>
            {{-- *** Jumlah Sasaran --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="2">Bayi (0-6 Bulan)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="2">Balita dan Apras (7 - 32 bulan)</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Datang</th>
            <th style="{!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Tidak Datang</th>

            {{-- *** Jumlah Bayi/Balita/Apras dengan Hasil Penimbangan dan Pengukuran/Pemantauan/Pemeriksaan --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Balita dengan Ceklis Perkembangan</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="4">BB/U (0-5 tahun)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Hasil Pengukuran PB/TB/Umur 0-5 tahun</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Hasil Pengukuran BB/PB atau BB/TB</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Hasil Pengukuran Lingkar Kepala</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="2">Lingkar Lengan Atas</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" rowspan="2">Bergejala TBC<br/>memenuhi 2 gejala</th>
        </tr>

        <tr>
            {{-- *** Jumlah Sasaran --}}
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Bayi (0-6 bulan)</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Balita dan Apras (≥6 bln-6 thn)</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Bayi (0-6 bulan)</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Balita dan Apras (≥6 bln-6 thn)</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Lengkap</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight50px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Tidak Lengkap</th>

            {{-- *** Jumlah Bayi/Balita/Apras dengan Hasil Penimbangan dan Pengukuran/Pemantauan/Pemeriksaan --}}
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Naik (N)</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Tidak Naik / Bawah Garis Merah/ Atas Garis Oranye</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Gizi Baik (BB Normal)</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Gizi Buruk / Gizi Kurang / Berisiko Gizi Lebih/ Gizi Lebih / Obesitas</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Normal</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Sangat Pendek dan Pendek / Tinggi melebihi normal </th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Gizi Baik</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Gizi Buruk / Gizi Kurang / Berisiko Gizi Lebih/ Gizi Lebih / Obesitas</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Normal</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Melebihi normal / Kurang dari normal</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Normal</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Gizi Kurang / Gizi Buruk</th>

            {{-- *** Jumlah bayi/balita mendapat --}}
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">ASI Ekslusi (0-6 bulan)</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">MP ASI(>6 bulan) (Sesuai)</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Imunisasi (Bayi/Balita)</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Vitamin A</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Obat Cacing</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">MT Pangan Lokal</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Jumlah sasaran mendapatkan edukasi</th>

            {{-- *** Jumlah sasaran dirujuk --}}
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Bayi (0-6 bulan)</th>
            <th style="{!! CssExcel::$rowSize200Light !!} {!! CssExcel::$rowHeight100px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">Balita dan Apras (≥6 bln-6 thn)</th>
        </tr>

        <tr>
            @for ($i = 1; $i <=32; $i++)
                <th style="{!! CssExcel::$rowHeight25px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">{{ $i }}</th>
            @endfor
        </tr>
    </thead>

    {{-- *** Fill data disini --}}
    <tbody>
        @foreach ($dataRows as $row)
            <tr>
                <td style="{!! CssExcel::$textCenter !!}">{{ $row->periode }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bayi) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_balita_apras) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bayi_datang) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_balita_apras_datang) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bayi_tidak_datang) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_balita_apras_tidak_datang) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bayi_checklist_lengkap) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bayi_checklist_tidak_lengkap) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bb_naik) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bb_tidak_naik) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bb_normal) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bb_tidak_normal) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_tb_normal) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_tb_tidak_normal) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bb_gizi_baik) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bb_gizi_tidak_baik) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_lk_normal) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_lk_tidak_normal) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_lila_gizi_normal) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_lila_gizi_tidak_normal) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bergejala_tbc) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_asi_eksklusif) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_mpasi) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_imunisasi_lengkap) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_beri_vit_a) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_beri_obat_cacing) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_mt_pangan_lokal) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_edukasi) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_sakit) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_bayi_dirujuk) }}</td>
                <td style="{!! CssExcel::$textCenter !!}">{{ Number::format($row->jml_balita_apras_dirujuk) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
