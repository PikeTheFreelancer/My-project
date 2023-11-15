<?php

namespace App\Models\Block;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextAndImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'content', 'image', 'image_pos', 'page_id'
    ];
}
