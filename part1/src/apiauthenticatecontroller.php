<?php
use Firebase\JWT\JWT;
/**
 * Gets the login paramaters and creates a special token
 * 
 * 
 * @author Bob Auchterlounie
 */
class ApiAuthenticateController extends Controller {
    
    protected function setGateway() {
        $this->gateway = new UserGateway();
    }

    /**  Authenticate user
    *
    * This function gets the parameters email and password and then verifies them with the hashed password
    * After verification the key from config is used with a jason web token to get a unique token for
    * the user to be able to log in. This token will be timed
    *
    * @param string $email      string containing the email the user posted
    * @param string $password   string containing the password the user posted
    * @param array $payload     array containing statements about the user being userid and expiration time
    * @param string $jwt        string containing the JWT
    * @param array $data        associative array displaying the jwt
    */
    protected function processRequest() {
        $data = [];

        $email = $this->getRequest()->getParameter("email");
        $password = $this->getRequest()->getParameter("password");
        
        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($email) && !is_null($password)) {

                $this->getGateway()->findPassword($email);

                if (count($this->getGateway()->getResult()) == 1) {
                    $hashpassword = $this->getGateway()->getResult()[0]['password'];
                    if (password_verify($password, $hashpassword)) {
                        $key = SECRET_KEY;
                      
                        // The token will contain two items of data, a
                        // user_id and an exp (expiry) time. 
                        $payload = array(
                            "user_id" => $this->getGateway()->getResult()[0]['id'],
                            "exp" => time() + 7776000
                        );
                    
                        // Use the JWT class to encode the token
                        $jwt = JWT::encode($payload, $key, 'HS256');
                    
                        $data = ['token' => $jwt];
                     }
                    }
                }

            } else {
                $this->getResponse()->setMessage("Method not allowed");
                $this->getResponse()->setStatusCode(405);
            }
          
            // If the token was not created then
            // return a 401 unauthorised response.
            if (!array_key_exists('token',$data) && $this->getRequest()->getRequestMethod() === "POST"){
                $this->getResponse()->setMessage("Unauthorized");
                $this->getResponse()->setStatusCode(401);
            }

        

        return $data;
    }
}