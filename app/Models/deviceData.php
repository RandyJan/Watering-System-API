<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deviceData extends Model
{
    use HasFactory;
    protected $table = "Device_Data";
    protected $fillable = [
        "soiusage1",
        "soiusage2",
        "soiusage3",
        "state",
        "date",
    ];
public $timestamps = false;
}
