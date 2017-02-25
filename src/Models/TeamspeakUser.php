<?php

namespace ZeroServer\Teamspeak\Models;

use Illuminate\Database\Eloquent\Model;
use Seat\Web\Models\User;

class TeamspeakUser extends Model
{
    protected $fillable = [
        'user_id', 'teamspeak_id', 'teamspeak_uid', 'invited'
    ];

    protected $primaryKey = 'user_id';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
