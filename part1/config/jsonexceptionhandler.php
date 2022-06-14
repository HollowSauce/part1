<?php 
    /** 
    *JSON ERROR
    *
    * This function retrieves the exception, gets the information of the exception and then
    * outputs it in JSON format
    *
    * @param string $e      string pointing to the exception object holding all information of it
    */
function JSONexceptionHandler($e) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $output['error'] = "internal server error! (Status 500)";

    if (DEVELOPMENT_MODE) {
        $output['Message'] = $e->getMessage();
        $output['File'] = $e->getFile();
        $output['Line'] = $e->getLine();
    }

    echo json_encode($output);
}