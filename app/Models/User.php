<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $guarded = 'web';

    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'status', 'pro_username', 'pro_server'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}