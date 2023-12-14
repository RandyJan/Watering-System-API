<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deviceSensor extends Model
{
    use HasFactory;
    protected $table = 'Device_Sensor';
    protected $fillable = [
        'pump',
        'moisture',
        'waterlvl',
        'network',
    ];
    public $timestamps = false;
}
