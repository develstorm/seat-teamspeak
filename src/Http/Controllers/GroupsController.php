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

class GroupsController extends Controller
{
    public function getList()
    {
        $groups = TeamspeakGroup::all();

        return view('teamspeak::admin.partials.groups', compact('groups'));
    }
    public function postDefaults(ValidateGroup $request){

        for($i=1; $i <6; $i++) {

            $old = TeamspeakGroup::where('main_group', '=', $i)->first();
            if(isset($old)){
                $old->main_group = '0';
                $old->save();
            }

            $new = TeamspeakGroup::where('id', '=', $request->input('defaults-' . $i))->first();
            $new->main_group = $i;
            $new->save();
        }

//        set('main_group', 1)
//            ->where($request->input('default-1'));
//        Seat::set('teamspeak_password', $request->input('teamspeak_password'));
//        Seat::set('teamspeak_hostname', $request->input('teamspeak_hostname'));
//        Seat::set('teamspeak_server_query', $request->input('teamspeak_query'));
//        Seat::set('teamspeak_server_port', $request->input('teamspeak_port'));

        return redirect()->back()
            ->with('success', 'Default Groups have been updated');
    }



}