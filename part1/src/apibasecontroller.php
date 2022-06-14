<?php
/**
 *  Process generic api request
 * 
 * @author Bob Auchterlounie
 */
class ApiBaseController extends Controller {

    /**
    * Processes generic api request
    *
    * This function returns the generic api information about the website
    *
    *
    * @param array $data    an associative array containing data about the api
    */
    protected function processRequest() {

        $data['name'] = "Bob Auchterlounie";
        $data['id'] = "w123456789";
        $data['message'] = "This is a basic Web API, other APIS can be accessed by entering /apiname after the end of this url. These api pages will display in json format the results from the queried sql statement from the dis.sqlite and user.sqlite databases";
        return $data;
    }
}