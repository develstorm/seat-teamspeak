<?php

Route::group([
    'namespace'  => 'ZeroServer\Teamspeak\Http\Controllers',
    'middleware' => 'web',   // Web middleware for state etc since L5.3
    'prefix' => 'teamspeak',
], function () {


            Route::get('/list', [
                'as' => 'teamspeak.list',
                'uses' => 'TeamspeakController@getRelations',
                'middleware' => 'bouncer:teamspeak.view'
            ]);

            Route::get('/public/{group_id}/remove', [
                'as' => 'teamspeak.public.remove',
                'uses' => 'TeamspeakController@getRemovePublic',
                'middleware' => 'bouncer:teamspeak.create'
            ]);

            Route::get('/users/{user_id}/{group_id}/remove', [
                'as' => 'teamspeak.user.remove',
                'uses' => 'TeamspeakController@getRemoveUser',
                'middleware' => 'bouncer:teamspeak.create'
            ]);

            Route::get('/roles/{role_id}/{group_id}/remove', [
                'as' => 'teamspeak.role.remove',
                'uses' => 'TeamspeakController@getRemoveRole',
                'middleware' => 'bouncer:teamspeak.create'
            ]);

            Route::get('/corporations/{corporation_id}/{group_id}/remove', [
                'as' => 'teamspeak.corporation.remove',
                'uses' => 'TeamspeakController@getRemoveCorporation',
                'middleware' => 'bouncer:teamspeak.create'
            ]);

            Route::get('/alliances/{alliance_id}/{group_id}/remove', [
                'as' => 'teamspeak.alliance.remove',
                'uses' => 'TeamspeakController@getRemoveAlliance',
                'middleware' => 'bouncer:teamspeak.create'
            ]);

            Route::post('/list', [
                'as' => 'teamspeak.add',
                'uses' => 'TeamspeakController@postRelation',
                'middleware' => 'bouncer:teamspeak.create'
            ]);

            Route::get('/configuration', [
                'as' => 'teamspeak.configuration',
                'uses' => 'TeamspeakController@getConfiguration',
                'middleware' => 'bouncer:teamspeak.config'
            ]);

            Route::get('/logs', [
                'as' => 'teamspeak.logs',
                'uses' => 'TeamspeakController@getLogs',
                'middleware' => 'bouncer:teamspeak.config'
            ]);

            Route::get('/run/{commandName}', [
                'as' => 'teamspeak.command.run',
                'uses' => 'TeamspeakController@getSubmitJob',
                'middleware' => 'bouncer:teamspeak.config'
            ]);

            Route::post('/configuration', [
                'as' => 'teamspeak.configuration.post',
                'uses' => 'TeamspeakController@postConfiguration',
                'middleware' => 'bouncer:teamspeak.config'
            ]);
            Route::get('/info', [
                'as'   => 'teamspeak.info',
                'uses' => 'InfoController@info',
            ]);
            Route::get('/register', [
                'as'   => 'teamspeak.view.register',
                'uses' => 'RegisterController@index',
            ]);
            Route::post('/register', [
                'as'   => 'teamspeak.register.save',
                'uses' => 'RegisterController@saveUID',
            ]);
            Route::get('/groups', [
                'as' => 'teamspeak.groups',
                'uses' =>'GroupsController@getList',
                'middleware' => 'bouncer:teamspeak.config'
            ]);
            Route::post('/groups', [
                'as' => 'teamspeak.defaults.post',
                'uses' =>'GroupsController@postDefaults',
                'middleware' => 'bouncer:teamspeak.config'
            ]);


<<<<<<< HEAD
// Namespace all of the routes for this package.
Route::group([
<<<<<<< HEAD
    'namespace'  => 'Vendor\Name\Http\Controllers',
    'middleware' => 'web'
], function () {

    // Your route definitions go here.
    Route::get('/home', [
        'as'   => 'home',
        'uses' => 'HomeController@getHome'
    ]);
=======
    'namespace'  => 'Seat\Teamspeak\Http\Controllers',
    'prefix' => 'teamspeak'
    'middleware' => 'bouncer:superuser'   // Web middleware for state etc since L5.3
], function () {
=======
>>>>>>> e9f58948438002598dc3319caa46aca3150c5edc

});

Route::group([
        'namespace'  => 'teamspeak',
        //'middleware' => 'teamspeak.auth',
        'prefix'     => 'teamspeak',
    ], function () {
>>>>>>> seat-teamspeak/master

});
