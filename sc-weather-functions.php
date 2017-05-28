<?php
/*
Description: Functions pertinent to SC-Weather
Version: 1.0
Author: Surfing-Chef
License: GPLv2 or later
Text Domain: sc-weather
Contents:
  // Create a forecast cache file.
  * $lat and $long are latitude and longitude respectively,
  * token is the Darksky API token
  forecast_cache ( $lat, $long, $token );

  // Pre-parse forecast cache file
  * $timeFrame has three possible values:
  * currently, hourly, daily
  *
  parse_cache($timeFrame='');

  // Output cache data
  * $timeFrame has three possible values:
  * currently, hourly, daily
  * $key is dependnet on the sub array of data
  @ link https://github.com/Surfing-Chef/Dark
  function output_cache($timeFrame, $key);
*/

// WordPress check to deny direct access to the file
//defined( 'ABSPATH' ) or die( "Error: contact admin@surfing-chef.com" );

// Pre-parse forecast cache file.
function parse_cache($timeFrame=''){
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
