<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'amount', 
        'description',
        'date_time',
        'paytype',
        'payment_type',
        'month',
        'invoiceid',
        'paystatus',
    ];

    public $timestamps = false;
    
    use HasFactory;
}
