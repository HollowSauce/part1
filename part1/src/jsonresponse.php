<?php 
/**
 *  Defines JSON response
 * 
 * 
 * @author Bob Auchterlounie
 */
class JSONResponse extends Response
{
    private $message;
    /** status code property */
    private $statusCode;

    protected function headers() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
    }

    /** 
    * Set message
    * 
    * This function retrives a specified message and posts it to the error handler
    *
    * @param string $message    specified message made by dev to be postsed it to the error handler
    */
    public function setMessage($message) {
        $this->message = $message;
    }

    /** setter method for status code property */
    public function setStatusCode($statusCode) {
        $this->statusCode = $statusCode;
    }

    public function getData() {
        if (is_null($this->data)) {
            $this->data = [];
        }

        /** set different codes within this conditional */
        if (is_null($this->message)) {
            if (count($this->data) > 0) {
                $this->message = "ok";
                $this->setStatusCode(200);
            } else {
                $this->message = "no content";
                $this->setStatusCode(204);
            }
        }
      
        /** return the given code */
        http_response_code($this->statusCode);

        $response['message'] = $this->message;
        $response['count'] = count($this->data);
        $response['results'] = $this->data;

        return json_encode($response);
    }
}
