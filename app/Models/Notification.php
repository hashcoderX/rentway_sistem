<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
   protected $fillable = [
        'type',
        'notification_level',
        'read_state',
        'topic',
        'notifiaction_date',
        'time',
        'description',
        'state',
        'state',
        'company_id'
    ];

    public $timestamps = false;
   
    use HasFactory;
}
