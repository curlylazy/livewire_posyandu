<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class GaleriModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tbl_galeri';
    protected $primaryKey = 'kodegaleri';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function scopeSearch(Builder $query, $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->orWhere('namagaleri', 'like', "%$katakunci%");
        });
    }
}
