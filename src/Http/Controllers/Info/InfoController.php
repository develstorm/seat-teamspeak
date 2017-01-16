<?php
/*
This file is part of SeAT

Copyright (C) 2015, 2016  Leon Jacobs

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

namespace ZeroServer\Teamspeak\Http\Controllers\Info;

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
        //$clients = \TSFramework::clientList();
        $info = \TSFramework::getInfo();
        $count = \TSFramework::clientCount();
        $clients = \TSFramework::clientList();
        $viewer = \TSFramework::getViewer(new TSFramework\Viewer\Html("img/", "img/", "data:image"));
        //$runtime = \TSFramework::getRuntime();

        return view('teamspeak::info', compact('info', 'count', 'clients', 'viewer'));
    }

    public function viewer()
    {
        return view('teamspeak::viewer');
    }

    public function status()
    {
        //
    }

    /**
     * Helper function to sort users inside channels.
     */
    function sortUsers($a, $b) {

        return strcasecmp($a["client_nickname"], $b["client_nickname"]);

    }


    /**
     * Replace Teamspeak 3 server query characters with proper ones.
     */
    function unescape($str, $reverse = FALSE) {

        $find = array(
            '\\\\',
            "\/",
            "\s",
            "\p",
            "\a",
            "\b",
            "\f",
            "\n",
            "\r",
            "\t",
            "\v");

        $rplc = array(
            chr(92),
            chr(47),
            chr(32),
            chr(124),
            chr(7),
            chr(8),
            chr(12),
            chr(10),
            chr(3),
            chr(9),
            chr(11));

        if (!$reverse) {
            return str_replace($find, $rplc, $str);
        }

        return str_replace($rplc, $find, $str);

    }


    /**
     * Parse a server query response line.
     */
    function parseLine($raw_line) {

        $data = array();
        $raw_items = explode("|", $raw_line);
        foreach ($raw_items as $raw_item) {
            $raw_data = explode(" ", $raw_item);
            $temp_data = array();
            foreach ($raw_data as $r) {
                $a = explode("=", $r, 2);
                $temp_data[$a[0]] = isset($a[1]) ? unescape($a[1]) : "";
            }
            $data[] = $temp_data;
        }
        return $data;

    }


    /**
     * Send a command to the Teamspeak 3 server and return the response.
     */
    function sendCommand($socket, $command) {

        $response = '';
        fwrite($socket, "$command\n");

        do {
            // Read the server response.
            $response .= fread($socket, 8096);
        } while (strpos($response, 'error id=') === FALSE);

        if (strpos($response, "error id=0") === FALSE) {
            throw new Exception("The server returned the following error: " . unescape(trim($response)));
        }

        return $response;

    }

    /**
     * Render the Teamspeak 3 users list.
     */
    function renderUsers($usersdata, $parent_id, $imagespath)
    {

        $output = '';
        foreach ($usersdata as $user) {

            if ($user["client_type"] == 0 && $user["cid"] == $parent_id) {

                $icon = "16x16_player_off.png";

                if ($user["client_away"] == 1) {
                    $icon = "16x16_away.png";
                } elseif ($user["client_flag_talking"] == 1) {
                    $icon = "16x16_player_on.png";
                } elseif ($user["client_output_hardware"] == 0) {
                    $icon = "16x16_hardware_output_muted.png";
                } elseif ($user["client_output_muted"] == 1) {
                    $icon = "16x16_output_muted.png";
                } elseif ($user["client_input_hardware"] == 0) {
                    $icon = "16x16_hardware_input_muted.png";
                } elseif ($user["client_input_muted"] == 1) {
                    $icon = "16x16_input_muted.png";
                }

                $output .= '<div class="teamspeak-item">';
                $output .= '<div class="teamspeak-label">';
                $output .= '<img src="' . $imagespath . $icon . '" />' . htmlentities($user["client_nickname"], ENT_COMPAT, "ISO-8859-1");
                $output .= '</div></div>';

            }
        }

        return $output;

    }

    /**
     * Render a Teamspeak 3 spacer.
     */
    function renderSpacer($spacer)
    {

        $output = NULL;
        /*$spacer = preg_replace('/\[\w*\]/', '', $spacer);
        $output .= '<div class="teamspeak-item">';
        $output .= '<div class="teamspeak-spacer">';
        $output .= ($spacer == "___") ? '<hr class="teamspeak-spacer-line" />' : $spacer;
        $output .= '</div>';
        $output .= '</div>';*/
        return $output;

    }

    /**
     * Render the Teamspeak 3 channels list.
     */
    function renderChannels($channelsdata, $usersdata, $parent_id, $imagespath)
    {

        $output = '';
        foreach ($channelsdata as $channel) {

            if ($channel["pid"] == $parent_id) {

                if (stristr($channel["channel_name"], 'spacer')) {

                    $output .= renderSpacer($channel["channel_name"]);
                    $output .= renderChannels($channelsdata, $usersdata, $channel["cid"], $imagespath);

                } else {

                    $icon = "16x16_channel_green.png";
                    if ($channel["channel_maxclients"] > -1 && ($channel["total_clients"] >= $channel["channel_maxclients"])) {
                        // Full channel.
                        $icon = "16x16_channel_red.png";
                    } elseif ($channel["channel_maxfamilyclients"] > -1 && ($channel["total_clients_family"] >= $channel["channel_maxfamilyclients"])) {
                        // Unjoinable channel.
                        $icon = "16x16_channel_red.png";
                    } elseif ($channel["channel_flag_password"] == 1) {
                        // Password channel.
                        $icon = "16x16_channel_yellow.png";
                    }

                    $output .= '<div class="teamspeak-item">';
                    $output .= '<div class="teamspeak-label">';
                    $output .= '<img src="' . $imagespath . $icon . '" />' . htmlentities($channel["channel_name"]);
                    $output .= '</div>';

                    if (count($usersdata) > 0 && !stristr($channel["channel_name"], 'ADMIN')) {
                        // If the channel is not empty, render the users.
                        $output .= renderUsers($usersdata, $channel["cid"], $imagespath);
                    }

                    $output .= renderChannels($channelsdata, $usersdata, $channel["cid"], $imagespath);
                    $output .= '</div>';
                }

            }

        }

        return $output;

    }

    /**
     * Return the Teamspeak block HTML content.
     */
    function render()
    {

        $output = '';
        $socket = $this;

        $serverdata = array();
        $channelsdata = array();
        $usersdata = array();

        $imagespath = asset('/teamspeak/img/');

        $response = "";
        $response .= execute("serverinfo");
        $response .= execute("channellist -topic -flags -voice -limits");
        $response .= execute("clientlist -uid -away -voice -groups");
        $response .= execute("servergrouplist");
        $response .= execute("channelgrouplist");
        $response = utf8_decode($response);

        $lines = explode("error id=0 msg=ok\n\r", $response);

        if (count($lines) == 7) {

            $serverdata = parseLine($lines[1]);
            $serverdata = $serverdata[0];
            $channelsdata = parseLine($lines[2]);
            $usersdata = parseLine($lines[3]);
            usort($usersdata, "sort_users");

            // Render the block content.
            $output .= '<div class="teamspeak-viewer">';

            $output .= '<div class="teamspeak-server-name"><img src="' . $imagespath . '16x16_server_green.png" />' . $serverdata["virtualserver_name"] . "</div>";
            if (count($channelsdata) > 0) {
                $output .= renderChannels($channelsdata, $usersdata, 0, $imagespath);
            }

            $output .= '</div>';


        } else {
            // Not a proper server query response.
            print_r("Invalid Teamspeak 3 server response");
        }

        return $output;

    }
}
