<div>

    @assets
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endassets

    @script
        <script>
            document.addEventListener('livewire:navigated', (event) => {
                const ctx = document.getElementById('pemeriksaanChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Pemeriksaan Bayi', 'Pemeriksaan Bumil', 'Pemeriksaan Nifas'],
                        datasets: [
                            {
                                label: 'Pemeriksaan Bayi', // Label untuk dataset pertama
                                data: @json($dataChart->valuesPeriksaBayi), // Data untuk dataset pertama
                                backgroundColor: 'rgba(255, 99, 132, 0.6)', // Warna latar belakang
                                borderColor: 'rgba(255, 99, 132, 1)', // Warna border
                                borderWidth: 1
                            },
                            {
                                label: 'Pemeriksann Bumil', // Label untuk dataset kedua
                                data: @json($dataChart->valuesPeriksaBumil), // Data untuk dataset kedua
                                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Warna latar belakang yang berbeda
                                borderColor: 'rgba(54, 162, 235, 1)', // Warna border yang berbeda
                                borderWidth: 1
                            },
                            {
                                label: 'Pemeriksaan Nifas', // Label untuk dataset kedua
                                data: @json($dataChart->valuesPeriksaNifas), // Data untuk dataset kedua
                                backgroundColor: 'rgba(54, 162, 235, 0.6)', // Warna latar belakang yang berbeda
                                borderColor: 'rgba(54, 162, 235, 1)', // Warna border yang berbeda
                                borderWidth: 1
                            }
                        ]
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


        </script>
    @endscript

    <livewire:partial.modal-year-month />

    <x-partials.loader />
    <x-partials.flashmsg />
    <x-slot:bc>
        <li class="breadcrumb-item"><a href="{{ url('/admin') }}" class="text-decoration-none"><span>Home</span></a></li>
        <li class="breadcrumb-item active"><span>{{ $pageTitle }}</span></li>
    </x-slot>


    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $pageTitle }}</h5>

            <div class="mb-2">
                <a class="btn btn-outline-secondary" type="button" href="{{ url('/admin') }}" wire:navigate><i class="fas fa-arrow-left"></i></a>
                <a class="btn btn-outline-secondary" type="button" wire:click='readData'><i class="fas fa-search"></i> Cari</a>
            </div>

            <form autocomplete="off">
                <div class="row g-2 mb-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <select class="form-select" id="tahun" wire:model='tahun' aria-label="tahun pemeriksaan">
                                <option value="">Pilih Tahun</option>
                                @foreach (Option::tahun() as $data)
                                    <option value="{{ $data }}">{{ $data }}</option>
                                @endforeach
                            </select>
                            <label for="tahun">Tahun</label>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-12" id="pemeriksaanChart">
                </div>
            </div>

        </div>
    </div>

</div>
