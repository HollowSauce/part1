<?php
/**
 *  sql querys for the author API endpoint
 * 
 * 
 * @author Bob Auchterlounie
 */
class AuthorGateway extends Gateway  {

     /*
    * Make a template for the sql command as to not need to rewite it within functions
    */
    private $sql = "SELECT DISTINCT author.author_id, author.first_name, author.middle_name, author.last_name, affiliation.country, 
    affiliation.state, affiliation.city, affiliation.institution, affiliation.department 
    FROM paper JOIN paper_author ON paper.paper_id = paper_author.paper_id JOIN author ON paper_author.author_id = author.author_id
    LEFT JOIN affiliation ON author.author_id = affiliation.author_id
    LEFT JOIN award ON paper.paper_id = award.paper_id LEFT JOIN award_type ON award.award_type_id = award_type.award_type_id";

    public function __construct() {
        $this->setDatabase(DATABASE);
    }

     /*
    *   Returns all paper results gathered from the above statement
    */
    public function findAll()
    {
        $this->sql .= " ORDER BY author.author_id";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    /** 
    * Returns a specific author identified by the id the user enters
    *
    *   
    * @param string $id     holds the id of the author requested by the user in the url
    */
    public function findOne($id)
    {
        $this->sql .= " WHERE author.author_id = :id ORDER BY author.author_id";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /** 
    * Returns the authors of a specific paper identified by the id the user enters
    *
    *   
    * @param string $id     holds the id of the paper requested by the user in the url
    */
    public function findPaper($id)
    {
        $this->sql .= " WHERE paper.paper_id = :id ORDER BY author.author_id";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

     /** 
    * Returns the authors of a specific paper identified by the id the user enters
    *
    *   
    * @param string $id     holds the id of the award requested by the user in the url
    */
    public function findAward($id)
    {
        //if id == any then the result set will return only authors with awards
        if($id == "any"){
            $this->sql .= " WHERE award.award_type_id IS NOT NULL ORDER BY author.author_id";
            $result = $this->getDatabase()->executeSQL($this->sql);
        }else{
            $this->sql .= " WHERE award_type.award_type_id = :id ORDER BY author.author_id";
            $params = ["id" => $id];
            $result = $this->getDatabase()->executeSQL($this->sql, $params);
        }  
        $this->setResult($result);
        
    }

}
