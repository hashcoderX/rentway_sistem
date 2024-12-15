<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'nic',
        'customer_name',
        'contactno',
        'issue_date',
        'issue_time',
        'wheretogo',
        'booking_return_date',
        'booking_return_time',
        'booking_return_location',
        'hiretypr',
        'note'
    ];

    public $timestamps = false;
}
