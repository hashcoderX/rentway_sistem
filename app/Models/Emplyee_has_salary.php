<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emplyee_has_salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'salary_category',
        'amount',
        'maths',
        'aplicable_year',
    ];

    public $timestamps = false;
}
