<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_has_education extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'index_no',
        'exam_name',
        'results',
    ];

    public $timestamps = false;
}
