<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PackageModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tbl_package';
    protected $primaryKey = 'kodepackage';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function scopeSearch(Builder $query, $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->orWhere('namapackage', 'like', "%$katakunci%");
        });
    }

    protected function casts(): array
    {
        return [
            'activityinclude' => 'array',
        ];
    }
}
