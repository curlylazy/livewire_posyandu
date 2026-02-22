<?php

use App\Lib\MetaTag;
use App\Models\BlogModel;
use App\Models\PosyanduModel;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $pageName = 'posyandu';
    public string $pageTitle = 'Posyandu';

    #[Url]
    public string $katakunci = '';

    public function mount(): void {}

    public function readData()
    {
        return PosyanduModel::withCount('pasien')->search($this->katakunci)->latest()->paginate(12);
    }

    public function render()
    {
        $mt = new MetaTag;
        $mt->title = $this->pageTitle.' | '.config('app.webname');
        $mt->url = url("/$this->pageName");
        $mt->genMetaTag();

        return $this->view([
            'dataPosyandu' => $this->readData()
        ])
        ->layout('layouts.front');
    }
};

?>

{{-- *** Views --}}
<div>
    {{-- Hero Section --}}
    <section class="page-title dark-background" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("static/cover3.jpg") }}') center/cover no-repeat; padding: 80px 0 60px;">
        <div class="container text-center" wire:ignore>
            <h1 class="text-white fw-bold display-5" data-aos="fade-up">{{ $pageTitle }}</h1>
            <p class="text-white-50 mt-2" data-aos="fade-up" data-aos-delay="100">
                Daftar Posyandu {{ config('app.webname') }}
            </p>
        </div>
    </section>

    {{-- Posyandu Section --}}
    <section class="section light-background">
        <div class="container">

            {{-- Search Bar --}}
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input
                            type="text"
                            class="form-control border-start-0 ps-0"
                            placeholder="Cari posyandu..."
                            wire:model.live.debounce.400ms="katakunci"
                        >
                    </div>
                </div>
            </div>

            {{-- Empty State --}}
            @if ($dataPosyandu->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-newspaper fs-1 text-muted"></i>
                    <p class="mt-3 text-muted">Belum ada posyandu yang tersedia.</p>
                </div>
            @endif

            {{-- Card Grid --}}
            <div class="row gy-4">
                @foreach ($dataPosyandu as $row)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; transition: transform .2s, box-shadow .2s;">
                            {{-- Body --}}
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-semibold text-dark" style="line-height: 1.4;">
                                    {{ $row->namaposyandu }}
                                </h5>
                                <div class="d-flex">
                                    <div class="flex-grow-1"><i class="bi bi-people"></i> Penduduk</div>
                                    <div class="fw-bold">{{ Number::format($row->pasien_count) }}</div>
                                </div>
                                <div class="mt-3 pt-2 border-top">
                                    <a href="{{ url("/posyandu/$row->seoposyandu") }}" class="small text-primary fw-semibold">
                                        Info Selengkapnya <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if ($dataPosyandu->hasPages())
                <div class="mt-5">{{ $dataPosyandu->links() }}</div>
            @endif

        </div>
    </section>
</div>

<style>
    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 .75rem 1.5rem rgba(0,0,0,.12) !important;
    }
</style>
