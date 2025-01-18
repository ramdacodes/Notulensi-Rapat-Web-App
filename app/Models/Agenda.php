<?php

namespace App\Models;

use App\MeetingStatus;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $primaryKey = 'agenda_id';

    protected $fillable = [
        'name',
        'participants',
        'inviter_name',
        'inviter_position',
        'location',
        'date',
        'status',
    ];

    protected $casts = [
        'participants' => 'array',
        'status'    => MeetingStatus::class,
    ];

    public function notulensi()
    {
        return $this->hasMany(Notulensi::class, 'agenda_id');
    }
}
