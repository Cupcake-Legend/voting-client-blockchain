<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "address",
        "max_voters"
    ];

    protected $table = "tps";

    protected $primaryKey = "id";
    public $incrementing = false;
    protected $keyType = 'string';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
