<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PosyanduModel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'tbl_posyandu';
    protected $primaryKey = 'kodeposyandu';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    public function pasien(): HasMany
    {
        return $this->hasMany(PasienModel::class, 'kodeposyandu', 'kodeposyandu');
    }

    public function scopeSearch(Builder $query, $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->where('namaposyandu', 'like', "%$katakunci%");
        });
    }

    public function scopeSearchBySeo(Builder $query, $seo): void
    {
        $query->where('seoposyandu', $seo);
    }
}
