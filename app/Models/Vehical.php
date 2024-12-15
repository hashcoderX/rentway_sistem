<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehical extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'vehical_no',
        'vehical_type',
        'vehical_brand',
        'body_type',
        'vehical_model',
        'meeter',
        'licen_exp',
        'insurence_exp',
        'per_day_rental',
        'per_week_rental',
        'per_month_rental',
        'per_year_rental',
        'per_day_free_duration',
        'per_week_free_duration',
        'per_month_free_duration',
        'per_year_free_duration',
        'addtional_per_mile_cost',
        'deposit_amount',
        'avalibility',
    ];

    public $timestamps = false;
    
    use HasFactory;
}
