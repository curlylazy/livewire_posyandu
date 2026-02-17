<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class UserModel extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids, HasRoles, SoftDeletes;

    protected $table = 'tbl_user';
    protected $primaryKey = 'kodeuser';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function posyandu(): BelongsTo
    {
        return $this->belongsTo(PosyanduModel::class, "kodeposyandu", "kodeposyandu");
    }

    public function scopeJoinTable(Builder $query): void
    {
        $query
            ->leftJoin('tbl_posyandu', 'tbl_posyandu.kodeposyandu', '=', 'tbl_user.kodeposyandu');
    }

    public function scopeSearch(Builder $query, $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->where('username', 'like', "%$katakunci%")
                ->orWhere('namauser', 'like', "%$katakunci%");
        });
    }

    public function scopeSearchByPosyandu(Builder $query, $kode): void
    {
        $query->whereHas("posyandu", function ($query) use ($kode) {
            $query
                ->where('kodeposyandu', $kode);
        });
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
