<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billalignment extends Model
{
    
    protected $fillable = [
        'user_id',
        'company_id',
        'elementid',
        'element_top_possition',
        'element_left_possition',
    ];

    public $timestamps = false;
    
    use HasFactory;
}
