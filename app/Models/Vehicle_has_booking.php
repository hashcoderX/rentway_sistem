<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_has_booking extends Model
{
    
    protected $fillable = [
        'user_id',
        'company_id',
        'vehicle_no',
        'book_start_date',
        'pick_time',
        'pick_location',
        'wheretogo',
        'return_date',
        'return_time',
        'return_location',
        'book_time',
        'isdriver',
        'hire_location',
        'status',
        'note',
        'customer_id',
    ];

    public $timestamps = false;
    
    use HasFactory;
}
