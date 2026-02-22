<?php

use App\Lib\MetaTag;
use App\Models\PosyanduModel;
use App\Models\PasienModel;
use Livewire\Component;
use Carbon\Carbon;

new class extends Component
{
    public PosyanduModel $posyandu;
    public string $pageTitle = 'Detail Posyandu';

    public function mount(string $id): void
    {
        $this->posyandu = PosyanduModel::where('seoposyandu', $id)->firstOrFail();
        $this->pageTitle = $this->posyandu->namaposyandu;
    }

    public function getDemographics()
    {
        $dateNow = Carbon::today()->toDateString();
        return PasienModel::where('kodeposyandu', $this->posyandu->kodeposyandu)
            ->selectRaw("
                COUNT(CASE WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, '$dateNow') <= 2 THEN 1 END) as bayi_count,
                COUNT(CASE WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, '$dateNow') BETWEEN 3 AND 12 THEN 1 END) as anak_count,
                COUNT(CASE WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, '$dateNow') BETWEEN 13 AND 17 THEN 1 END) as remaja_count,
                COUNT(CASE WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, '$dateNow') BETWEEN 18 AND 59 THEN 1 END) as dewasa_count,
                COUNT(CASE WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, '$dateNow') >= 60 THEN 1 END) as lansia_count,
                COUNT(*) as total_count
            ")
            ->first();
    }

    public function render()
    {
        $mt = new MetaTag;
        $mt->title = $this->pageTitle.' | '.config('app.webname');
        $mt->url = url("/posyandu/{$this->posyandu->seoposyandu}");
        $mt->genMetaTag();

        return $this->view([
            'demographics' => $this->getDemographics()
        ])
        ->layout('layouts.front');
    }
};

?>

{{-- *** Views --}}
<div>
    {{-- Hero Section --}}
    <section class="page-title dark-background" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("static/cover3.jpg") }}') center/cover no-repeat; padding: 80px 0 60px;">
        <div class="container text-center">
            <h1 class="text-white fw-bold display-5" data-aos="fade-up">{{ $posyandu->namaposyandu }}</h1>
            <nav class="mt-3" data-aos="fade-up" data-aos-delay="100">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/posyandu') }}" class="text-white-50">Posyandu</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- Detail Section --}}
    <section class="section light-background pt-5 pb-5">
        <div class="container">
            <div class="row gy-4">
                {{-- Left Side: Info & Description --}}
                <div class="col-lg-8" data-aos="fade-up">
                    <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 15px;">
                        <h3 class="fw-bold text-primary mb-4">Informasi Posyandu</h3>
                        <div class="mb-4">
                            <h5 class="fw-semibold"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Alamat</h5>
                            <p class="text-muted ms-4">{{ $posyandu->alamatposyandu ?: 'Alamat belum tersedia.' }}</p>
                        </div>
                        <div>
                            <h5 class="fw-semibold"><i class="bi bi-info-circle-fill text-info me-2"></i>Tentang Posyandu</h5>
                            <div class="text-muted ms-4 content-text" style="line-height: 1.8;">
                                {!! $posyandu->isi ?: 'Informasi detail belum tersedia.' !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Side: Statistics --}}
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 15px;">
                        <h3 class="fw-bold text-primary mb-4">Statistik Penduduk</h3>
                        
                        <div class="stats-grid">
                            {{-- Total --}}
                            <div class="p-3 mb-3 bg-primary bg-opacity-10 border-start border-primary border-4 rounded">
                                <span class="text-muted small d-block">Total Penduduk</span>
                                <span class="h4 fw-bold text-primary mb-0">{{ Number::format($demographics->total_count) }}</span>
                            </div>

                            <div class="row g-3">
                                {{-- Bayi --}}
                                <div class="col-6">
                                    <div class="p-3 border rounded text-center h-100">
                                        <i class="bi bi-person-heart fs-4 text-pink"></i>
                                        <span class="d-block text-muted small mt-1">Bayi</span>
                                        <span class="h5 fw-bold mb-0">{{ Number::format($demographics->bayi_count) }}</span>
                                    </div>
                                </div>
                                {{-- Anak --}}
                                <div class="col-6">
                                    <div class="p-3 border rounded text-center h-100">
                                        <i class="bi bi-person-arms-up fs-4 text-success"></i>
                                        <span class="d-block text-muted small mt-1">Anak-anak</span>
                                        <span class="h5 fw-bold mb-0">{{ Number::format($demographics->anak_count) }}</span>
                                    </div>
                                </div>
                                {{-- Remaja --}}
                                <div class="col-6">
                                    <div class="p-3 border rounded text-center h-100">
                                        <i class="bi bi-person-fill fs-4 text-warning"></i>
                                        <span class="d-block text-muted small mt-1">Remaja</span>
                                        <span class="h5 fw-bold mb-0">{{ Number::format($demographics->remaja_count) }}</span>
                                    </div>
                                </div>
                                {{-- Dewasa --}}
                                <div class="col-6">
                                    <div class="p-3 border rounded text-center h-100">
                                        <i class="bi bi-people-fill fs-4 text-info"></i>
                                        <span class="d-block text-muted small mt-1">Dewasa</span>
                                        <span class="h5 fw-bold mb-0">{{ Number::format($demographics->dewasa_count) }}</span>
                                    </div>
                                </div>
                                {{-- Lansia --}}
                                <div class="col-12">
                                    <div class="p-3 border rounded text-center h-100">
                                        <i class="bi bi-person-standing fs-4 text-secondary"></i>
                                        <span class="d-block text-muted small mt-1">Lansia</span>
                                        <span class="h5 fw-bold mb-0">{{ Number::format($demographics->lansia_count) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <p class="text-muted small mb-0"><i class="bi bi-clock-history me-1"></i> Data diperbarui secara real-time.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    .text-pink { color: #e83e8c; }
    .content-text p { margin-bottom: 1.5rem; }
    .content-text img { max-width: 100%; height: auto; border-radius: 10px; margin-bottom: 1.5rem; }
    .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.5); }
</style>
