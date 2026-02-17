<div class="col-4 col-md-3 col-lg-2">
    <div class="card">
        <a href="{{ $url }}" class="text-decoration-none text-dark" wire:navigate>
            <div class="card-body">
                <div class="d-flex flex-column justify-content-center text-center align-items-center" style="height: 100px;">
                    <span class="material-symbols-outlined mb-1 fs-1">{{ $icon }}</span>
                    <div class="h6 fw-bold">{{ $title }}</div>
                </div>
            </div>
        </a>
    </div>
</div>
