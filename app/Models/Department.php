<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected $fillable = [
        'departmentcode',
        'name',
        'description',
        'branch_id',
        'manager_id',
        'userid',
        'firstlayer',
        'secondlayer',
        'thirdlayer',
        'forthlayer',
    ];

    public $timestamps = false;

    use HasFactory;

   
}
