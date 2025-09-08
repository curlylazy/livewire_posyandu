<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class PemeriksaanModel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'tbl_pemeriksaan';
    protected $primaryKey = 'kodepemeriksaan';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function scopeJoinTable(Builder $query): void
    {
        $query
            ->select('tbl_pemeriksaan.*', 'tbl_pasien.*', 'tbl_pemeriksaan.kodepasien', 'tbl_pasien.tgl_lahir as tgl_lahir_pasien', 'pasien_suami.namapasien as namasuami', 'pasien_bayi.namapasien as namabayi', 'pasien_ibu.kodepasien as kodeibu', 'pasien_ibu.namapasien as namaibu', 'pasien_ayah.namapasien as namaayah')
            ->join('tbl_pasien', 'tbl_pemeriksaan.kodepasien', '=', 'tbl_pasien.kodepasien')
            ->leftJoin('tbl_pasien as pasien_bayi', 'pasien_bayi.kodepasien', '=', 'tbl_pemeriksaan.kodebayi')
            ->leftJoin('tbl_pasien as pasien_ayah', 'pasien_ayah.kodepasien', '=', 'tbl_pasien.kodeayah')
            ->leftJoin('tbl_pasien as pasien_ibu', 'pasien_ibu.kodepasien', '=', 'tbl_pasien.kodeibu')
            ->leftJoin('tbl_pasien as pasien_suami', 'pasien_suami.kodepasien', '=', 'tbl_pasien.kodesuami');
    }

    public function scopeSearch(Builder $query, $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->where('tbl_pasien.nik', 'like', "%$katakunci%")
                ->orWhere('tbl_pasien.alamat', 'like', "%$katakunci%")
                ->orWhere('tbl_pasien.nohp', 'like', "%$katakunci%")
                ->orWhere('tbl_pasien.namapasien', 'like', "%$katakunci%");
        });
    }

    public function scopeSearchByKategoriPeriksa(Builder $query, $kategori): void
    {
        if(!empty($kategori)) {
            $query->where('tbl_pemeriksaan.kategori_periksa', '=', $kategori);
        }
    }

    public function scopeSearchByDate(Builder $query, $tglDari, $tglSampai): void
    {
        if(!empty($tglDari) && !empty($tglDari)) {
            $query->whereBetween('tbl_pemeriksaan.tgl_periksa', [$tglDari, $tglSampai]);
        }
    }

    public function scopeSearchByYear(Builder $query, $year): void
    {
        if(!empty($year)) {
            $query->whereYear('tbl_pemeriksaan.tgl_periksa', $year);
        }
    }

    public function scopeSearchByMonthYear(Builder $query, $month = "", $year = ""): void
    {
        if(!empty($month))
            $query->whereMonth('tbl_pemeriksaan.tgl_periksa', $month);

        if(!empty($year))
            $query->whereYear('tbl_pemeriksaan.tgl_periksa', $year);
    }

    public function scopeSearchByKodePasien(Builder $query, $kodepasien): void
    {
        $query->where('tbl_pemeriksaan.kodepasien', $kodepasien);
    }

    public function scopeSearchByBayi(Builder $query, $kodebayi): void
    {
        if(!empty($kodebayi)) {
            $query->where('tbl_pemeriksaan.kodebayi', $kodebayi);
        }
    }

    public function scopeSearchByNIK(Builder $query, $nik): void
    {
        $query->where('tbl_pasien.nik', $nik);
    }

    public function scopeSearchByHamilKe(Builder $query, $periksa_hamil_ke): void
    {
        if($periksa_hamil_ke != "") {
            $query->where('tbl_pemeriksaan.periksa_hamil_ke', $periksa_hamil_ke);
        }
    }

    public function scopeSearchByCheckListLengkap(Builder $query, $status): void
    {
        $query->where('tbl_pemeriksaan.is_checklist_pemeriksaan_lengkap', $status);
    }

    public function scopeSearchByGejalaTBC(Builder $query): void
    {
        $query->whereRaw('(tbl_pemeriksaan.is_batuk + tbl_pemeriksaan.is_demam + tbl_pemeriksaan.is_bb_tidak_naik_turun + tbl_pemeriksaan.is_kontak_pasien_tbc) >= 2');
    }

    // *** Pemeriksaan Bayi
    public function scopeSearchByUmurBayi(Builder $query): void
    {
        $dateNow = Carbon::today()->toDateString();
        $query->whereRaw("(TIMESTAMPDIFF(MONTH, tbl_pasien.tgl_lahir, '$dateNow') % 12) <= 6");
    }

    public function scopeSearchByUmurBalitaApras(Builder $query): void
    {
        $dateNow = Carbon::today()->toDateString();
        $query->whereRaw("((TIMESTAMPDIFF(MONTH, tbl_pasien.tgl_lahir, '$dateNow') % 12) > 6 AND (TIMESTAMPDIFF(MONTH, tbl_pasien.tgl_lahir, '$dateNow') % 12) <= 32)");
    }
}
