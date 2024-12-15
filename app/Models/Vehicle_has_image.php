<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_has_image extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'company_id',
        'image_url',
    ];

    public $timestamps = false;
}
