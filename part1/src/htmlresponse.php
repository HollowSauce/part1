<?php 

/**
 *  Defines HTML response
 * 
 * 
 * @author Bob Auchterlounie
 */
class HTMLResponse extends Response
{   
    /*
    * Sets the base content type for the HTML response
    */
    protected function headers() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: text/html; charset=UTF-8");
    }
}