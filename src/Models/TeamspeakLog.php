<?php

namespace ZeroServer\Teamspeak\Models;

use Illuminate\Database\Eloquent\Model;

class TeamspeakLog extends Model
{
    protected $fillable = [
        'event', 'message'
    ];

    protected $primaryKey = 'id';
}
