<?php

use App\Lib\MetaTag;
use App\Models\BlogModel;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $pageName = 'berita';
    public string $pageTitle = 'Berita';

    #[Url]
    public string $katakunci = '';

    public function mount(): void {}

    public function readData()
    {
        return BlogModel::search($this->katakunci)->latest()->paginate(12);
    }

    public function render()
    {
        $mt = new MetaTag;
        $mt->title = $this->pageTitle.' | '.config('app.webname');
        $mt->url = url("/$this->pageName");
        $mt->genMetaTag();

        return $this->view([
            'dataBerita' => $this->readData()
        ])
        ->layout('layouts.front');
    }
};

?>

{{-- *** Views --}}
@php $coverUrl = asset('static/cover3.jpg'); @endphp
<div>
    {{-- Hero Section --}}
    <section class="page-title dark-background" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("static/cover3.jpg") }}') center/cover no-repeat; padding: 80px 0 60px;">
        <div class="container text-center" wire:ignore>
            <h1 class="text-white fw-bold display-5" data-aos="fade-up">{{ $pageTitle }}</h1>
            <p class="text-white-50 mt-2" data-aos="fade-up" data-aos-delay="100">
                Informasi terbaru seputar kegiatan dan layanan {{ config('app.webname') }}
            </p>
        </div>
    </section>

    {{-- Berita Section --}}
    <section class="section light-background">
        <div class="container">

            {{-- Search Bar --}}
            <div class="row justify-content-center mb-4" data-aos="fade-up" wire:ignore>
                <div class="col-12 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input
                            type="text"
                            class="form-control border-start-0 ps-0"
                            placeholder="Cari berita..."
                            wire:model.live.debounce.400ms="katakunci"
                        >
                    </div>
                </div>
            </div>

            {{-- Empty State --}}
            @if ($dataBerita->isEmpty())
                <div class="text-center py-5" data-aos="fade-up" wire:ignore>
                    <i class="bi bi-newspaper fs-1 text-muted"></i>
                    <p class="mt-3 text-muted">Belum ada berita yang tersedia.</p>
                </div>
            @endif

            {{-- Card Grid --}}
            <div class="row gy-4">
                @foreach ($dataBerita as $row)
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" wire:ignore>
                        <a href="{{ url("/berita/$row->seoblog") }}" class="text-decoration-none">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; transition: transform .2s, box-shadow .2s;">
                                {{-- Thumbnail --}}
                                <div class="position-relative">
                                    <img
                                        src="{{ ImageUtils::getImageThumb($row->gambarblog) }}"
                                        alt="{{ $row->judul }}"
                                        class="card-img-top"
                                        style="height: 210px; object-fit: cover;"
                                    >
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge text-bg-primary px-2 py-1" style="font-size: .7rem;">
                                            <i class="bi bi-calendar3 me-1"></i>{{ IDateTime::formatDate($row->created_at) }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Body --}}
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title fw-semibold text-dark" style="line-height: 1.4;">
                                        {{ Str::limit($row->judul, 80) }}
                                    </h6>
                                    <p class="card-text text-muted small mt-1 mb-0" style="line-height: 1.6;">
                                        {{ Str::limit(strip_tags($row->isi), 120) }}
                                    </p>
                                    <div class="mt-3 pt-2 border-top">
                                        <span class="small text-primary fw-semibold">
                                            Baca selengkapnya <i class="bi bi-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if ($dataBerita->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $dataBerita->links() }}
                </div>
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
