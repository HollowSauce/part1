<?php
//Autoloads all files in the src folder as to not need to import them at the top of every file
/** 
* Autoload
*
* This function autoloads all files in the src folder as to not need to import them 
* at the top of every file since programming OO each class has its own file.
* 
*
* @param string  $className    holds the name of the class currently being loaded
* @param string $filename      gets class name and adds the correct directory to it  
*/
function autoloader($className) {
    $filename = "src\\" . strtolower($className) . ".php";
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $filename);
    if (is_readable($filename)) {
        include_once $filename;
    } else {
        throw new exception("File not found: " . $className . " (" . $filename . ")");
    }
}