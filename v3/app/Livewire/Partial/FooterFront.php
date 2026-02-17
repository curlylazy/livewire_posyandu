<?php

namespace App\Livewire\Partial;

use App\Models\KategoriProdukHukumModel;
use App\Models\PackageModel;
use App\Models\PelangganModel;
use App\Models\ProdukModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class FooterFront extends Component
{

    public function mount()
    {

    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <footer id="footer" class="footer dark-background">
                    <div class="container footer-top">
                        <div class="row gy-4">
                            <div class="col-lg-3 col-md-6 footer-about">
                                <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                                    <span class="sitename">{{ config('app.webname') }}</span>
                                </a>
                                <div class="footer-contact pt-3">
                                    <p>{{ config('app.alamat') }}</p>
                                    <p>{{ config('app.alamat2') }}</p>
                                    <p class="mt-3"><strong>Whatsapp:</strong> <span>{{ config('app.wa') }}</span></p>
                                    <p><strong>Email:</strong> <span>{{ config('app.email') }}</span></p>
                                </div>
                                <div class="social-links d-flex mt-4">
                                    <a href="{{ config('app.ig') }}"><i class="bi bi-instagram"></i></a>
                                    <a href="{{ config('app.youtube') }}"><i class="bi bi-youtube"></i></a>
                                    <a href="{{ config('app.wa') }}"><i class="bi bi-whatsapp"></i></a>
                                    <a href="{{ config('app.email') }}"><i class="bi bi-envelope-open-heart-fill"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 footer-links">
                                <h4>{{ config('app.webname') }} Links</h4>
                                <ul>
                                    <li><i class="bi bi-chevron-right"></i> <a href="{{ url('') }}">Home</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="{{ url('packages') }}">Packages</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="{{ url('activities') }}">Activities</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="{{ url('galery') }}">Galery</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="{{ url('video') }}">Video</a></li>
                                    <li><i class="bi bi-chevron-right"></i> <a href="{{ url('contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="container copyright text-center mt-4">
                        <p>© <span>Copyright</span> <strong class="px-1 sitename">Dewi</strong> <span>All Rights Reserved</span></p>
                        <div class="credits">
                            <!-- All the links in the footer should remain intact. -->
                            <!-- You can delete the links only if you've purchased the pro version. -->
                            <!-- Licensing information: https://bootstrapmade.com/license/ -->
                            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon
                        </div>
                    </div>
                </footer>
            </div>
        HTML;
    }
}
