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

    public function users()
    {
       return $this->hasMany(User::class);
    }
}
