<div class="col-lg-4 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
    <div class="service-item position-relative">
        <div class="icon">
            <i class="{{ $icon }}" style="color: {{ $color ?? '#0dcaf0' }};"></i>
        </div>
        <a href="{{ $url ?? '#' }}" class="stretched-link">
            <h3>{{ $judul }}</h3>
        </a>
        <p>{{ $keterangan }}</p>
    </div>
</div>
