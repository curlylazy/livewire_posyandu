<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasienModel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'tbl_pasien';
    protected $primaryKey = 'kodepasien';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

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
}
