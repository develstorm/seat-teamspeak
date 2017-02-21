<?php

namespace ZeroServer\Teamspeak\Models;

use Illuminate\Database\Eloquent\Model;

class TeamspeakGroup extends Model
{
    protected $fillable = [
        'id', 'name', 'is_server_group'
    ];

    protected $primaryKey = 'id';
}
