<?php 

/**
 *  Generic response results. used to get and set data
 * 
 * 
 * @author Bob Auchterlounie
 * 
 * @param string $data      holds the data for the response
 */
abstract class Response 
{
    protected $data;

    public function __construct() {
        $this->headers();
    }

    public function setData($data) {
        $this->data = $data;
    }    

    public function getData() {
        return $this->data;
    }
  
    protected function headers() {

    }
}