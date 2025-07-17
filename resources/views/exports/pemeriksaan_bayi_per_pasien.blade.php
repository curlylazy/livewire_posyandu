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

<table>
    <thead>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Nama Bayi/Balita/APRAS</th>
            <th colspan="3">: {{ $dataPasien->namapasien }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Tanggal Lahir</th>
            <th colspan="3">: {{ IDateTime::formatDate($dataPasien->tgl_lahir) }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Berat Badan Lahir</th>
            <th colspan="3">: {{ $dataPasien->beratbadan_lahir }} Kg</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Panjang Badan Lahir</th>
            <th colspan="3">: {{ $dataPasien->tinggibadan_lahir }} Cm</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Ayah</th>
            <th colspan="3">: {{ $dataPasien->nama_ayah }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Ibu</th>
            <th colspan="3">: {{ $dataPasien->nama_ibu }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">Alamat</th>
            <th colspan="3">: {{ $dataPasien->alamat }}</th>
        </tr>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!}">No HP</th>
            <th colspan="3">: {{ $dataPasien->nohp }}</th>
        </tr>
    </thead>
</table>

{{-- *** data dusun --}}
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

{{-- *** header --}}
<table>
    <thead>
        <tr>
            <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgPink !!}" rowspan="3">Bulan dan Tahun</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgPink !!}" rowspan="3">Waktu kunjungan ke Posyandu (Tanggal, Bulan, Tahun)</th>
            <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$rowHeight150px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="11">
                    Hasil Penimbangan/Pengukuran <br />
                    (Jika ditemukan Bayi/Balita/Apras dengan hasil Penimbangan BB tidak Naik/BGM/Atas Garis Oranye/Gizi
                    Kurang/Gizi Buruk/Berisiko Gizi Lebih/Gizi Lebih/Obesitas atau
                    hasil pengkuran PB/TB/Umur sangat pendek/pendek,  atau hasil pengukuran lingkar kepala makrosefali/mikrosefali,
                    atau hasil pengukuran Lingkar Lengan Atas warna merah maka  sasaran rujuk ke Pustu/Puskesmas)</th>
            <th style="{!! CssExcel::$rowSize300Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="4">Hasil Pemeriksaan/Pemantauan (jika 2 gejalaTBC terpenuhi  atau  Checklist Perkembangan Tidak Lengkap maka dirujuk ke Pustu/Puskesmas)</th>
            <th style="{!! CssExcel::$rowSize250Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}" colspan="6">Bayi / Balita / APRAS Mendapatkan :</th>
            <th style="{!! CssExcel::$rowSize300Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgPurple !!}" rowspan="3">Edukasi/Konseling Jika memberikan MP-ASI kaya protein hewani disebutkan</th>
            <th style="{!! CssExcel::$rowSize300Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}" rowspan="3">Gejala Sakit</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}" rowspan="3">Rujuk Pustu / Puskesmas</th>
        </tr>
        <tr>

            {{-- *** Hasil Penimbangan Pengukuran --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgPink !!}" rowspan="2">Checklist Perkembangan (Hijau jika Lengkap, Kuning jika Tidak)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}" rowspan="2">Berat Badan Bayi/Balita/Apras (Kg)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Kesimpulan Hasil Penimbangan BB Bayi/Balita dibandingkan bulan sebelumnya</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">Kesimpulan Hasil Pengukuran BB/Umur 0-5 tahun</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}" rowspan="2">Panjang/ Tinggi Badan Bayi/Balita/Apras (Cm)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">Kesimpulan Hasil Pengukuran PB/TB/Umur 0-5 tahun</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Kesimpulan Hasil Pengukuran BB/PB  atau BB/TB</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}" rowspan="2">Lingkar Kepala Bayi/Balita (Cm)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Kesimpulan Hasil Pengukuran Lingkar Kepala 0-5 tahun</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}" rowspan="2">Lingkar Lengan Atas Bayi/Balita (Cm)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Hasil Lingkar Lengan Atas Bayi/Balita</th>

            {{-- Hasil Pemeriksaan/Pemantauan (jika 2 gejalaTBC terpenuhi  atau  Checklist Perkembangan Tidak Lengkap maka dirujuk ke Pustu/Puskesmas) --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}" colspan="4">Skrining Gejala TBC (jika 2 gejala terpenuhi maka dirujuk ke Puskesmas)</th>

            {{-- Bayi / Balita / Apras Mendapatkan --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}" rowspan="2">ASI Exklusif <br/>(Ya/Tidak)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}" rowspan="2">MP ASI (Komposisi, jenis  sesuai umur) <br/>(Ya/Tidak)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}" rowspan="2">Imunisasi (Lengkap sesuai umur) <br/>(Ya/Tidak) (Sebutkan jenis imunisasi jika iya)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}" rowspan="2">Vitamin A <br/>(Ya/Tidak)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}" rowspan="2">Obat Cacing <br/>(Ya/Tidak)</th>
            <th style="{!! CssExcel::$rowSize300Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}" rowspan="2">MT Pangan Lokal Untuk Pemulihan (Konsumsi patuh) <br/>(Ya/Tidak) (jika nakes memberikan MT, sebutkan porsi)</th>
        </tr>

        <tr>
            {{-- *** Hasil Penimbangan Pengukuran --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Berat badan naik (N) / Berat badan tidak naik (T)</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">Berat badan sangat kurang / Berat badan kurang / Berat badan normal / Risiko berat badan lebih</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgYellow !!}">Sangat Pendek dan Pendek / Normal /Tinggi melebihi normal</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Gizi Buruk / Gizi Kurang / Gizi Baik / Berisiko Gizi Lebih/ Gizi Lebih / Obesitas </th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Melebihi normal / Normal / Kurang dari normal</th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightYellow !!}">Gizi Kurang /Normal/ Gizi Buruk</th>

            {{-- *** Skrining Gejala TBC (jika 2 gejala terpenuhi maka dirujuk ke Puskesmas) --}}
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Batuk terus menerus <br/>Ya / Tidak </th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Demam lebih dari ≥ 2 minggu <br/>Ya / Tidak </th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">BB tidak naik atau turun  dalam 2 bulan berturut-turut <br/>Ya / Tidak </th>
            <th style="{!! CssExcel::$rowSize150Light !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgLightBlue !!}">Kontak erat dengan Pasien TBC <br/>Ya / Tidak </th>

        </tr>
        <tr>
            {{-- Number --}}
            @for ($i = 1; $i <=26; $i++)
                <th style="{!! CssExcel::$rowHeight25px !!} {!! CssExcel::$textCenter !!} {!! CssExcel::$bgGray !!}">{{ $i }}</th>
            @endfor
        </tr>
    </thead>

    <tbody>
        @foreach ($dataRows as $row)
            <tr>
                <td>{{ $row->umur }}</td>
                <td>{{ IDateTime::formatDate($row->tgl_periksa) }}</td>
                <td>--</td>

                {{-- *** Hasil Penimbangan --}}
                <td>{{ $row->periksa_bb }} Kg</td>
                <td>{{ Option::getYaAtauTidak($row->isBBNaik) }}</td>
                <td>{{ $row->kesimpulanBB }}</td>
                <td>{{ $row->periksa_tinggi_badan }} Cm</td>
                <td>{{ $row->kesimpulanTinggiBadan }}</td>
                <td>{{ $row->kesimpulanGizi }}</td>
                <td>{{ $row->periksa_lingkar_kepala }}</td>
                <td>{{ $row->kesimpulanLK }}</td>
                <td>{{ $row->periksa_lila }}</td>
                <td>{{ $row->kesimpulanLila }}</td>

                {{-- *** Skrining TBC --}}
                <td>{{ Option::getYaAtauTidak($row->is_batuk) }}</td>
                <td>{{ Option::getYaAtauTidak($row->is_demam) }}</td>
                <td>{{ Option::getYaAtauTidak($row->is_bb_tidak_naik_turun) }}</td>
                <td>{{ Option::getYaAtauTidak($row->is_kontak_pasien_tbc) }}</td>

                {{-- *** Balita Mendapatkan --}}
                <td>{{ Option::getYaAtauTidak($row->is_asi_ekslusif) }}</td>
                <td>{{ Option::getYaAtauTidak($row->is_mpasi_sesuai) }}</td>
                <td>
                    {{ Option::getYaAtauTidak($row->is_imunisasi_lengkap) }}<br />
                    @if ($row->is_imunisasi_lengkap)
                        {{ $row->jenis_imunisasi }}
                    @endif
                </td>
                <td>{{ Option::getYaAtauTidak($row->is_beri_vit_a) }}</td>
                <td>{{ Option::getYaAtauTidak($row->is_beri_obat_cacing) }}</td>
                <td>{{ Option::getYaAtauTidak($row->is_beri_obat_cacing) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
