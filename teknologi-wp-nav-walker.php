<?php

/**
 * Plugin Name: Danish Board of Technology nav walker
 * Description: Custom nav walker for WordPress customised for sites built by The Danish Board of Technology
 * Version: 1.0.0
 * Plugin URI: https://github.com/teknologi/teknologi-wp-nav-walker
 * Author: Hans Czajkowski Jørgensen
 * License:     GPL2

 * Danish Board of Technology nav walker is free software: you can redistribute
 * it and/or modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 2 of the
 * License, or any later version.
*
 * Danish Board of Technology nav walker is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with Danish Board of Technology nav walker. If not, see
 * https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html.
*/
namespace Teknologi_Nav_Walker;

/**
 * Custom nav walker
 */

class Teknologi_Nav_Walker
{
    public function __construct()
    {
        add_filter( 'nav_menu_submenu_css_class', array($this, 'nav_walker_submenu_class'), 10, 3 );
        add_filter( 'nav_menu_css_class', array($this, 'nav_walker_list_item_class'), 10, 4 );
        add_filter( 'nav_menu_item_id', array($this, 'nav_walker_list_item_id'), 10, 4 );
    }

    /**
     * Filter to modify the default submenu css class of this walker
     *
     * Rewrites the default "sub-menu" class to "nav-dropdown"
     *
     */
    public function nav_walker_submenu_class( $classes, $args, $depth ) {
        if (get_class($args->walker) == 'Teknologi_Nav_Walker\Walker_Nav_Menu') {
        foreach ( $classes as $key => $class ) {
            if ( $class == 'sub-menu' ) {
            $classes[ $key ] = 'nav-dropdown';
            }
        }
        }
        return $classes;
    }

    /**
     * Filter to modify the default list item css classes of this walker
     *
     * Erases all classes from list items
     *
     */
    public function nav_walker_list_item_class( $classes, $item, $args, $depth ) {
        if (get_class($args->walker) == 'Teknologi_Nav_Walker\Walker_Nav_Menu') {
        $extra_classes = [];

        if (in_array('current-menu-item', $classes) ) {
            $extra_classes[] = 'active';
        }

        $classes = $extra_classes;

        }
        return $classes;
    }

    /**
     * Filter to modify the default list item css ids of this walker
     *
     * Erases all ids from list items
     *
     */
    public function nav_walker_list_item_id( $menu_id, $item, $args, $depth ) {
        if (get_class($args->walker) == 'Teknologi_Nav_Walker\Walker_Nav_Menu') {
        $menu_id = null;
        }
        return $menu_id;
    }

    public function teknologi_nav_walker_load_plugin_textdomain() {
        load_plugin_textdomain( 'teknologi_nav_walker', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
    }
}

function load() {
    include_once "walker_nav_menu_class.php";

    $teknologi_nav_walker = new Teknologi_Nav_Walker();
    $teknologi_nav_walker->teknologi_nav_walker_load_plugin_textdomain();

}

add_action('plugins_loaded', 'Teknologi_Nav_Walker\load');
