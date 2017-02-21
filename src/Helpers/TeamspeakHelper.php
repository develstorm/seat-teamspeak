<?php

namespace ZeroServer\Teamspeak\Helpers;


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
        return \TeamSpeak3::factory("serverquery://" . $tsUsername . ':' . $tsPassword . '@' . $tsHostname .
            ':' . $tsServerQuery . "/?server_port=" . $tsServerPort);
    }
}