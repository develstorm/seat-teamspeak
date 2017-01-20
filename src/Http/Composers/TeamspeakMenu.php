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

namespace Zeroserver\Teamspeak\Http\Composers;

use Illuminate\Contracts\View\View;
use Seat\Web\Http\Composers\AbstractMenu;

/**
 * Class CharacterMenu.
 * @package Seat\Web\Http\Composers
 */
class TeamspeakMenu extends AbstractMenu
{
    /**
     * Create a new sidebar composer.
     */
    public function __construct()
    {

    }

    /**
     * Return required keys in menu structure.
     *
     * @return array
     */
    public function getRequiredKeys(): array
    {

        return [
            'name', 'permission', 'highlight_view', 'route',
        ];
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {

        // This menu item declares the menu and
        // sets it as an array of arrays.
        $menu = [];

        // Load any package menus
        if (! empty(config('package.teamspeak.menu'))) {

            foreach (config('package.teamspeak.menu') as $menu_data) {

                $prepared_menu = $this->load_plugin_menu('teamspeak', $menu_data);
                array_push($menu, $prepared_menu);

            }
        }

        // Sort the menu alphabetically.
//        $menu = array_values(array_sort($menu, function ($value) {
//
//            return $value['name'];
//
//        }));

        $view->with('menu', $menu);
    }
    public function load_plugin_menu($package_name, $menu_data)
    {

        // Validate the package menu
        $this->validate_menu($package_name, $menu_data);

        // Check if the current user has the permission
        // required to see the menu
        if (isset($menu_data['permission']))
            if (! auth()->user()->has($menu_data['permission'], false))
                return null;

        return $menu_data;
    }

    public function validate_menu($package_name, $menu_data)
    {

        if (! is_string($package_name))
            throw new PackageMenuBuilderException(
                'Package root menu items should be named by string type');

        if (! is_array($menu_data))
            throw new PackageMenuBuilderException(
                'Package menu data should be defined in an array');

        // check if required keys are all sets
        foreach ($this->getRequiredKeys() as $key)
            if (! array_key_exists($key, $menu_data))
                throw new PackageMenuBuilderException(
                    'Menu should contain a ' . $key . ' entry');

        // Check if we have sub entries. If not, we have to
        // check if we have a route defined in the parent
        // menu.
        if (! array_key_exists('entries', $menu_data))
            if (! array_key_exists('route', $menu_data))
                throw new PackageMenuBuilderException(
                    'A parent or sub-menu route is required.');

        // Ensure that the entries is actually an array
        if (array_key_exists('entries', $menu_data) && ! is_array($menu_data['entries']))
            throw new PackageMenuBuilderException(
                'Root menu must define entries');

        // Loop over the sub menu entries, validating the
        // required fields
        if (isset($menu_data['entries'])) {

            foreach ($menu_data['entries'] as $entry) {

                if (! array_key_exists('name', $entry))
                    throw new PackageMenuBuilderException(
                        'A sub menu entry failed to define a name');

                if (! array_key_exists('icon', $entry))
                    throw new PackageMenuBuilderException(
                        'A sub menu entry failed to define an icon');

                if (! array_key_exists('route', $entry))
                    throw new PackageMenuBuilderException(
                        'A sub menu entry failed to define a route');
            }
        }
    }

}
