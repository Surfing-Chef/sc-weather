<?php
// WordPress check to deny direct access to the file
//defined( 'ABSPATH' ) or die( "Error: contact admin@surfing-chef.com" );

// Functions
require_once 'sc-weather-functions.php';

?>
<style>
  figure.icon-current,
  figure.icon-daily,
  figure.icon-daily img {
    border: none !important;
  }

  .container-forecast {
  min-width: 900px;
  height: 250px;
  margin: 0 auto;
  }

  .container-currently {
    width: 25%;
    height: 250px;
    float: left;
  }

    .container-icon-temp {
      display: flex !important;
      flex-direction: row;
      width: 100%;
      padding-bottom: 0 !important;
      margin-bottom: 0 !important;
    }

    .container-icon-temp:after {
      border: none !important;
    }

      .icon-current {
        height: 75px;
        width: 75px;
        background-image: url("<?php echo SCWEATHER_IMG_URL . output_cache('currently', 'icon'); ?>");
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
        margin-right: 1em;
      }

      .temp-current {
        padding-top: 10px;
        font-size: 3em;
      }

    .container-summary-wind {
      display: block;
      width: 100%;
      text-align: center;
    }

      .summary-current {
        font-weight: bold;
      }

  .container-daily {
    display: flex;
    flex-direction: row;
    justify-content: center
    height: 250px;
    width: 60%;
    float: right;
  }

    .daily-day {
      display: flex;
      flex-direction: column;
      width: 4em;
      flex: 1 1;
    }

      h4 {
        margin-bottom: 0;
      }
      .icon-daily {
        flex-grow: 0;
        margin: 0;
      }

        .icon-daily img {
          height: 2em;
        }


</style>

<section id="sc-forecast" class="container-forecast">

  <div class="container-currently">

    <article class="container-icon-temp">

      <figure class="icon-current">
      </figure>

      <div class="temp-current">
        <?php echo round(output_cache('currently', 'temperature')); ?>&deg;
      </div>

    </article>

    <article class="container-summary-wind">

      <div class="summary-current">
        <?php echo output_cache('currently', 'summary'); ?>
      </div>

      <div class="summary-wind">
        Wind: <?php echo round(output_cache('currently', 'windSpeed')); ?> m/s (<?php echo getDirection(round(output_cache('currently', 'windBearing')));?>)
      </div>

    </article>

  </div>

  <div class="container-daily">
    <?php
      // find height of graphical temp display
      // using max and min temps
      $max=-100;
      $min=200;
      foreach (output_cache('daily', 'data') as $key => $value) {
        $tempMax = round($value['temperatureMax']);
        if($max < $tempMax){
          $max = $tempMax;
        }

        $tempMin = round($value['temperatureMin']);
        if($min > $tempMin){
          $min = $tempMin;
        }
      }

      // display data
      $timezone = parse_cache()['timezone'];
      foreach (output_cache('daily', 'data') as $key => $value) {
        echo '<div class="daily-day">';

        // day
        if($key == 0){
          $time = "Today";
        } else {
          $time = $value['time'];
          $time = date('D', $time);
        }
        echo "<h4>$time</h4>";

        // icon
        $icon = $value['icon'];
        echo '<figure class="icon-daily"><img src="'.SCWEATHER_IMG_URL.$icon.'"></figure>';
        //echo $icon;

        // temperatures
        $tempMax = round($value['temperatureMax']);
        $tempMin = round($value['temperatureMin']);

        echo $tempMax;

        // chart temperature
        $temp_height = 5*($tempMax-$tempMin);
        echo '<div class"" style="width: 10px; height: '.$temp_height.'px; background-color: black;"></div>';

        echo $tempMin;



        echo '</div>';
      }
    ?>
  </div>

</section>

<?php
