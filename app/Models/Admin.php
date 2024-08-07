<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'admin';
    
    protected $guarded = ['id', 'created_at', 'updated_at', 'last_login'];
    
    protected $hidden = ['password'];
    
    protected $fillable = [
        'username',
        'password',
        'status',
        'last_login',
    ];
    
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}

