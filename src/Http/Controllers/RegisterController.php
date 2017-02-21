<?php

namespace ZeroServer\Teamspeak\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use TSFramework;
use Ts3Exception;
use ZeroServer\Teamspeak;
use ZeroServer\Teamspeak\Http\Controllers\Controller;
use Seat\Web\Models\User;
use Seat\Services\Repositories\Configuration\UserRespository;


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

        return view('teamspeak::overview.register', compact('status', 'user', 'client', 'info', 'viewer'));
    }
    public function saveUID()
    {
        // Update the settings
        $user = $this->getUser(auth()->user()->id);
        $nick = setting('main_character_name');
        $status = $this->get_status($nick, $user);
        $uid = $this->get_uid($status, $nick);
        $uid = $uid['client_unique_identifier'];

        $user->TsUID  = $uid;

        $user->save();

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
            $return['user'] = TSFramework::clientGetByUID($user->TsUID);
            $return['status'] += 2;
        }
        catch (\Exception $e){
            $return['status'] += 0;
        }

        return $return;
    }


}