<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeSearch(Builder $query, $katakunci): void
    {
        $query->where(function ($query) use ($katakunci) {
            $query
                ->where('username', 'like', "%$katakunci%")
                ->orWhere('namauser', 'like', "%$katakunci%");
        });
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
