<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeehasleaverecord extends Model
{

    protected $fillable = [
        'employee_id',
        'request_leave_type',
        'leave_start',
        'leave_end',
        'leave_count',
        'isapprove_reporter',
        'isapporve_manager',
        'isapprovehr',
    ];

    use HasFactory;
}
