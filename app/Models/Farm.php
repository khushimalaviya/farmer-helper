<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable = ['user_id', 'soil_type', 'land_area', 'water_source', 'season', 'temperature', 'humidity', 'rainfall'];
}
