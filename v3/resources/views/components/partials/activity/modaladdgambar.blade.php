<div wire:ignore.self class="modal fade" id="modalActivityAddGambar" tabindex="-1" aria-labelledby="modalActivityAddGambar" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalActivityAddGambar">Tambah Gambar</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
            </div>
            <div class="modal-body m-0">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="form.gambarGaleriActivityFile" class="form-label">Gambar Produk</label>
                        <input class="form-control" type="file" id="form.gambarGaleriActivityFile" wire:model='form.gambarGaleriActivityFile'>
                        @if ($form->gambarGaleriActivityFile)
                            <img src="{{ $form->gambarGaleriActivityFile->temporaryUrl() }}" style="width: 100%; height: 400px; object-fit: contain;" class="rounded mt-2">
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer d-block">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click='addGambar'>Simpan</button>
            </div>
        </div>
    </div>
</div>
