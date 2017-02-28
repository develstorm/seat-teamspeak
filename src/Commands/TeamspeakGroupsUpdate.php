<?php

namespace ZeroServer\Teamspeak\Commands;


use Illuminate\Console\Command;
use Seat\Services\Settings\Seat;
use ZeroServer\Teamspeak\Exceptions\TeamspeakSettingException;
use ZeroServer\Teamspeak\Helpers\TeamspeakHelper;
use ZeroServer\Teamspeak\Models\TeamspeakGroup;

class TeamspeakGroupsUpdate extends Command
{
    protected $signature = 'teamspeak:groups:update';

    protected $description = 'Discovering Teamspeak groups (both server and channel)';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tsUsername = Seat::get('teamspeak_username');
        $tsPassword = Seat::get('teamspeak_password');
        $tsHostname = Seat::get('teamspeak_hostname');
        $tsServerQuery = Seat::get('teamspeak_server_query');
        $tsServerPort = Seat::get('teamspeak_server_port');

        if ($tsUsername == null || $tsPassword == null || $tsHostname == null || $tsServerQuery == null ||
            $tsServerPort == null) {
            throw new TeamspeakSettingException("missing teamspeak_username, teamspeak_password, teamspeak_hostname, ".
                "teamspeak_server_query or teamspeak_server_port in settings");
        }

        $tsServer = TeamspeakHelper::connect($tsUsername, $tsPassword, $tsHostname, $tsServerQuery, $tsServerPort);

        // type : {0 = template, 1 = normal, 2 = query}
        $groups = $tsServer->serverGroupList(['type' => 1]);

        foreach ($groups as $group) {
            $teamspeakGroup = TeamspeakGroup::find($group->sgid);

            if ($teamspeakGroup == null) {
                TeamspeakGroup::create([
                    'id' => $group->sgid,
                    'name' => $group->name,
                    'is_server_group' => true,
                ]);

                continue;
            }
            $teamspeakGroup->update([
                'name' => $group->name
            ]);
        }
    }
}
