#TO DO  

###Setup Git and Basic Folder Structure:  
dark/
   git/  
   .gitignore  
   sc-weather.php  
   README.md   

###Use Composer to Install Darksky API Wrapper Package  
A link to download and install instructions can be found [here](https://getcomposer.org/).  Ensure all command prompts/consoles are restarted after installing before using composer.  Copy the *require script* from the top of the page for the "Drop dead simple Dark Sky API wrapper" by Guilherme Uhelski from (here)[https://packagist.org/packages/guhelski/forecast-php]. Navigate the console to the root of the project directory and paste the *require script* at the command prompt to install the package.

####folder stucture  
dark/
   git/  
   vendor/  
   .gitignore  
   composer.json  
   composer.lock  
   README.md  
   sc-weather.php  

###Create Plugin Logic
Implement a security catch for php files
Get the API token from secure location (**adjust for deployment**).  Next, load the Composer based dependencies and import the Darksky wrapper namespace.  

We create a function that creates/updates a forecast cache file.  The function takes three parameters - longitude, latitude, and api token.  The function instantiates a new Forecast object and creates a json string to export to the cache file.

The new json cache file contains all data to parse and display.  By using CRON on the server side, it will update as often as desired with new forecast date, to be displayed and refreshed by site browsing.

A parse function will read the json contents to astring, convert them to an array and display the data as formatted html tags and content.

####folder stucture  
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

###convert to a Plugin

###shortcode will take lat and long for forecast area(s)

##LINKS USED:
(Making a WordPress Plugin...)[https://www.smashingmagazine.com/2016/03/making-a-wordpress-plugin-that-uses-service-apis/]  
(Namespaces)[https://www.sitepoint.com/php-53-namespaces-basics/]  
(PHP OOP)[http://www.killerphp.com/tutorials/object-oriented-php/]  
(Darksky.net)[https://darksky.net/dev/]   
