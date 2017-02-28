<?php



    Route::get('/teamspeak/viewer', function(\TSFramework\Teamspeak $ts) {
        //Route::get('/teamspeak', function(\par0noid\ts3admin\ts3admin $ts) {
        $result = $ts->clientList();
        if($ts->succeeded($result)) {
            $users = $ts->getElement("data", $result);
            return $users;
        } else {
            return "Connection failed";
    }
    });


