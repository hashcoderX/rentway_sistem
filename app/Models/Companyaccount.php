<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companyaccount extends Model
{

    protected $fillable = [
        'account_type',
        'amount',
        'company_id',
    ];

    public $timestamps = false;

    use HasFactory;
}
