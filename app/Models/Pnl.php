<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pnl extends Model
{

    protected $fillable = [
        'description',
        'credit',
        'debit',
        'date_time',
        'balance',
        'company_id',
    ];

    public $timestamps = false;

    use HasFactory;
}
