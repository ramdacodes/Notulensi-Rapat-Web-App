<?php

namespace App\Models;

use App\MeetingStatus;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $primaryKey = 'agenda_id';

    protected $fillable = [
        'name',
        'location',
        'date',
        'participants',
        'inviter_name',
        'inviter_position',
        'rundowns',
        'status',
    ];

    protected $casts = [
        'participants' => 'array',
        'rundowns' => 'array',
        'status'    => MeetingStatus::class,
    ];

    public function notulensi()
    {
        return $this->hasOne(Notulensi::class, 'agenda_id');
    }
}
