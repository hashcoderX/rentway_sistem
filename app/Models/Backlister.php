<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backlister extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'full_name',
        'reg_date',
        'nic',
        'address',
        'telephone_no',
        'driving_licen_photo',
        'effected_company_name',
        'company_address',
        'company_contact_no',
        'type_of_damage',
        'resone_describe',
        'livingvarification',
        'customer_photo',
        'damageverification',
    ];

    use HasFactory;
    public $timestamps = false;
}
