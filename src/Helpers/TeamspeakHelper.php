<?php

namespace ZeroServer\Teamspeak\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Seat\Eveapi\Models\Character\CharacterSheet;
use Seat\Eveapi\Models\Eve\ApiKey;
use Seat\Web\Models\User;
use ZeroServer\Teamspeak\Models\TeamspeakUser;

class TeamspeakHelper
{
    /**
     * @param $tsUsername
     * @param $tsPassword
     * @param $tsHostname
     * @param $tsServerQuery
     * @param $tsServerPort
     * @return \TeamSpeak3_Adapter_Abstract
     */
    public static function connect($tsUsername, $tsPassword, $tsHostname, $tsServerQuery, $tsServerPort)
    {
        return \TSFramework\Teamspeak::factory("serverquery://" . $tsUsername . ":" . $tsPassword . "@" . $tsHostname .
            ":" . $tsServerQuery . "/?server_port=" . $tsServerPort);
    }
}