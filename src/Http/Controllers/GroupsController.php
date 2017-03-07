<?php

namespace ZeroServer\Teamspeak\Http\Controllers;

use ZeroServer\Teamspeak\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Seat\Eveapi\Models\Corporation\CorporationSheet;
use Seat\Eveapi\Models\Eve\AllianceList;
use Seat\Services\Settings\Seat;
use ZeroServer\Teamspeak\Models\TeamspeakGroup;
use ZeroServer\Teamspeak\Models\TeamspeakGroupPublic;
use ZeroServer\Teamspeak\Models\TeamspeakGroupUser;
use ZeroServer\Teamspeak\Models\TeamspeakGroupRole;
use ZeroServer\Teamspeak\Models\TeamspeakGroupCorporation;
use ZeroServer\Teamspeak\Models\TeamspeakGroupAlliance;
use ZeroServer\Teamspeak\Models\TeamspeakLog;
use ZeroServer\Teamspeak\Validation\AddRelation;
use ZeroServer\Teamspeak\Validation\ValidateGroup;
use Seat\Web\Models\Acl\Role;
use Seat\Web\Models\User;
use Seat\Eveapi\Models\Eve\AllianceListMemberCorporations;

class GroupsController extends Controller
{
    public function getList()
    {
        $groups = TeamspeakGroup::all();
        $template = Seat::get('teamspeak_corp_template');
        $aid = '99003995';
        $allianceCorps = AllianceListMemberCorporations::where('allianceID', '=', $aid)->get();

        return view('teamspeak::admin.partials.groups', compact('groups', 'allianceCorps', 'template'));
    }

    public function enableGroup($groupID){
        
        $teamspeakGroup = TeamspeakGroup::find($groupID);
        $teamspeakGroup->update([
            'is_server_group' => 1
        ]);
        return redirect()->back()
            ->with('success', 'Group Enabled');
        
    }
    public function disableGroup($groupID){

        $teamspeakGroup = TeamspeakGroup::find($groupID);
        $teamspeakGroup->update([
            'is_server_group' => 0
        ]);
        return redirect()->back()
            ->with('success', 'Group Disabled');

    }
    public function postTemplate(ValidateGroup $request){

        Seat::set('teamspeak_corp_template', $request->input('corp-template'));
        return redirect()->back()
            ->with('success', 'Template Group Set');
    }
    
    
    
    
    
    public function createServerGroup(){

    }
    public function deleteServerGroup(){

    }
    public function createSpecialGroup(){

    }
    public function deleteSpecialGroup(){

    }
    public function createCorpGroup(){

    }
    public function deleteCorpGroup(){

    }
    public function roleToggleSync(){

    }




}