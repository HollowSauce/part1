<?php

//auto load all src fils
include 'config/autoloader.php';
spl_autoload_register("autoloader");

//defining to once place the base directory to one place for the website to reuse
define('BASEPATH', '/kf6012/coursework/part1/');

//defining to once place the directories of the databases to reuse
define('DATABASE', 'db/dis.sqlite');
define('USER_DATABASE', 'db/user.sqlite');

// Secret key used for generating the token
define('SECRET_KEY', 'w18013532');

//setting developer mode to true for debugging
define('DEVELOPMENT_MODE', true);
ini_set('display_errors', DEVELOPMENT_MODE);
ini_set('display_startup_errors', DEVELOPMENT_MODE);

//including exception handlers as they are not in the src folder for the autoloader
include 'config/htmlexceptionhandler.php';
include 'config/jsonexceptionhandler.php';
set_exception_handler("JSONexceptionHandler");
include 'config/errorhandler.php';
set_error_handler("errorHandler");
