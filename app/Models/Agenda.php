<?php

namespace App\Models;

use App\MeetingStatus;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $primaryKey = 'agenda_id';

    protected $fillable = [
        'name',
        'total_participants',
        'location',
        'date',
        'status',
    ];

    protected $casts = [
        'status'    => MeetingStatus::class,
    ];

    public function notulensi()
    {
        return $this->hasMany(Notulensi::class, 'agenda_id');
    }
}
