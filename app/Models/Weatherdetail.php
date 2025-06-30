<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weatherdetail extends Model
{
    protected $table = 'weatherdetails';

    protected $fillable = [
        'city',
        'temperature',
        'description',
        'icon',
        'humidity',
        'wind_speed',
    ];
}
