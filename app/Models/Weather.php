<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $fillable = ['farm_id', 'temperature', 'humidity', 'rainfall'];

}
