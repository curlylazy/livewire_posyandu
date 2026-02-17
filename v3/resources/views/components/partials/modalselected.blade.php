<div class="modal fade" id="modalPilihData" tabindex="-1" aria-labelledby="modalPilihDataLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h1 class="fs-6 mb-1 text-center">{{ $pageTitle }}</h1>
                <h1 class="fs-3 mt-0 text-center fw-bolder">{{ $selectedNama }}</h1>
                <hr />
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
