<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class UserModel extends Model implements AuthenticatableContract
{
    use AuthenticatableTrait;
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    
    protected $fillable = ['level_id', 'username', 'nama', 'password'];

    public function level(): BelongsTo{
        return $this->belongsTo(LevelModel::class,'level_id');
    }
}
