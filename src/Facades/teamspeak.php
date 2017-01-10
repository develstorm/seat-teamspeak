<?php

namespace ZeroServer\Teamspeak\Facades;

use Illuminate\Support\Facades\Facade;

class Teamspeak extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'teamspeak';
    }
}
