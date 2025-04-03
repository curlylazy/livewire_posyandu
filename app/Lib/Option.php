<?php

namespace App\Lib;

use Illuminate\Support\Arr;

class Option
{
    public static $optNameKategori = "kategori";

	public static function statusPesan()
	{
		$res = [];
        $res[] = '<option value="">Pilih Status Pesan</option>';
        $res[] = '<option value="0">Belum Dikerjakan</option>';
        $res[] = '<option value="1">Sedang Dikerjakan</option>';
        $res[] = '<option value="2">Siap Dikirim</option>';
        $res[] = '<option value="3">Selesai</option>';
        $res[] = '<option value="9">Batal</option>';
		return Arr::join($res, '');
	}

	public static function statusBayar()
	{
		$res = [];
        $res[] = '<option value="">Pilih Status Bayar</option>';
        $res[] = '<option value="0">Belum Dibayar</option>';
        $res[] = '<option value="1">Sudah Dibayar</option>';
		return Arr::join($res, '');
	}

	public static function satuan()
	{
		$res = [];
        $res[] = '<option value="">Pilih Satuan</option>';
        $res[] = '<option value="PCS">PCS</option>';
        $res[] = '<option value="Meter">Meter</option>';
        $res[] = '<option value="Rol">Rol</option>';
        $res[] = '<option value="Sentimeter">Sentimeter</option>';
        $res[] = '<option value="Kilo">Kilo</option>';
        $res[] = '<option value="Yard">Yard</option>';
		return Arr::join($res, '');
	}

	public static function layanan()
	{
		$res = collect();
        $res->push(['nama' => 'Produksi Uniform']);
        $res->push(['nama' => 'Produksi Pakaian Anak']);
        $res->push(['nama' => 'Cetak dan Bordir']);
        $res->push(['nama' => 'Pengiriman Pesanan']);
        $res->push(['nama' => 'Pengemasan dan Konsultasi']);
		return $res;
	}

	public static function uniform()
	{
		$res = collect();
        $res->push(['nama' => 'Uniform Sekolah']);
        $res->push(['nama' => 'Uniform Hotel']);
        $res->push(['nama' => 'Uniform Villa']);
        $res->push(['nama' => 'Uniform Restaurant']);
        $res->push(['nama' => 'Uniform Kantoran']);
        $res->push(['nama' => 'Uniform Komunitas']);
		return $res;
	}

	public static function kategoriDokumen()
	{
		$res = collect();
        $res->push(['value' => 'desaantikorupsi', 'name' => 'Desa Anti Korupsi']);
        $res->push(['value' => 'desawisata', 'name' => 'Desa Wisata']);
        $res->push(['value' => 'ppid', 'name' => 'Pejabat Pengelola Informasi dan Dokumentasi']);
		return $res;
	}

	public static function subKategoriProdukHukum()
	{
		$res = collect();
        $res->push(['value' => 'Surat Lainnya', 'name' => 'Surat Lainnya']);
        $res->push(['value' => 'Surat Keterangan', 'name' => 'Surat Keterangan']);
        $res->push(['value' => 'Laporan', 'name' => 'Laporan']);
        $res->push(['value' => 'SK Kepala Desa', 'name' => 'SK Kepala Desa']);
        $res->push(['value' => 'Peraturan Desa', 'name' => 'Peraturan Desa']);
        $res->push(['value' => 'Peraturan Kepala Desa', 'name' => 'Peraturan Kepala Desa']);
		return $res;
	}

	public static function getOptionName($name, $value)
	{
        $res = "";
        if($name == self::$optNameKategori)
        {
            $res = self::kategoriDokumen()->firstWhere('value', $value)['name'];
        }

		return $res;
	}

}
