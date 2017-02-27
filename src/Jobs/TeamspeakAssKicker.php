<?php

namespace ZeroServer\Teamspeak\Jobs;

use Seat\Eveapi\Models\Eve\ApiKey;
use ZeroServer\Teamspeak\Models\TeamspeakUser;
//use TSFramework\Node\Client;

class TeamspeakAssKicker extends AbstractTeamspeak
{
    public function call()
    {
        // call the parent call method in order to load the Teamspeak Server object
        parent::call();

        // get all Api Key owned by the user
        $keys = ApiKey::where('user_id', $this->user->id)->get();
        // get the Teamspeak User
        $teamspeakUser = TeamspeakUser::where('user_id', $this->user->id)
            ->whereNotNull('teamspeak_id')
            ->first();

        if ($teamspeakUser != null) {
            // get channels into which current user is already member
            $userInfo = $this->getTeamspeak()->clientGetByDbid($teamspeakUser->teamspeak_id, true);
            //$groups = $this->getTeamspeak()->clientGetServerGroupsByDbid($userInfo->client_database_id);
            $teamspeakGroups = $this->getTeamspeak()->clientGetServerGroupsByDbid($teamspeakUser->teamspeak_id);

            // Compare with Protected/Ignored Server Groups (Guest etc)
            //
            //
            /////////////////////////////////////////////////////////////


            $memberOfGroups = [];
            foreach ($teamspeakGroups as $g) {
                    $memberOfGroups[] = $g['sgid'];
            }
            // if key are not valid OR account no longer paid
            // kick the user from all channels to which he's member
            if ($this->isEnabledKey($keys) == false || $this->isActive($keys) == false) {
                if (!empty($teamspeakGroups)) {
                    $this->processGroupsKick($userInfo, $memberOfGroups);
                    $this->logEvent('kick', $teamspeakGroups);

                }

                return;
            }

            // in other way, compute the gap and kick only the user
            // to channel from which he's no longer granted to be in
            $allowedGroups = $this->allowedGroups($teamspeakUser, true);
            $extraGroups = array_diff($memberOfGroups, $allowedGroups);

            // remove granted channels from channels in which user is already in and kick him
            if (!empty($extraGroups)) {
                $this->logEvent('kick', $extraGroups);
                $this->processGroupsKick($userInfo, $extraGroups);

            }
        }

        return;
    }

    /**
     * Kick an user from each group
     *
     * @param \TeamSpeak3_Node_Client $teamspeakClientNode
     * @param $groups
     * @throws \ZeroServer\Teamspeak\Exceptions\TeamspeakServerGroupException
     */
    private function processGroupsKick($teamspeakClientNode, $groups)
    {
        $this->logEvent('status', 'Groups:' . serialize($groups));
        foreach ($groups as $groupId) {
            if($groupId != 8) {
                $this->getTeamspeak()->serverGroupClientDel($groupId, $teamspeakClientNode->client_database_id);
            }
        }
    }

}
