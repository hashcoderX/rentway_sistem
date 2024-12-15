<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidateid',
        'interviewdate',
        'interviewtime',
        'first_interviewer',
        'secound_interviwer	',
        'about_interview',
        'interview_stage',
        'communication',
        'score',
        'remark',
        'interview_type',
        'third_interviwer',
        'meeting_link',  
        'interview_summery', 
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidateid', 'id');
    }

    public function firstInterviewer()
    {
        return $this->belongsTo(Employee::class, 'first_interviewer', 'id');
    }

    public function secondInterviewer()
    {
        return $this->belongsTo(Employee::class, 'secound_interviwer', 'id');
    }

    public $timestamps = false;
}
