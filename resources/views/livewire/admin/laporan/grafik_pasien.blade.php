<div>

    @assets
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endassets

    @script
        <script>
            document.addEventListener('livewire:navigated', (event) => {
                const ctx = document.getElementById('myChart');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($dataChart->labels),
                        datasets: [{
                            label: 'Kategori Pasien', // Label untuk dataset pertama
                            data: @json($dataChart->values), // Data untuk dataset pertama
                            backgroundColor: 'rgba(255, 99, 132, 0.6)', // Warna latar belakang
                            borderColor: 'rgba(255, 99, 132, 1)', // Warna border
                            borderWidth: 1
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


        </script>
    @endscript

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

            <div class="row">
                <div class="col-12">
                    <canvas id="myChart"></canvas>
                </div>
            </div>

        </div>
    </div>

</div>
