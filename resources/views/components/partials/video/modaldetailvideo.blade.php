<div wire:ignore.self class="modal fade" id="modalDetailVideo" tabindex="-1" aria-labelledby="modalDetailVideo" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailVideo">Detail Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-toggle="modal"></button>
            </div>
            <div class="modal-body m-0">
                <div class="ratio ratio-16x9 mb-4">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $detailVideo->videoID ?? '' }}" allowfullscreen></iframe>
                </div>
                <span class="fw-bolder">{{ date('d F Y', strtotime($detailVideo->publishedAt ?? '')) }}</span><br />
                <h5 class="card-title">{{ $detailVideo->title ?? '' }}</h5>
                <p class="card-text">{!! $detailVideo->description ?? '' !!}</p>
            </div>
        </div>
    </div>
</div>
