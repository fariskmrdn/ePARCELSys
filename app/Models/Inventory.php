<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'inventory';
    // protected $fillable = ['tracking_no', 'user_id'];
}
