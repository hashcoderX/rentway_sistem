<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
   
    protected $fillable = [
        'name',
        'company_code',
        'reg_no',
        'register_date',
        'email',
        'password',
        'address',
        'owner_name',
        'contact_no',
        'mobile_number',
        'website',
        'logo',
        'description',
        'payby',
        'header',
        'footer',
    ];
   
    use HasFactory;

    public $timestamps = false;
}
