<?php
/**
 *  SQL queries for the paper API endpoint
 * 
 * 
 * @author Bob Auchterlounie
 */
class PaperGateway extends Gateway  {
    //awards might be a bit not working
    /*
    * Make a template for the sql command as to not need to rewite it within functions
    */
    /*
    private $sql = "SELECT paper.paper_id, paper.title, paper.abstract, award_type.name AS awards FROM paper JOIN award
    ON paper.paper_id = award.paper_id JOIN award_type ON award.award_type_id = award_type.award_type_id";
    */
    
    private $sql = "SELECT DISTINCT paper.paper_id, paper.title, paper.abstract, award_type.name AS awards, paper.doi, paper.video, paper.preview
    FROM paper LEFT JOIN award
    ON paper.paper_id = award.paper_id LEFT JOIN award_type ON award.award_type_id = award_type.award_type_id JOIN paper_author ON paper.paper_id
    = paper_author.paper_id JOIN author ON paper_author.author_id = author.author_id";

    
    public function __construct() {
        $this->setDatabase(DATABASE);
    }

    /*
    *   Returns all paper results gathered from the above statement
    */
    public function findAll()
    {
        $this->sql .= " GROUP BY paper.paper_id ORDER BY paper.title";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    /** 
    * Returns a specific paper identified by the id the user enters
    *
    *   
    * @param string $id     holds the id of the paper requested by the user in the url
    */
    public function findOne($id)
    {
        $this->sql .= " WHERE paper.paper_id = :id ORDER BY paper.title";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }
    
    /** 
    * Returns the papers written by a specified author identified by the id the user enters
    *
    *   
    * @param string $id     holds the id of the paper requested by the user in the url
    */
    public function findAuthor($id)
    {
        $this->sql .= " WHERE author.author_id = :id ORDER BY paper.title";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /** 
    * Returns the papers with specific awards identified by the user
    *
    *   
    * @param string $id     holds the id of the award requested by the user in the url
    */
    public function findAward($id)
    {   
        if($id == "any"){
            $this->sql .= " WHERE award_type.name IS NOT NULL ORDER BY paper.title";
            $result = $this->getDatabase()->executeSQL($this->sql);
        }else{
            $this->sql .= " WHERE award_type.award_type_id = :id ORDER BY paper.title";
            $params = ["id" => $id];
            $result = $this->getDatabase()->executeSQL($this->sql, $params);
        }  
        $this->setResult($result);
    }
    
    
    /*
    * Returns a random paper
    */
    public function findRandom()
    {
        $this->sql .= " order by random() limit 1";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

}
