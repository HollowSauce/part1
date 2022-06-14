<?php

/**
 *  SQL queries for the readinglist API endpoint
 * 
 * 
 * @author Bob Auchterlounie
 */
class ReadingListGateway extends Gateway  {

    public function __construct() {
        $this->setDatabase(DATABASE);
    }

    /** 
    * Prepare an SQL statement
     *
     * This function querys the dis database readingList table and return all details from the users readingList
     * 
     *
     * @param string  $user_id     users id to identify readinglist
     * @param  array   $params  An associative array of parameters (default empty array) 
     * @return array            An associative array of the query results
     */
    public function findAll($user_id) {
        $sql = "SELECT DISTINCT paper.paper_id, paper.title, paper.abstract, award_type.name AS awards FROM paper LEFT JOIN award
        ON paper.paper_id = award.paper_id LEFT JOIN award_type ON award.award_type_id = award_type.award_type_id INNER JOIN readingList 
        ON paper.paper_id = readingList.paper_id WHERE readingList.user_id = :user_id";
        $params = [":user_id" => $user_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    //Function to query the dis database readingList table and return all paper ids from the users readingList
    public function findIds($user_id) {
        $sql = "SELECT DISTINCT paper.paper_id FROM paper INNER JOIN readingList 
        ON paper.paper_id = readingList.paper_id WHERE readingList.user_id = :user_id";
        $params = [":user_id" => $user_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    /*
    *Function querys the dis database to see if the entered paper_id exists, if so the inputted id is added to the readinglist
    */
    public function add($user_id, $paper_id) {
        $testsql = "SELECT paper_id FROM paper WHERE paper_id = :paper_id";
        $params = [":paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($testsql, $params);   
        if(!empty($result)){
            $params = [":user_id" => $user_id, ":paper_id" => $paper_id]; 
            $sql = "INSERT into readingList (user_id, paper_id) VALUES (:user_id, :paper_id)";
            $result = $this->getDatabase()->executeSQL($sql, $params);
        }else{
            $result = "Invalid";
            $this->setResult($result);
        }
    }
    
    /*
    *Function querys the dis database to see if the entered paper_id exists, if so the inputted id is removed from the readinglist
    */
    public function remove($user_id, $paper_id) {
        $testsql = "SELECT paper_id FROM paper WHERE paper_id = :paper_id";
        $params = [":paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($testsql, $params);   
        if(!empty($result)){
            $params = [":user_id" => $user_id, ":paper_id" => $paper_id]; 
            $sql = $sql = "DELETE from readingList where (user_id = :user_id) AND (paper_id = :paper_id)";
            $result = $this->getDatabase()->executeSQL($sql, $params);
        }else{
            $result = "Invalid";
            $this->setResult($result);
        }
    }
}