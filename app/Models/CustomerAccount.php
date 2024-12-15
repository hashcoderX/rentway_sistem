<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAccount extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'customer_id',
        'accountbalance	',
    ];
    public $timestamps = false;

    use HasFactory;
}
