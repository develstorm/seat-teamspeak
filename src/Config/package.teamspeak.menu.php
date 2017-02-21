<?php

/*
 * This file is part of SeAT
 *
 * Copyright (C) 2015, 2016, 2017  Leon Jacobs
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

return [
    [
        'name'           => 'info',
        'label'          => 'Overview',
        'permission'     => 'teamspeak.info',
        'highlight_view' => 'info',
        'route'          => 'teamspeak.info',
    ],
    [
        'name'           => 'register',
        'label'          => 'Registration',
        'permission'     => 'teamspeak.register',
        'highlight_view' => 'register',
        'route'          => 'teamspeak.view.register',
    ],
    [
        'name'           => 'config',
        'label'          => 'Settings',
        'permission'     => 'teamspeak.config',
        'highlight_view' => 'config',
        'route'          => 'teamspeak.list',
    ],
//    [
//        'name'           => 'Permissions',
//        'label'          => 'web::seat.channels',
//        'permission'     => 'character.channels',
//        'highlight_view' => 'channels',
//        'route'          => 'character.view.channels',
//    ],
//    [
//        'name'           => 'Alliance',
//        'label'          => 'web::seat.contacts',
//        'permission'     => 'character.contacts',
//        'highlight_view' => 'contacts',
//        'route'          => 'character.view.contacts',
//    ],
//    [
//        'name'           => 'Corps',
//        'label'          => 'web::seat.contracts',
//        'permission'     => 'character.contracts',
//        'highlight_view' => 'contracts',
//        'route'          => 'character.view.contracts',
//    ],
//    [
//        'name'           => 'Blues',
//        'label'          => 'web::seat.industry',
//        'permission'     => 'character.industry',
//        'highlight_view' => 'industry',
//        'route'          => 'character.view.industry',
//    ],
//    [
//        'name'           => 'Whitelist',
//        'label'          => 'web::seat.intel',
//        'permission'     => 'character.intel',
//        'highlight_view' => 'intel',
//        'route'          => 'character.view.intel.summary',
//    ],
//    [
//        'name'           => 'Directors',
//        'label'          => 'web::seat.killmails',
//        'permission'     => 'character.killmails',
//        'highlight_view' => 'killmails',
//        'route'          => 'character.view.killmails',
//    ],
//    [
//        'name'           => 'mail',
//        'label'          => 'web::seat.mail',
//        'permission'     => 'character.mail',
//        'highlight_view' => 'mail',
//        'route'          => 'character.view.mail',
//    ],

];
