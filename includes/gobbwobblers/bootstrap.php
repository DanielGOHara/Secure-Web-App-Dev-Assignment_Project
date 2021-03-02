<?php
/**
* bootstrap.php
* Description: Run at install/connection time from the index.php - Links to all other files
* Author: Lewis Harris
* Email: <p2419279@my365.dmu.ac.uk>
* Updated: 17/01/2021
**/

//start the session
session_start();

//spoof a database connection
$GLOBALS['spoofDatabase'] = false;

//load the autoload.php from includes/vendor directory -> composer's autoload
require 'vendor/autoload.php';

//load app settings
$settings = require __DIR__ . '/app/settings.php';

//create the Slim container with app settings
$container = new \Slim\Container($settings);

//load the app dependencies and attach dependencies to the container in that file
require __DIR__ . '/app/dependencies.php';

//attach container (with loaded dependencies) to a new Slim app
$app = new \Slim\App($container);

//load app routes
require __DIR__ . '/app/routes.php';

//run the Slim application
$app->run();

//session_regenerate_id(true);