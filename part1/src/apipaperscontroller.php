<?php
/**
 *  Process sql request
 * 
 * 
 * @author Bob Auchterlounie
 */
class ApiPapersController extends Controller {
    
    protected function setGateway() {
        $this->gateway = new PaperGateway();
    }
    
    /**  Process sql request
    *
    * This function gets the request of the user, if there is an id parameter it returns papers with
    * that id else it returns all papers
    * 
    * @param string $id     string gathered from the users input to the url
    * @param string $author     string gathered from the users input to the url
    * @param string $award     string gathered from the users input to the url
    */

    protected function processRequest() {

        $id = $this->getRequest()->getParameter("id");
        $authorid = $this->getRequest()->getParameter("author_id");
        $award = $this->getRequest()->getParameter("award");

        // add an elseif to look for language parameter
        if($this->getRequest()->getRequestMethod() === "GET"){
            if (!is_null($id)) {
                if ($id === "random") {
                    // invoke a newly defined method 
                    $this->getGateway()->findRandom($id);
                } else {
                    $this->getGateway()->findOne($id);
                }
            }elseif(!is_null($authorid)){
                $this->getGateway()->findAuthor($authorid);
            }elseif(!is_null($award)){
                $this->getGateway()->findAward($award);
            }else{
                $this->getGateway()->findAll();
            }
        }else{ 
            $this->getResponse()->setMessage("This Api only supports GET methods");
            $this->getResponse()->setStatusCode(405);
        }
        
        return $this->getGateway()->getResult();
}
}