<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class PasienModel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'tbl_pasien';
    protected $primaryKey = 'kodepasien';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function scopeSelectCustom(Builder $query): void
    {
        $dateNow = Carbon::today()->toDateString();
        $query
        // ->join('tbl_bayi', 'tbl_pemeriksaan.kodebayi', '=', 'tbl_bayi.kodebayi', 'left')
        ->select('tbl_pasien.*')
        ->selectRaw("
            CONCAT(TIMESTAMPDIFF(YEAR, tgl_lahir, $dateNow), ' tahun ', TIMESTAMPDIFF(MONTH, tgl_lahir, $dateNow) % 12, ' bulan ') as umur_tahun_bulan,
            TIMESTAMPDIFF(YEAR, tgl_lahir, $dateNow) as umur,
            CASE
                WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, $dateNow) BETWEEN 0 AND 5 THEN 'Balita'
                WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, $dateNow) BETWEEN 6 AND 12 THEN 'Anak-anak'
                WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, $dateNow) BETWEEN 13 AND 17 THEN 'Remaja'
                WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, $dateNow) BETWEEN 18 AND 59 THEN 'Dewasa'
                ELSE 'Lansia'
            END as kategori_umur
        ");
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

    public function scopeSearchByKategori(Builder $query, $kategoripasien): void
    {
        if(!empty($kategori)) {
            $query->where('tbl_pasien.kategoripasien', '=', $kategoripasien);
        }
    }

    public function scopeSearchByNik(Builder $query, $nik): void
    {
        if(!empty($nik)) {
            $query->where('tbl_pasien.nik', '=', $nik);
        }
    }

    public function scopeSearchByStatus(Builder $query, $status): void
    {
        if($status != "") {
            $query->where('tbl_pasien.status', '=', $status);
        }
    }

    public function scopeSearchByPerempuanDewasa(Builder $query): void
    {
        $query
            ->where('tbl_pasien.jk', 'P')
            ->whereRaw("TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, ?) > ?", [date('Y-m-d'), 12]);
    }

    public function scopeSearchByLakiDewasa(Builder $query): void
    {
        $query
            ->where('tbl_pasien.jk', 'L')
            ->whereRaw("TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, ?) > ?", [date('Y-m-d'), 12]);

        // $query
        //     ->where('tbl_pasien.jk', 'L')
        //     ->when(function ($query) {
        //         $query->having('umur', '>', 12);
        //     });
    }
}
