<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityModel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'tbl_activity';
    protected $primaryKey = 'kodeactivity';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function scopeSearch(Builder $query, $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->orWhere('namaactivity', 'like', "%$katakunci%")
                ->where('keterangansingkat', 'like', "%$katakunci%");
        });
    }

    public function scopeSearchByNama(Builder $query, $nama): void
    {
        $query->where('namaactivity', $nama);
    }

    public function scopeSearchBySeo(Builder $query, $seo): void
    {
        $query->where('seoactivity', $seo);
    }

    public function scopeOrderByNoUrut(Builder $query)
    {
        return $query->orderBy('nourut', 'asc');
    }
}
