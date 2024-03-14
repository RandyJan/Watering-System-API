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
        'moisture1',
        'moisture2',
        'moisture3',
        'waterlvl',
        'network',
        'id',
        'state',
        
    ];
    public $timestamps = false;
}
