<div>

    @assets

    <style>
        .maps iframe {
            width:100%;
            height:500px;
        }
    </style>

    @endassets

    <x-partials.loader />

    <div class="page-title dark-background">
        <div class="container position-relative">
            <h1>{{ config('app.webname') }} Contact</h1>
            <p>Your Next Destination Awaits – Contact Us Today!</p>
        </div>
    </div>

    <!-- Starter Section Section -->
    <section id="starter-section" class="contact section light-background">

        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100" wire:ignore.self>

            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="row gy-4">
                        <div class="col-lg-12">
                            <div class="info-item d-flex flex-column justify-content-center align-items-center aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt"></i>
                                <h3>Address</h3>
                                <p class="text-center">{{ config('app.alamat') }}<br />
                                    {{ config('app.alamat2') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item d-flex flex-column justify-content-center align-items-center aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone"></i>
                                <h3>Whatsapp</h3>
                                <p><a href="https://wa.me/{{ config('app.wa') }}">{{ config('app.wa') }}</a></p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item d-flex flex-column justify-content-center align-items-center aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope"></i>
                                <h3>Email Us</h3>
                                <p><a href="mailto::{{ config('app.email') }}">{{ config('app.email') }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 maps">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3943.7964721545277!2d115.20346540000001!3d-8.7108682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd241463d8b0fb9%3A0x90e97fe0be286ab9!2sBest%20Bali%20Konveksi!5e0!3m2!1sid!2sid!4v1735891905636!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="width: 100%;"></iframe>
                </div>

            </div>

        </div>

        {{-- <div class="container mt-2" data-aos="fade-up">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex flex-column">
                        <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Alamat</h3>
                                <p>
                                    {{ config('app.alamat') }}<br />
                                    {{ config('app.alamat2') }}
                                </p>
                            </div>
                        </div>
                        <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                            <i class="fab fa-whatsapp flex-shrink-0"></i>
                            <div>
                                <a href="https://wa.me/{{ config('app.wa') }}"><h3>Whatsapp</h3></a>
                                <p>{{ config('app.wa') }}</p>
                            </div>
                        </div>
                        <div class="info-item d-flex aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                            <i class="fas fa-envelope flex-shrink-0"></i>
                            <div>
                                <a href="mailto:{{ config('app.email') }}"><h3>Email</h3></a>
                                <p>{{ config('app.email') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 maps">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3943.7964721545277!2d115.20346540000001!3d-8.7108682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd241463d8b0fb9%3A0x90e97fe0be286ab9!2sBest%20Bali%20Konveksi!5e0!3m2!1sid!2sid!4v1735891905636!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="width: 100%;"></iframe>
                </div>
            </div>
        </div> --}}
    </section>

</div>
