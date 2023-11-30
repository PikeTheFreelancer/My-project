<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
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
    public function canAccessFilament(): bool
    {
        return str_ends_with($this->email, '@vermilioncenter.com') && $this->hasVerifiedEmail();
    }
}