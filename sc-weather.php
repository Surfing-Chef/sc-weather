<?php
/*
Plugin Name: SC-Weather
Description: Implement darksky.net feed into WordPress
Version: 1.0
Author: Surfing-Chef
License: GPLv2 or later
Text Domain: sc-weather
*/

// WordPress check to deny direct access to the file
//defined( 'ABSPATH' ) or die( "Error: contact admin@surfing-chef.com" );

// API
require_once 'api.php';

// Composer dependencies
require_once 'vendor/autoload.php';

// Import Forecast namespace
use Forecast\Forecast;

// Create a forecast cache file.
function forecast_cache ( $lat, $long, $token ){
  /*
   * $lat and $long are latitude and longitude respectively
   * of location for forecast data retrieval
   */

   // Instantiate a new Forecast object
   $forecast = new Forecast( $token );

   // Get forecast object as json string
   $options = json_encode( $forecast->get(
     $lat,
     $long,
     null,
     array(
       'units' => 'si',
       'exclude' => 'flags'
     )
   ));

   // Store json string to file
  $fp = fopen( 'forecast.json', 'w' );
  fwrite( $fp, $options );
  fclose( $fp );
}

forecast_cache ( '37.8267', '-122.423', $api );

function parse_cache(){
  // Get json string
  $string = file_get_contents("forecast.json");

  // Convert to array
  $array = json_decode($string, true);

  echo "<pre>";
  print_r( $json_a['currently'] );
  echo "</pre>";

}

parse_cache();
