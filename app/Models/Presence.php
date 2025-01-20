<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    protected $primaryKey = 'presence_id';

    protected $fillable = [
        'agenda_id',
        'nidn',
        'nim',
        'name',
    ];
}
