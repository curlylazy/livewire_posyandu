<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
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
            ->join('tbl_posyandu', 'tbl_posyandu.kodeposyandu', '=', 'tbl_pasien.kodeposyandu')
            ->leftJoin('tbl_pasien as pasien_ayah', 'pasien_ayah.kodepasien', '=', 'tbl_pasien.kodeayah')
            ->leftJoin('tbl_pasien as pasien_ibu', 'pasien_ibu.kodepasien', '=', 'tbl_pasien.kodeibu')
            ->leftJoin('tbl_pasien as pasien_suami', 'pasien_suami.kodepasien', '=', 'tbl_pasien.kodesuami')
            ->select('tbl_pasien.*', 'pasien_ayah.namapasien as namaayah', 'pasien_ibu.namapasien as namaibu', 'pasien_suami.namapasien as namasuami',
                DB::raw("CONCAT(TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow'), ' tahun ', TIMESTAMPDIFF(MONTH, tbl_pasien.tgl_lahir, '$dateNow') % 12, ' bulan ') as umur_tahun_bulan"),
                DB::raw("TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') as umur"),
                DB::raw("
                    CASE
                        WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') <= 5 THEN 'Balita'
                        WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') BETWEEN 6 AND 12 THEN 'Anak-anak'
                        WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') BETWEEN 13 AND 17 THEN 'Remaja'
                        WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') BETWEEN 18 AND 59 THEN 'Dewasa'
                        ELSE 'Lansia'
                    END as kategoriumur
                ")
            );

        // ->join('tbl_bayi', 'tbl_pemeriksaan.kodebayi', '=', 'tbl_bayi.kodebayi', 'left')

        // ->selectRaw("
        //     tbl_pasien.*,
        //     CONCAT(TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, $dateNow), ' tahun ', TIMESTAMPDIFF(MONTH, tbl_pasien.tgl_lahir, $dateNow) % 12, ' bulan ') as umur_tahun_bulan,
        //     TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, $dateNow) as umur,
        //     CASE
        //         WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, $dateNow) BETWEEN 0 AND 5 THEN 'Balita'
        //         WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, $dateNow) BETWEEN 6 AND 12 THEN 'Anak-anak'
        //         WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, $dateNow) BETWEEN 13 AND 17 THEN 'Remaja'
        //         WHEN TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, $dateNow) BETWEEN 18 AND 59 THEN 'Dewasa'
        //         ELSE 'Lansia'
        //     END as kategoriumur
        // ");
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
        if(!empty($kategoripasien)) {
            $query->where('tbl_pasien.kategoripasien', '=', $kategoripasien);
        }
    }

    public function scopeSearchByPosyandu(Builder $query, $kodeposyandu): void
    {
        if(!empty($kodeposyandu)) {
            $query->where('tbl_pasien.kodeposyandu', '=', $kodeposyandu);
        }
    }

    public function scopeSearchByKategoriUmur(Builder $query, $kategoriumur): void
    {
        if(!empty($kategoriumur)) {
            $query->having('kategoriumur', '=', $kategoriumur);
        }
    }

    public function scopeSearchByKategoriUmurInArray(Builder $query, $arr): void
    {
        if(!empty($arr)) {
            $query->havingRaw("kategoriumur IN (".join(",", $arr).")");
        }

        // $dateNow = Carbon::today()->toDateString();

        // if (in_array("Balita", $arr)) {
        //     $query->whereRaw("TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') <= 5");
        // }

        // if (in_array("Anak-anak", $arr)) {
        //     $query->whereRaw("TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') >= 6 AND TIMESTAMPDIFF(YEAR, tbl_pasien.tgl_lahir, '$dateNow') <= 12");
        // }
    }

    public function scopeSearchByNik(Builder $query, $nik): void
    {
        if(!empty($nik)) {
            $query->where('tbl_pasien.nik', '=', $nik);
        }
    }

    public function scopeSearchByAnakKe(Builder $query, $ke): void
    {
        if(!empty($ke)) {
            $query->where('tbl_pasien.anakke', '=', $ke);
        }
    }

    public function scopeSearchByIbu(Builder $query, $kodeibu): void
    {
        if(!empty($kodeibu)) {
            $query->where('tbl_pasien.kodeibu', '=', $kodeibu);
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

    public function scopeSearchByJK(Builder $query, $jk): void
    {
        if(!empty($jk)) {
            $query->where('tbl_pasien.jk', '=', $jk);
        }
    }

    public function scopeSearchByKategoriPasien(Builder $query, $kategoripasien): void
    {
        if(!empty($kategoripasien)) {
            $query->where('tbl_pasien.kategoripasien', '=', $kategoripasien);
        }
    }

    public function scopeSearchUmurByBayi(Builder $query): void
    {
        $dateNow = Carbon::today()->toDateString();
        $query->whereRaw("(TIMESTAMPDIFF(MONTH, tbl_pasien.tgl_lahir, '$dateNow') % 12) <= 6");
    }

    public function scopeSearchByUmurBalitaApras(Builder $query): void
    {
        $dateNow = Carbon::today()->toDateString();
        $query->whereRaw("((TIMESTAMPDIFF(MONTH, tbl_pasien.tgl_lahir, '$dateNow') % 12) > 6 AND (TIMESTAMPDIFF(MONTH, tbl_pasien.tgl_lahir, '$dateNow') % 12) <= 32)");
    }

    public function getNikNamaAttribute()
    {
        return "($this->nik) $this->namapasien";
    }


}
