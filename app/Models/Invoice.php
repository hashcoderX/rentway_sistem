<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'customer_id',
        'guarantor_id',
        'customername',
        'starting_meeter',
        'endmeeter',
        'type_of_rent',
        'addtional_mile_chargers',
        'vehicle_no',
        'extra_charges',
        'extra_for_description',
        'description',
        'advance_charge',
        'total_bill',
        'discount',
        'net_total',
        'invoice_date',
        'invoice_status',
        'invoice_compleat_date',
        'issue_type',
        'extra_drive_amount',
        'extramillege',
        'totaldrivedistance',
        'bamount',
        'paidamount',
        'balance'
    ];

    public $timestamps = false;
}
