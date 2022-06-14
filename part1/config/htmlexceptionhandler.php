<?php 
    /** 
    * HTML ERROR
    *
    * This function retrieves the exception, gets the information of the exception and then
    * outputs it in HTML format
    *
    * @param string $e      string pointing to the exception object holding all information of it
    */
function HTMLexceptionHandler($e) {
    echo "<p>internal server error! (Status 500)</p>";
        if (DEVELOPMENT_MODE) {
            echo "<p>";
            echo "Message: ".  $e->getMessage();
            echo "<br>File: ". $e->getFile();
            echo "<br>Line: ". $e->getLine();
            echo "</p>";
        }
}