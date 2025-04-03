<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class GaleriActivityModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tbl_galeri_activity';
    protected $primaryKey = 'kodegaleriactivity';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];


    public function scopeJoinTable(Builder $query): void
    {
        $query->join('tbl_activity', 'tbl_activity.kodeactivity', '=', 'tbl_galeri_activity.kodeactivity');
    }

    public function scopeSearchByKodeActivity(Builder $query, $kode): void
    {
        $query->where('tbl_galeri_activity.kodeactivity', $kode);
    }
}
