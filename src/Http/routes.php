<?php


Route::group([
    'namespace'  => 'ZeroServer\Teamspeak\Http\Controllers',
    'middleware' => 'web',   // Web middleware for state etc since L5.3
    'prefix' => 'teamspeak',
], function () {


    // All routes from here require *at least* that the
    // user is authenticated. The mfa middleware checks
    // a setting for the user. We also run the localization
    // related logic here for translation support. Lastly,
    // email verification is required to continue.

    //Route::resource('/teamspeak', 'InfoController');
        // Routes from here on may optionally have a multifactor
        // authentication requirement
        //Route::group(['teamspeak'], function () {

            // The home route does not need any prefixes
            // and or namespacing modifications, so we will
            // just include it
            // include __DIR__ . '/Routes/Home.php';

            // Support Routes
            Route::group([
                'namespace' => 'Info',
                'prefix'    => 'info',
            ], function () {
                Route::get('/', [
                    'as'   => 'teamspeak.info',
                    'uses' => 'InfoController@info',
                ]);
            });
            Route::group([
                'namespace' => 'Info',
                'prefix'    => 'Info',
            ], function () {
                Route::get('/', [
                    'as'   => 'teamspeak.viewer',
                    'uses' => 'InfoController@viewer',
                ]);
            });


        //});
    
});
