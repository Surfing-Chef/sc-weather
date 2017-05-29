# SC-Weather - A Darksky.net Weather Feed  
> ### version 1.1  
> > Moved to WordPress development environment

### Setup Git and Basic Folder Structure:  
dark/
   git/  
   .gitignore  
   sc-weather.php  
   README.md   

### Use Composer to Install Darksky API Wrapper Package  
A link to download and install instructions can be found [here](https://getcomposer.org/).  Ensure all command prompts/consoles are restarted after installing before using composer.  Copy the *require script* from the top of the page for the "Drop dead simple Dark Sky API wrapper" by Guilherme Uhelski from (here)[https://packagist.org/packages/guhelski/forecast-php]. Navigate the console to the root of the project directory and paste the *require script* at the command prompt to install the package.

#### folder stucture  
dark/
   git/  
   vendor/  
   .gitignore  
   composer.json  
   composer.lock  
   README.md  
   sc-weather.php  

### Create Plugin Logic
Implement a security catch for php files
Get the API token from secure location (**adjust for deployment**).  Next, load the Composer based dependencies and import the Darksky wrapper namespace.  

We create a function that creates/updates a forecast cache file.  The function takes three parameters - longitude, latitude, and api token.  The function instantiates a new Forecast object and creates a json string to export to the cache file.

The new json cache file contains all data to parse and display.  By using CRON on the server side, it will update as often as desired with new forecast date, to be displayed and refreshed by site browsing.

A parse function will read the json contents to astring, convert them to an array and display the data as formatted html tags and content.

#### folder structure  
dark/
   git/  
   vendor/  
   .gitignore  
   api.php  
   composer.json  
   composer.lock  
   forecast.json  
   README.md  
   sc-weather.php  

### More on Parsing Darksky data
The *array* returned from the *json* file is multidimentional with the following keys:
```code
array (size=8)
  'latitude' => float  
  'longitude' => float  
  'timezone' => string  
  'offset' => int  
  'currently' => array  
  'hourly' => array  
  'daily' => array  
  'headers' => array  
```
Drilling down into currently, hourly and daily we see the following keys.
- 'currently':    
```code
array (size=17)
  'time' => int
  'summary' => string
  'icon' => string
  'nearestStormDistance' => int
  'nearestStormBearing' => int
  'precipIntensity' => int
  'precipProbability' => int
  'temperature' => float
  'apparentTemperature' => float
  'dewPoint' => float
  'humidity' => float
  'windSpeed' => float
  'windBearing' => int
  'visibility' => float
  'cloudCover' => float
  'pressure' => float
  'ozone' => float
```  

- 'hourly':  
```code
array (size=3)
  'summary' => string
  'icon' => string
  'data' =>
    array (size=49)
      0 =>
        array (size=15)
          'time' => int
          'summary' => string
          'icon' => string
          'precipIntensity' => int
          'precipProbability' => int
          'temperature' => float
          'apparentTemperature' => float
          'dewPoint' => float
          'humidity' => float
          'windSpeed' => float
          'windBearing' => int
          'visibility' => float
          'cloudCover' => float
          'pressure' => float
          'ozone' => float
      1 =>
      ...
      49 =>
      ...
```  

- 'daily':  
```code
array (size=3)
  'summary' => string
  'icon' => string
  'data' =>
    array (size=8)
      0 =>
        array (size=27)
          'time' => int
          'summary' => string
          'icon' => string
          'sunriseTime' => int
          'sunsetTime' => int
          'moonPhase' => float
          'precipIntensity' => float
          'precipIntensityMax' => float
          'precipIntensityMaxTime' => int
          'precipProbability' => float
          'precipType' => string
          'temperatureMin' => float
          'temperatureMinTime' => int
          'temperatureMax' => float
          'temperatureMaxTime' => int
          'apparentTemperatureMin' => float
          'apparentTemperatureMinTime' => int
          'apparentTemperatureMax' => float
          'apparentTemperatureMaxTime' => int
          'dewPoint' => float
          'humidity' => float
          'windSpeed' => float
          'windBearing' => int
          'visibility' => float
          'cloudCover' => float
          'pressure' => float
          'ozone' => float
        1 =>
        ...
        7 =>
        ...
```  

Using the above array(s) we layout a basic HTML structure for the data.  The default CSS for the plugin will reside in the root folder of the plugin.  The website's stylesheet(s) will further refine these styles where appropriate.  A shortcode makes the plugin available in posts or pages.  

Place this shortcode into a post of page to use: `[sc_weather]`  

#### shortcode short take latitude and longitude for forecast area(s)  

### Create Plugin Settings Options Dashboard
- styles  
- options  

## LINKS USED:
(Making a WordPress Plugin...)[https://www.smashingmagazine.com/2016/03/making-a-wordpress-plugin-that-uses-service-apis/]  
(Namespaces)[https://www.sitepoint.com/php-53-namespaces-basics/]  
(PHP OOP)[http://www.killerphp.com/tutorials/object-oriented-php/]  
(Darksky.net)[https://darksky.net/dev/]  
(Wordpress Plugin Handbook)[https://developer.wordpress.org/plugins/]  
(WordPress Plugin API)[https://codex.wordpress.org/Plugin_API]  
(WordPress Plugin API/Filter Reference)[https://codex.wordpress.org/Plugin_API/Filter_Reference]  
(WordPress Plugin API/Action Reference)[https://codex.wordpress.org/Plugin_API/Action_Reference]  
