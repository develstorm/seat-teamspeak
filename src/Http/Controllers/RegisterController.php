<?php

namespace ZeroServer\Teamspeak\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use TSFramework;
use ZeroServer\Teamspeak\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('teamspeak::overview.register');
    }


}