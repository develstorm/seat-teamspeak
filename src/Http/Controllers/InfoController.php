<?php

namespace ZeroServer\Teamspeak\Http\Controllers;

use TSFramework;
use ZeroServer\Teamspeak;
use ZeroServer\Teamspeak\Http\Controllers\Controller;


/**
 * Class HomeController
 * @package Vendor\Name\Http\Controllers
 */
class InfoController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function info()
    {
        $info = \TSFramework::getInfo();
        $count = \TSFramework::clientCount();
        $clients = \TSFramework::clientList();
        $viewer = \TSFramework::getViewer(new TSFramework\Viewer\Html("img/", "img/countries/", "data:image"));
        //$runtime = \TSFramework::getRuntime();
        //\Request::setTrustedProxies(array( '188.68.49.45'));

        return view('teamspeak::overview.info', compact('info', 'count', 'clients', 'viewer'));
    }

    public function viewer()
    {
        return view('teamspeak::viewer');
    }

    public function status()
    {
        //
    }

}
