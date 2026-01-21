<div>

    @assets
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endassets

    @script
        <script>
            document.addEventListener('livewire:navigated', (event) => {
                // *** load chart
                @php
                    $arrLabel = $dataJumlahPerKategori->pluck('kategori');
                    $arrValue = $dataJumlahPerKategori->pluck('total');
                @endphp

                const ctx = document.getElementById('myChart');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($arrLabel),
                        datasets: [{
                            label: "# Jumlah",
                            data: @json($arrValue),
                            borderWidth: 1,
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });

            // *** update chart agar bisa terupdate
            $wire.on('update-chart', (e) => {
                myChart.data.labels = e.labels;
                myChart.data.datasets[0].data = e.data;
                myChart.update();
            });
        </script>
    @endscript

    <x-partials.loader />

    {{-- <div class="border border-3">
        <div class="d-flex flex-column justify-content-center align-items-center gap-2" style="height: 150px;">
            <div>Halo Semuanya</div>
            <div>Aman ?</div>
        </div>
    </div> --}}

    <div class="row g-2 mb-3">
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Pasien</x-slot>
            <x-slot:icon>pregnancy</x-slot>
            <x-slot:url>{{ url("admin/pasien") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>User</x-slot>
            <x-slot:icon>person</x-slot>
            <x-slot:url>{{ url("admin/user") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Posyandu</x-slot>
            <x-slot:icon>family_home</x-slot>
            <x-slot:url>{{ url("admin/posyandu") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Pemeriksaan Bayi</x-slot>
            <x-slot:icon>stethoscope</x-slot>
            <x-slot:url>{{ url("admin/pemeriksaan/bayi") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Pemeriksaan Ibu Hamil</x-slot>
            <x-slot:icon>stethoscope</x-slot>
            <x-slot:url>{{ url("admin/pemeriksaan/bumil") }}</x-slot>
        </x-partials.dashboard.quickmenu>
        <x-partials.dashboard.quickmenu>
            <x-slot:title>Pemeriksaan Nifas</x-slot>
            <x-slot:icon>stethoscope</x-slot>
            <x-slot:url>{{ url("admin/pemeriksaan/nifas") }}</x-slot>
        </x-partials.dashboard.quickmenu>
    </div>

    <div class="row g-1 g-lg-3">
        <x-partials.dashboard.infomenu>
            <x-slot:title>Pasien</x-slot>
            <x-slot:icon>pregnancy</x-slot>
            <x-slot:info>{{ $jmlPasien }} Total Pasien</x-slot>
        </x-partials.dashboard.infomenu>
        <x-partials.dashboard.infomenu>
            <x-slot:title>Bayi</x-slot>
            <x-slot:icon>breastfeeding</x-slot>
            <x-slot:info>{{ $jmlBayi }} Total Bayi</x-slot>
        </x-partials.dashboard.infomenu>
        <x-partials.dashboard.infomenu>
            <x-slot:title>Pemiksaan Tahun {{ date('Y') }}</x-slot>
            <x-slot:icon>stethoscope</x-slot>
            <x-slot:info>{{ $jmlPeriksaTahunIni }} Pemeriksaan</x-slot>
        </x-partials.dashboard.infomenu>
        <x-partials.dashboard.infomenu>
            <x-slot:title>Pemiksaan Bulan {{ Carbon\Carbon::now()->translatedFormat('F') }}</x-slot>
            <x-slot:icon>stethoscope</x-slot>
            <x-slot:info>{{ $jmlPeriksaBulanIni }} Pemeriksaan</x-slot>
        </x-partials.dashboard.infomenu>
    </div>

    <div class="row pt-3">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="h5">Grafik Penduduk per Tahun {{ date('Y') }}</div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="h5">Data Penduduk per Tahun {{ date('Y') }}</div>
                    <div class="d-flex">
                        <div class="flex-grow-1">Remaja</div>
                        <div class="fw-bold">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
