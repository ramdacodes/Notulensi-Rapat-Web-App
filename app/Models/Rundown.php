<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rundown extends Model
{
    protected $primaryKey = 'agenda_id';

    protected $fillable = [
        'agenda_id',
        'discussion',
        'start_time',
        'end_time',
        'pics',
    ];

    protected $casts = [
        'pics' => 'array',
    ];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }
}
