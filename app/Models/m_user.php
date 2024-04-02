<?php

namespace App\Models;

use Illuminate\database\Eloquent\Factories\HasFactory;
use Illuminate\database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class m_user extends Model{
    
    protected $table = "m_user";
    public $timestamps = false;
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'level_id',
        'username',
        'nama',
        'password'
    ];

    public function barang(): HasOne {
        return $this->hasOne(LevelModel::class, 'level_id', 'level_id');
    }
}