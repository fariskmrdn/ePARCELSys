<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'inventory';
    protected $fillable = [
        'receiver',
        'email',
        'tracking',
        'courier',
        'admin_id',
        'serial_no',
        'created_at',
        'updated_at',
        'status',
    ];
}
