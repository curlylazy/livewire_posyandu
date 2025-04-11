<table>
    <thead>
        <tr>
            <th style="font-weight: bold; font-size: 15pt; width: 100px;">{{ $page_title }}</th>
        </tr>
        <tr>
            <th style="font-weight: bold; font-size: 12pt; width: 100px;">Tahun : {{ $tahun }}</th>
        </tr>
        <tr>
            <th style="font-weight: bold; font-size: 12pt; width: 100px;">Bulan : {{ $bulan }}</th>
        </tr>
        <tr>

        </tr>
    </thead>

    @if($kategori_periksa == "nifas")

    @else
        <thead>
            <tr>
                <th style="font-weight: bold; font-size: 12pt; text-align: center" colspan="9">DATA</th>
                <th style="font-weight: bold; font-size: 12pt; text-align: center" colspan="5">Hasil Penimbangan/Pengukuran/Pemeriksaan</th>
            </tr>
        </thead>
        <thead>
            <tr>
                {{-- DATA --}}
                <th style="font-weight: bold;">No</th>
                <th style="font-weight: bold; width: 200px;">NIK</th>
                <th style="font-weight: bold; width: 250px;">Nama Ibu</th>
                <th style="font-weight: bold; width: 150px;">Tanggal Lahir</th>
                <th style="font-weight: bold; width: 150px;">Umur</th>
                <th style="font-weight: bold; width: 250px;">Alamat</th>
                <th style="font-weight: bold; width: 200px;">No Hp</th>
                <th style="font-weight: bold; width: 150px;">Hamil Ke</th>
                <th style="font-weight: bold; width: 150px;">Minggu Ke</th>

                {{-- *** Hasil Penimbangan/Pengukuran/Pemeriksaan --}}
                <th style="font-weight: bold; width: 150px;">Berat Badan (Kg)</th>
                <th style="font-weight: bold; width: 200px;">Sesuai Kurva Buku KIA</th>
                <th style="font-weight: bold; width: 150px;">LILA (cm)</th>
                <th style="font-weight: bold; width: 150px;">Tekanan Darah</th>
                <th style="font-weight: bold; width: 200px;">Sesuai Kurva Buku KIA</th>

                {{-- *** Skrining TBC --}}
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
                </tr>

                @php
                    $no++;
                @endphp
            @endforeach
        </tbody>
    @endif


</table>
