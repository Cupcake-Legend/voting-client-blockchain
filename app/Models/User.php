<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'name',
        'nik',
        'password',
        'tps_id',
        'role'
    ];

    public function tps()
    {
        return $this->belongsTo(Tps::class);
    }
}
