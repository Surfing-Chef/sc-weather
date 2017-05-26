<?php
/*
Plugin Name: SC-Weather
Description: Implement darksky.net feed into WordPress
Version: 0.1
Author: Surfing-Chef
License: GPLv2 or later
Text Domain: sc-weather
*/

// WorPress check to deny direct access to the file
//defined( 'ABSPATH' ) or die( "I don't like the way you're looking at me!" );

// API
require_once 'api.php';

// Composer dependencies
require_once 'vendor/autoload.php';

// Import Forecast namespace
use Forecast\Forecast;
