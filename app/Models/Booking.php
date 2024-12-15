<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    
    protected $fillable = [
        'user_id',
        'company_id',
        'vehicle_no',
        'book_date',
        'pick_time',
        'booked_date',
        'booked_time',
        'customer_name',
        'customer_id',
    ];

    public $timestamps = false;
    
    use HasFactory;
}
