<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'expenses_type',
        'amount',
        'company_id',
        'date_time',
        'reference',
    ];

    public $timestamps = false;
}
