<?php

namespace App\Livewire\Partial;

use App\Models\AparaturModel;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AparaturDesa extends Component
{

    public function mount()
    {

    }

    #[Computed()]
    public function dataAparatur()
    {
        $data = AparaturModel::get();
        return $data;
    }

    public function render()
    {
        return <<<'HTML'
            <div>

                @assets
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
                    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
                @endassets

                @script
                    <script>
                        document.addEventListener('livewire:navigated', () => {
                            var swiperAparatur = new Swiper(".swiper_aparatur", {
                                pagination: {
                                    el: ".swiper-pagination",
                                    clickable: true,
                                },
                                speed: 1000,
                                autoplay:
                                {
                                    delay: 2000,
                                },
                                loop: true,
                                breakpoints: {
                                    640: {
                                        slidesPerView: 1,
                                        spaceBetween: 20
                                    },
                                    1024: {
                                        slidesPerView: 5,
                                        spaceBetween: 20
                                    }
                                }
                            });
                        });
                    </script>
                @endscript

                <section id="aparatur" class="aparatur section" data-aos="fade-up" data-aos-delay="200">
                    <div class="container section-title">
                        <h2>Aparatur {{ config('app.webname') }}</h2>
                        <p>Aparatur {{ config('app.webname') }}</p>
                    </div>
                    <div class="container">
                        <div class="swiper swiper_aparatur">
                            <div class="swiper-wrapper mb-5">
                                @foreach ($this->dataAparatur as $data)
                                    <div class="swiper-slide">
                                        <div class="card" style="width: 100%; border:none;">
                                            <a href="{{ ImageUtils::getImage($data->gambaraparatur) }}" class="glightbox" data-glightbox="title: {{ $data->namaaparatur }}; description: {{ $data->jabatan }}">
                                                <img src="{{ ImageUtils::getImageThumb($data->gambaraparatur) }}" class="card-img-top" alt="{{ $data->namaaparatur }}" style="height: 300px; object-fit: cover; border-radius: 10px;">
                                            </a>
                                            <div class="card-body text-center">
                                                <h5 class="card-title">{{ $data->namaaparatur }}</h5>
                                                <p class="card-text">{{ $data->jabatan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </section>
            </div>
        HTML;
    }
}
