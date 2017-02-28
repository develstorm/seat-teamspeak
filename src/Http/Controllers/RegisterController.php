<?php

namespace ZeroServer\Teamspeak\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use TSFramework;
//use Ts3Exception;
use ZeroServer\Teamspeak;
use ZeroServer\Teamspeak\Http\Controllers\Controller;
use Seat\Web\Models\User;
use Seat\Services\Repositories\Configuration\UserRespository;
use ZeroServer\Teamspeak\Models\TeamspeakUser;


class RegisterController extends Controller
{
    use UserRespository;


    public function index()
    {
        $info = \TSFramework::getInfo();
        $viewer = \TSFramework::getViewer(new TSFramework\Viewer\Html("img/", "img/countries/", "data:image"));

        $user = $this->getUser(auth()->user()->id);
        $nick = setting('main_character_name');
        $status = $this->get_status($nick, $user);
        $client = $this->get_uid($status, $nick);

        $ts = TeamspeakUser::where('user_id', $user->id)
            ->value('teamspeak_uid');

        return view('teamspeak::overview.register', compact('status', 'user', 'client', 'info', 'viewer', 'ts'));
    }
    public function saveUID()
    {
        // Update the settings
        $user = $this->getUser(auth()->user()->id);
        $nick = setting('main_character_name');
        $status = $this->get_status($nick, $user);
        $client = $this->get_uid($status, $nick);
        $uid = $client['client_unique_identifier'];
        $dbid = $client['client_database_id'];



            if(!TeamspeakUser::where('user_id', $user->id)
                ->value('teamspeak_uid')) {
                TeamspeakUser::create([
                    'user_id' => $user->id,
                    'teamspeak_id' => $dbid,
                    'teamspeak_uid' => $uid,
                    'invited' => 1,
                ]);
            }else{
                TeamspeakUser::where('user_id', $user->id)
                    ->update(['teamspeak_uid' => $uid,
                              'teamspeak_id' => $dbid]);
            }


        return redirect()->back()
            ->with('success', 'Teamspeak settings updated!');
    }
    public function get_uid($status, $nick)
    {

        foreach($status as $clients)
        {
        if($clients == $nick){
                return $clients;
            }
        }
    }
    public function get_nick($status, $uid)
    {
        foreach($status as $clients)
        {
        if($clients == $uid){
                return $clients;
            }
        }
    }
    public function get_status($nick, $user = NULL)
    {


        $return['status'] = 0;
        try{
            $return['client'] = TSFramework::clientGetByName($nick);
            $return['status'] += 1;
        }
        catch (\Exception $e){
            $return['status'] += 0;
        }
        try{
            if($user != NULL) {
                $uid = TeamspeakUser::where('user_id', $user->id)
                    ->value('teamspeak_uid');
            }
            $return['user'] = TSFramework::clientGetByUID($uid);
            $return['status'] += 2;
        }
        catch (\Exception $e){
            $return['status'] += 0;
        }

        return $return;
    }


}