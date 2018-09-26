<?php

//Start Session
session_start();

//Include Configuration
require_once('config/config.php');

//Include Helper function files
require_once('helpers/system_helper.php');
require_once('helpers/format_helper.php');
require_once('helpers/db_helper.php');

//Autoloaded classes
function __autoload($className){
    require_once('libraries/' . $className . '.php');
}