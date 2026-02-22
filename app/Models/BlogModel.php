<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogModel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'tbl_blog';
    protected $primaryKey = 'kodeblog';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'kodeuser', 'kodeuser');
    }

    public function scopeSearch(Builder $query, $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->where('judul', 'like', "%$katakunci%")
                ->orWhere('isi', 'like', "%$katakunci%");
        })
            ->whereHas('user', function ($q) use ($katakunci) {
                $q->orWhere('namauser', 'like', '%'.$katakunci.'%');
            });
    }

    public function scopeJoinTable(Builder $query): void
    {
        $query
            ->select('tbl_blog.*', 'tbl_user.namauser as author')
            ->leftJoin('tbl_user', 'tbl_user.kodeuser', '=', 'tbl_blog.kodeuser');
    }

    public function scopeSearchBySeo(Builder $query, $seo): void
    {
        $query->where('tbl_blog.seoblog', $seo);
    }
}
