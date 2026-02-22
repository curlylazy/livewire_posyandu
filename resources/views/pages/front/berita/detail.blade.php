<?php

use App\Lib\MetaTag;
use App\Models\BlogModel;
use App\Lib\ImageUtils;
use App\Lib\IDateTime;
use Livewire\Component;
use Illuminate\Support\Str;

new class extends Component
{
    public string $pageName = 'berita';
    public $slug = "";

    public function mount($id): void
    {
        $this->slug = $id;
    }

    public function readData()
    {
        $data = BlogModel::joinTable()->searchBySeo($this->slug)->first();
        return $data;
    }

    public function readBlogLainnya()
    {
        return BlogModel::where('seoblog', '!=', $this->slug)
            ->latest()
            ->limit(4)
            ->get();
    }

    public function render()
    {
        $data = $this->readData();

        $mt = new MetaTag;
        $mt->title = $data->judul . ' | ' . config('app.webname');
        $mt->url = url("/$this->pageName/$this->slug");
        $mt->genMetaTag();

        return $this->view([
            'dataBlog' => $data,
            'dataBlogLainnya' => $this->readBlogLainnya()
        ])
        ->layout('layouts.front');
    }
};

?>

<div>
    {{-- Hero Section with Cover Image --}}
    <section class="page-title dark-background" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ ImageUtils::getImage($dataBlog->gambarblog) }}') center/cover no-repeat; padding: 120px 0 80px;">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="text-white fw-bold display-4 mb-3">{{ $dataBlog->judul }}</h1>
                    <div class="d-flex justify-content-center align-items-center gap-3 text-white-50 small">
                        <span><i class="bi bi-person me-1"></i> {{ $dataBlog->author ?? 'Admin' }}</span>
                        <span><i class="bi bi-calendar3 me-1"></i> {{ IDateTime::formatDate($dataBlog->tgl_blog) }}</span>
                    </div>
                </div>
                <nav aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/berita') }}" class="text-white-50 text-decoration-none">Berita</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    {{-- Main Content Section --}}
    <section class="section light-background pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <article class="bg-white p-4 p-md-5 shadow-sm rounded-4" data-aos="fade-up">
                        {{-- Featured Image inside --}}
                        <div class="mb-4 text-center">
                            <img src="{{ ImageUtils::getImage($dataBlog->gambarblog) }}"
                                 alt="{{ $dataBlog->judul }}"
                                 class="img-fluid rounded-4 shadow-sm"
                                 style="max-height: 500px; width: 100%; object-fit: cover;">
                        </div>

                        {{-- Article Content --}}
                        <div class="article-content text-dark" style="line-height: 1.8; font-size: 1.1rem;">
                            {!! $dataBlog->isi !!}
                        </div>

                        {{-- Share Section --}}
                        <div class="mt-5 pt-4 border-top d-flex align-items-center justify-content-between">
                            <span class="fw-semibold text-muted">Bagikan berita ini:</span>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-circle" style="width: 36px; height: 36px; padding: 0; line-height: 34px; text-align: center;">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($dataBlog->judul . ' ' . url()->current()) }}" target="_blank" class="btn btn-outline-success btn-sm rounded-circle" style="width: 36px; height: 36px; padding: 0; line-height: 34px; text-align: center;">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($dataBlog->judul) }}" target="_blank" class="btn btn-outline-info btn-sm rounded-circle" style="width: 36px; height: 36px; padding: 0; line-height: 34px; text-align: center;">
                                    <i class="bi bi-twitter-x"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    {{-- Related News Section --}}
    @if($dataBlogLainnya->isNotEmpty())
        <section class="section py-5">
            <div class="container">
                <div class="section-title text-center mb-5" data-aos="fade-up">
                    <h2 class="fw-bold">Berita Lainnya</h2>
                    <div class="mx-auto" style="width: 60px; height: 4px; background: var(--accent-color, #0d6efd); border-radius: 2px;"></div>
                </div>

                <div class="row gy-4">
                    @foreach($dataBlogLainnya as $row)
                    <div class="col-12 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <a href="{{ url("/berita/$row->seoblog") }}" class="text-decoration-none group">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-all hover-up">
                                <div class="position-relative">
                                    <img src="{{ ImageUtils::getImageThumb($row->gambarblog) }}"
                                        alt="{{ $row->judul }}"
                                        class="card-img-top"
                                        style="height: 180px; object-fit: cover;">
                                    <div class="position-absolute bottom-0 start-0 m-2">
                                        <span class="badge bg-white text-primary rounded-pill px-2 py-1 shadow-sm" style="font-size: 0.7rem;">
                                            {{ IDateTime::formatDate($row->tgl_blog) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title fw-bold text-dark mb-2 text-truncate-2" style="font-size: 0.95rem; line-height: 1.5;">
                                        {{ $row->judul }}
                                    </h6>
                                    <p class="card-text text-muted small mb-0 text-truncate-3">
                                        {{ Str::limit(strip_tags($row->isi), 80) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>

<style>
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .text-truncate-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .hover-up {
        transition: all 0.3s ease;
    }
    .hover-up:hover {
        transform: translateY(-8px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 1.5rem 0;
    }
</style>
