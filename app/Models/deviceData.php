<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deviceData extends Model
{
    use HasFactory;
    protected $table = "Device_Data";
    protected $fillable = [
        "usage",
        "state",
        "date",
    ];
public $timestamps = false;
}
