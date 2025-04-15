<div>
    @if(count($dataRows) == 0)
        <div class="d-flex flex-column text-center">
            <div class="mb-3"><img src="{{ asset('static/notfound.png') }}" style="width: 350px;" /></div>
            <div class="h5">Maaf Data Tidak Ditemukan</div>
        </div>
    @else
        {{ $slot }}
    @endif
</div>
