<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogModel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'tbl_blog';
    protected $primaryKey = 'kodeblog';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function scopeJoinTable(Builder $query): void
    {
        $query->join('tbl_user', 'tbl_user.kodeuser', '=', 'tbl_blog.kodeuser');
    }

    public function scopeSearch(Builder $query, $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->where('tbl_blog.namabalog', 'like', "%$katakunci%");
        });
    }

    public function scopeSearchBySeo(Builder $query, $seo): void
    {
        $query->where('tbl_blog.seoblog', $seo);
    }
}
