<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'meeting_date',
        'subject',
        'meeting_status',
        'details',
        'url',
        'minutes',
        'client_name',
        'client_email',      
    ];

    protected $casts = [
        'meeting_date' => 'datetime',
        'minutes' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
