<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashflote extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'customer_id',
        'accountbalance',
        'date_time',
        'credit',
        'debit',
        'note',
        'description',
    ];

    public $timestamps = false;
}
