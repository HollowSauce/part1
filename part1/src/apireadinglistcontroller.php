<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
/**
 *  submit sql request
 * 
 * 
 * @author Bob Auchterlounie
 */
class ApiReadinglistController extends Controller {

    protected function setGateway() {
        $this->gateway = new ReadingListGateway();
    }

    /** 
    * Submit process request
    * This function retrieves the parameter the user inputted once their token is confirmed 
    * executes the correct sql accordingly
    * 
    * @param string $token     the token retrieved from the authenticate api confirming the users login
    * @param string $add    string containing the users inputted paper id to add to the readingList
    * @param string $remove     string containing the users inputted paper id to remove from the readingList
    */
    protected function processRequest() {
        $token = $this->getRequest()->getParameter("token");
        $add = $this->getRequest()->getParameter("add");
        $remove = $this->getRequest()->getParameter("remove");

        $id = $this->getRequest()->getParameter("id");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($token)) {
                $key = SECRET_KEY;
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                $user_id = $decoded->user_id;
                $this->getResponse()->setMessage("Login success");

                if (!is_null($add)) {
                    $this->getGateway()->add($user_id, $add);
                    $result = $this->getGateway()->getResult();
                    if($result == "Invalid"){
                        $this->getResponse()->setMessage("No such ID exists");
                    }else{
                        $this->getResponse()->setMessage("Paper added successfully!");
                    }
                } elseif (!is_null($remove)) {
                    $this->getGateway()->remove($user_id, $remove);
                    $result = $this->getGateway()->getResult();
                    if($result == "Invalid"){
                        $this->getResponse()->setMessage("No such ID exists");
                    }else{
                        $this->getResponse()->setMessage("Paper removed successfully!");
                    }
                } elseif (!is_null($id)) {
                        $this->getGateway()->findIds($user_id);
                } else {
                    $this->getGateway()->findAll($user_id);
                }
            } else {
                $this->getResponse()->setMessage("Unauthorized");
                $this->getResponse()->setStatusCode(401);
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatusCode(405);
        }
        return $this->getGateway()->getResult();
    }
}