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

// Functions
require_once 'sc-weather-functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Weather Parse</title>
</head>
<body>
  <section id="sc-forecast" class="container-forecast">

    <div class="container-currently">
      <figure class="icon-current">
        <img src="img/<?php echo output_cache('currently', 'icon'); ?>" alt="Current weather is <?php echo output_cache('currently', 'summary'); ?>">
      </figure>

      <div class="temp-current">
        <?php echo round(output_cache('currently', 'temperature')); ?>&deg;
      </div>

      <div class="summary-current">
        <?php echo output_cache('currently', 'summary'); ?>
      </div>

      <div class="summary-wind">
        Wind: <?php echo round(output_cache('currently', 'windSpeed')); ?> m/s (<?php echo getDirection(round(output_cache('currently', 'windBearing')));?>)
      </div>

    </div>

    <div class="container-daily">
      <?php
        $timezone = parse_cache()['timezone'];
        foreach (output_cache('daily', 'data') as $key => $value) {

          // day
          if($key == 0){
            $time = "Today";
          } else {
            $time = $value['time'];
            $time = date('D', $time);
          }
          echo $time . " => ";

          // icon
          $icon = $value['icon'];
          echo $icon . " => ";

          // high
          $tempMax = round($value['temperatureMax']);
          echo $tempMax . " => ";

          // low
          $tempMin = round($value['temperatureMin']);
          echo $tempMin . "<br/>";

          // chart temperature

        }
      ?>
    </div>

  </section>
</body>
</html>
<?php
