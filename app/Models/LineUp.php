<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineUp extends Model
{
    use HasFactory;

    protected $table = 'line_ups';

    protected $fillable = [
        'level', 'boss_id', 'line_up', 'rewards', 'notes', 'nature', 'ability'
    ];

    protected $casts = [
        'line_up' => 'json'
    ];
    public function boss()
    {
        return $this->belongsTo(Boss::class);
    }
}
