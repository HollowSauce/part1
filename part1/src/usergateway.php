<?php
/**
 *  password finder
 * 
 * 
 * @author Bob Auchterlounie
 */
class UserGateway extends Gateway  {

    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }

    /** 
    * Password finder
    * 
    * This function retrieves an email variable given by the user which is then cross referenced
    *  with the user database to find the password correlating to that email which is then sent back to
    * the authenticate class to finish authentication of the user
    *
    * @param string $email     holds the variable the user inputted
    * @param string $result    hold the results of the executed sql
    */
    public function findPassword($email)
    {
        $sql = " Select id, password from user where email = :email";
        $params = [":email" => $email];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

}