<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{

    protected $fillable = [
        'name',
        'email',
        'phonenumber',
        'dob',
        'possition',
        'experiance',
        'cv_link',
        'interview_stage',
        'reg_date',
        'reg_time',
        'nic',
        'benic',
        'description',
        'current_salary',
        'expectation',
        'agreed_amount',
        'notis_period',
        'comminication_score',
    ];

    public function interviews()
    {
        return $this->hasMany(Interview::class, 'candidateid', 'id');
    }

    public $timestamps = false;

    use HasFactory;
}
