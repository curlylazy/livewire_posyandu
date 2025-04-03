<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestimonyModel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'tbl_testimony';
    protected $primaryKey = 'kodetestimony';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function scopeSearch(Builder $query, $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->where('tbl_testimony.nama', 'like', "%$katakunci%");
        });
    }
}
