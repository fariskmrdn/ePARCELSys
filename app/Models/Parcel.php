<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parcel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'pre_item';
    protected $fillable = ['tracking_no', 'user_id','status','updated_at'];


}
