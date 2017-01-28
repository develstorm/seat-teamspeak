<?php

namespace ZeroServer\Teamspeak\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use TSFramework;
use ZeroServer\Teamspeakw;
use ZeroServer\Teamspeak\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        $User = '555';
        //$User = setting('main_character_name');
        $client = TSFramework::getUniqueID($User);
        $status = '';//$this->get_status($User);

        return view('teamspeak::overview.register', compact('status', 'User', 'client'));
    }
    public function get_main()
    {
        //Check if main_character_id && main_character_name
        // is set in DB: user_settings for User with ID
        // return Name if Set 
        // else: output mainchar settings

    }
    public function get_uid()
    {
        //Get TsUID from DB: users
    }
    public function get_status($User)
    {
        $status = Teamspeak::clientGetByName($User);
        if(isset($status)){
            return $status;
        }else{
            return 'Connected';
        }
    }
    public function set_uid()
    {
        //get the UID from TS Framework and write it to DB
        //+get/write DBID
    }
    public function get()
    {
        //Do something with a Submit Button
    }


}