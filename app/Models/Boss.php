<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boss extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'region', 'location', 'cooldown'
    ];

    public function lineUp()
    {
        return $this->hasMany(LineUp::class);
    }
}
