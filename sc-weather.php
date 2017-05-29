<?php
/*
Plugin Name: SC-Weather
Plugin URI: https://github.com/Surfing-Chef/Dark
Description: Uses a wrapper to display a weather
feed from Darksky.net
Version: 1.1
Author: Surfing-Chef
Author URI: https://github.com/Surfing-Chef
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: sc-weather
Domain Path:

SC-Weather is free software: you can redistribute it
and/or modify it under the terms of the GNU General Public License
as published by the Free Software Foundation,
either version 2 of the License, or any later version.

SC-Weather is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
*/

// Functions
function display_weather (){
  require_once 'sc-weather-page.php';
};
add_shortcode( 'sc_weather', 'display_weather' );
