<?php
/**
 *  Generic gateway used to get and set the database and resultset
 * 
 * 
 * @author Bob Auchterlounie
 */
abstract class Gateway {

    private $database;
    private $result;

    /*
    * Setter for the database connection
    */
    protected function setDatabase($database) {
        $this->database = new Database($database);
    }

    /*
    * Getter for the database connection
    */
    protected function getDatabase() {
        return $this->database;
    }

    /*
    * Setter for the base result to be queried in other gateways 
    */
    protected function setResult($result) {
        $this->result = $result;
    }

    /*
    * Getter for the base result to be queried in other gateways
    */
    public function getResult() {
        return $this->result;
    }
}