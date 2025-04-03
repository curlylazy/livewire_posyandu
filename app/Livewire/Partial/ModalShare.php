<?php

namespace App\Livewire\Partial;

use App\Lib\FilterString;
use App\Models\PesanHDModel;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class ModalShare extends Component
{
    public $namaPelanggan = "";
    public $wa = "";
    public $email = "";
    public $encInv = "";
    public $pesanWa = "";
    public $isValidNumber = true;
    public $dataPesanHd;

    public $selectedKode = "";
    public $selectedNama = "";
    public $selectedPhone = "";
    public $selectedEmail = "";
    public $selectedUrl = "";
    public $selectedSubject = "";
    public $selectedTitle = "";
    public $selectedTitleWithUrl = "";

    public function mount()
    {
        // $this->namaPelanggan = $this->dataPesanHd->namapelanggan ?? "";
        // $this->wa = $this->dataPesanHd->nohp ?? "";
        // $this->email = $this->dataPesanHd->email ?? "";
        // $this->encInv = Crypt::encrypt($this->dataPesanHd->noinvoice);

        // $this->pesanWa = urlencode("[Invoice No. #".Str::replace('INVOICE', '', $this->dataPesanHd->noinvoice)."] - Tagihan untuk Pemesanan Anda \nHalo ".$this->namaPelanggan.",\nSemoga Anda dalam keadaan baik.\n\nTerlampir adalah invoice untuk layanan/produk yang telah kami berikan pada tanggal ".\Carbon\Carbon::parse($this->dataPesanHd->tgl_pengiriman)->format('d F Y').". Berikut kami lampirkan invoice anda\n".url("cetak/$this->encInv")."");
        // $this->isValidNumber = FilterString::isValidPhoneNumber($this->wa);
    }

    #[On("on-modalshare-readdata")]
    public function readData($kode)
    {
        $data = PesanHDModel::joinTable()->find($kode)->toArray();
        $encInv = Crypt::encrypt($data['noinvoice']);
        $this->selectedKode = $data['kodepesanhd'];
        $this->selectedNama = $data['noinvoice'].' - '.$data['namapelanggan'];
        $this->selectedPhone = $data['nohp'];
        $this->selectedEmail = $data['email'];
        $this->selectedUrl = url("cetak/$encInv");
        $this->selectedSubject = urlencode("INVOICE #".Str::replace('INVOICE', '', $data['noinvoice'])." | ".config("app.webname"));
        $this->selectedTitle = "[Invoice No. #".Str::replace('INVOICE', '', $data['noinvoice'])."] - Tagihan untuk Pemesanan Anda \nHalo ".$data['namapelanggan'].",\nSemoga Anda dalam keadaan baik.\n\nTerlampir adalah invoice untuk layanan/produk yang telah kami berikan pada tanggal ".\Carbon\Carbon::parse($data['tgl_pengiriman'])->format('d F Y').". Berikut kami lampirkan invoice anda\n\n";
        $this->selectedTitleWithUrl = urlencode("[Invoice No. #".Str::replace('INVOICE', '', $data['noinvoice'])."] - Tagihan untuk Pemesanan Anda \nHalo ".$data['namapelanggan'].",\nSemoga Anda dalam keadaan baik.\n\nTerlampir adalah invoice untuk layanan/produk yang telah kami berikan pada tanggal ".\Carbon\Carbon::parse($data['tgl_pengiriman'])->format('d F Y').". Berikut kami lampirkan invoice anda\n\n".url("cetak/$encInv"));
        $this->dispatch('open-modal', namamodal: 'modalShare');
    }

    public function shareWA()
    {
    }

    public function render()
    {
        return <<<'HTML'
            <div>
                <div wire:ignore.self class="modal fade" id="modalShare" tabindex="-1" aria-labelledby="modalShareLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalShareLabel">Share</h5>
                                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="d-flex flex-column gap-2 justify-content-center">

                                    <!-- Whatsapp -->
                                    <a
                                        href="https://wa.me/{{ $selectedPhone }}?text={{ $selectedTitleWithUrl }}"
                                        target="_blank"
                                        role="button"
                                        class="btn btn-lg btn-outline-success">
                                            <i class="fab fa-whatsapp text-success"></i> Whatsapp
                                    </a>

                                    <!-- Telegram -->
                                    <a
                                        href="https://t.me/share/url?url={{ $selectedUrl }}&text={{ $selectedTitle }}&to={{ $selectedPhone }}"
                                        target="_blank"
                                        role="button"
                                        class="btn btn-lg btn-outline-primary">
                                            <i class="fab fa-telegram text-primary"></i> Telegram
                                    </a>

                                    <!-- Email -->
                                    <a
                                        class="btn btn-lg btn-outline-info"
                                        target="_blank"
                                        role="button"
                                        href="mailto:{{ $selectedEmail }}?&subject={{ $selectedSubject }}&body={{ $selectedTitleWithUrl }}">
                                            <i class="fas fa-envelope text-info"></i> Email
                                    </a>

                                    <!-- Copy Url -->
                                    <button
                                        type="button"
                                        class="btn btn-lg btn-outline-secondary"
                                        wire:click="$dispatch('copy-to-clipboard', { url: '{{ $selectedUrl }}' })">
                                            <i class="fas fa-link text-secondary"></i> Copy URL
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
    }
}
