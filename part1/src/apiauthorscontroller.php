<?php
/**
 *  Process sql request
 * 
 * 
 * @author Bob Auchterlounie
 */
class ApiAuthorsController extends Controller {
    
    protected function setGateway() {
        $this->gateway = new AuthorGateway();
    }
    
    /**  Process sql request
    *
    * This function gets the request of the user, if there is an id parameter it returns authors with
    * that id else it returns all authors
    * 
    * @param string $id          string gathered from the users input to the url
    * @param string $paperid     string gathered from the users input to the url
    * @param string $award       string gathered from the users input to the url
    */

    protected function processRequest() {

        $id = $this->getRequest()->getParameter("id");
        $paperid = $this->getRequest()->getParameter("paper_id");
        $awardid = $this->getRequest()->getParameter("award");

        // add an elseif to look for language parameter
        if($this->getRequest()->getRequestMethod() === "GET"){
            if (!is_null($id)) {
                $this->getGateway()->findOne($id);
            } else if(!is_null($paperid)){
                $this->getGateway()->findPaper($paperid);
            }else if(!is_null($awardid)){
                $this->getGateway()->findAward($awardid);
            }
            else {
                $this->getGateway()->findAll();
            }
        }else{ 
            $this->getResponse()->setMessage("This Api only supports GET methods");
            //throw new Exception("This API only supports GET methods");
        }
        
        return $this->getGateway()->getResult();
}
}