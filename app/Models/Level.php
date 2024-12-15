<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'lvl',
        'description',
        'jdmarketing',
        'jdoperation',
        'category',
    ];

    public $timestamps = false;
}
