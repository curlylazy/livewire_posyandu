<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BayiModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tbl_bayi';
    protected $primaryKey = 'kodebayi';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];


    public function scopeJoinTable(Builder $query): void
    {
        $query->join('tbl_pasien', 'tbl_bayi.kodepasien', '=', 'tbl_pasien.kodepasien');
    }

    public function scopeSearch(Builder $query, $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->where('tbl_pasien.namapasien', 'like', "%$katakunci%")
                ->orWhere('tbl_pasien.namabayi', 'like', "%$katakunci%");
        });
    }
}
