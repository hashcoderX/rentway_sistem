<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $fillable = [
        'user_id',
        'company_id',
        'full_name',
        'reg_date',
        'nic',
        'drivinglicenseno',
        'street',
        'address_line_one',
        'city',
        'telephone_no',
        'driving_licen_photo',
        'livingvarification',
        'customer_photo'
    ];

    public $timestamps = false;

    use HasFactory;
}
