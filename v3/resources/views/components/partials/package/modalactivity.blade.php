<div wire:ignore.self class="modal fade" id="modalActivity" tabindex="-1" aria-labelledby="modalActivity" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalActivity">Daftar Activity</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
            </div>
            <div class="modal-body m-0">
                <ul class="list-group">
                    @foreach ($dataActivity as $data)
                        <li class="list-group-item" role="button" wire:click='addActivity({{ $data }})' data-coreui-dismiss="modal">{{ $data->namaactivity }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer d-block">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click='addGambar'>Simpan</button>
            </div>
        </div>
    </div>
</div>
