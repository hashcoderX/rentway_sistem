<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'fax',
        'userid',
        'date_time',
        'branchcode',
        'unit_head',
        'firstlawyer',
        'secound_lawyer',
        'third_lawyer',
        'forth_lawyer',
    ];

    public $timestamps = false;

    use HasFactory;
}
