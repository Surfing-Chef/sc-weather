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

forecast_cache ( '50.296256', '-117.685750', $api );

// Pre-parse forecast cache file.
function parse_cache($timeFrame=''){
  /*
    * $timeFrame has three possible values:
    * currently, hourly, daily
  */

  // Get json string
  $string = file_get_contents("forecast.json");

  // Convert to array
  $array = json_decode($string, true);

  // If $timeFrame is specified
  if ($timeFrame != ''){
    $array = $array[$timeFrame];
  }

  return $array;
}

// Output cache data
function output_cache($timeFrame, $key){

  if($timeFrame == "currently"){
    $timeFrame = parse_cache( 'currently' );
  } else if ($timeFrame == "hourly"){
    $timeFrame = parse_cache( 'hourly' );
  } else if ($timeFrame == "daily"){
    $timeFrame = parse_cache( 'daily' );
  }

  return $timeFrame[$key];
}

// Convert bearing to direction
function getDirection($bearing)
{
 $cardinalDirections = array(
  'N' => array(337.5, 22.5),
  'NE' => array(22.5, 67.5),
  'E' => array(67.5, 112.5),
  'SE' => array(112.5, 157.5),
  'S' => array(157.5, 202.5),
  'SW' => array(202.5, 247.5),
  'W' => array(247.5, 292.5),
  'NW' => array(292.5, 337.5)
 );

 foreach ($cardinalDirections as $dir => $angles)
 {
  if ($bearing >= $angles[0] && $bearing < $angles[1])
  {
   $direction = $dir;
   break;
  }
 }
 return $direction;
}

?>
