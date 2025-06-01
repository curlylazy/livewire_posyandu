<table>
    <thead>
        <tr><th style="{!! CssExcel::$pageTitle !!}" colspan="2">KARTU BANTU PEMERIKSAAN IBU HAMIL/NIFAS/MENYUSUI</th></tr>
        <tr><th style="{!! CssExcel::$pageTitle !!}" colspan="2">{{ $page_title }}</th></tr>
        <tr></tr>
    </thead>
</table>

{{-- *** data pasien --}}
<table>
    <thead>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Nama Pasien</th>
            <th>: {{ $dataPasien->namapasien }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">NIK</th>
            <th>: {{ $dataPasien->nik }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Tanggal Lahir / Umur</th>
            <th>: {{ IDateTime::formatDate($dataPasien->tgl_lahir) }} / {{ $dataPasien->umur }} Tahun</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Nama Suami</th>
            <th>: {{ $dataPasien->namasuami }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Alamat</th>
            <th>: {{ $dataPasien->alamat }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">No HP</th>
            <th>: {{ $dataPasien->nohp }}</th>
        </tr>

        <tr></tr>
        <tr></tr>
        <tr></tr>

        <tr>
            <th style="{!! CssExcel::$rowSize250 !!}">Ibu Hamil</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Jarak dengan Anak Sebelumnya</th>
            <th>: ............</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Berat Badan</th>
            <th>: ............ Kg</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Hamil Anak ke</th>
            <th>:</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Tinggi Badan</th>
            <th>:</th>
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
</table>
