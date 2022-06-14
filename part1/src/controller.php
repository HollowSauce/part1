<?php
/**
 *  Generic controller used to get and set request, response and gatewat
 * 
 * 
 * @author Bob Auchterlounie
 * 
 * @param string $response      holds the response defined by the api
 * @param string $request       holds the request defined by the api
 */
abstract class Controller {

    private $request;
    private $reponse;
    protected $gateway;

    public function __construct($request, $response) {
        $this->setGateway();
        $this->setRequest($request);
        $this->setResponse($response);

        $data = $this->processRequest();
        $this->getResponse()->setData($data);
    }

    private function setRequest($request) {
        $this->request = $request;
    }

    protected function getRequest() {
        return $this->request;
    }

    protected function setResponse($response) {
        $this->response = $response;
    }

    protected function getResponse() {
        return $this->response;
    }

    protected function setGateway() {

    }

    protected function getGateway() {
        return $this->gateway;
    }

    protected function processRequest() {

    } 
}