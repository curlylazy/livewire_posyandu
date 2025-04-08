<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

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
            ->join('tbl_pasien', 'tbl_pemeriksaan.kodepasien', '=', 'tbl_pasien.kodepasien')
            ->join('tbl_bayi', 'tbl_pemeriksaan.kodebayi', '=', 'tbl_bayi.kodebayi', 'left');
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

    public function scopeSearchByMonthYear(Builder $query, $month, $year): void
    {
        if(!empty($month) && !empty($year)) {
            $query
                ->whereMonth('tbl_pemeriksaan.tgl_periksa', $month)
                ->whereYear('tbl_pemeriksaan.tgl_periksa', $year);
        }
    }
}
