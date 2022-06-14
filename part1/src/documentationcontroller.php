<?php
/**
 *  Information displayed on the Documentation page
 * 
 * 
 * @author Bob Auchterlounie
 */
class DocumentationController extends Controller 
{
    /** 
    * Documentation page
    *
    * This function process the request for the documentation page using addparagraph and
    * addLink to make the contents of the page
    *
    * @param class $page    this contains an instance of the documentation page holding all information
    *                       passed to it
    */
    protected function processRequest() {
        $page = new DocumentationPage("Documentation","DOCUMENTATION");
        $page->addParagraph("Bob Auchterlounie W18013532");
        $page->addParagraph("API endpoints implemented: ");
        $page->addLink("api");
        $page->addParagraph("api description: returns basic json format of api endpoint");
        $page->addParagraph("api HTTP methods: only GET method supported");
        $page->addParagraph("parameters supported: accepts no paramaters");
        $page->addParagraph("Expected status code: 200, Message:'ok'");
        $page->addParagraph("Error status code: 204, Message:'no content'");
        $page->addLink("api/authors");
        $page->addParagraph("api description: returns results for authors from the dis.sqlite database");
        $page->addParagraph("api HTTP methods: only GET method supported");
        $page->addParagraph("parameters supported: id(int, optional): Returns authors with corresponding id");
        $page->addParagraph("award(string, optional): Returns authors with specific awards if award_id is used or at least one if 'any' is used");
        $page->addParagraph("paper_id(int, optional): returns authors which have used a specific paper_id. used in part2");
        $page->addParagraph("Expected status code: 200, Message:'ok'");
        $page->addParagraph("Error status code: 204, Message:'no content'");
        $page->addParagraph("Error status code: 405, Message:'Method not allowed', Reason: POST method used");
        $page->addParagraph("Example request: 'http://unn-w18013532.newnumyspace.co.uk/kf6012/coursework/part1/api/authors?id=59530'");
        $page->addParagraph("Example JSON response: Gives information correlating to the authors id entered");
        $page->addLink("api/papers");
        $page->addParagraph("api description: returns results for papers from the dis.sqlite database");
        $page->addParagraph("api HTTP methods: only GET method supported");
        $page->addParagraph("parameters supported: id(int, optional): Returns papers with corresponding id");
        $page->addParagraph("award(string, optional): Returns papers with specific awards if award_id is used or at least one if 'any' is used");
        $page->addParagraph("author_id(int, optional): returns papers which have used a specific author_id. used in part2");
        $page->addParagraph("Expected status code: 200, Message:'ok'");
        $page->addParagraph("Error status code: 204, Message:'no content'");
        $page->addParagraph("Error status code: 405, Message:'Method not allowed', Reason: POST method used");
        $page->addParagraph("Example request: 'http://unn-w18013532.newnumyspace.co.uk/kf6012/coursework/part1/api/papers?id=60156'");
        $page->addParagraph("Example JSON response: Gives information correlating to the paper id entered");
        $page->addLink("api/authenticate");
        $page->addParagraph("api description: authenticates email and password login through POST request");
        $page->addParagraph("api HTTP methods: only POST method supported");
        $page->addParagraph("parameters supported: email(string, needed): is used to compare email with user.sqlite database");
        $page->addParagraph("password(string, needed): is used to compare password with user.sqlite database");
        $page->addParagraph("Expected status code: 200, Message:'ok'");
        $page->addParagraph("Error status code: 401, Message:'Unauthorized', Reason: Login is incorrect");
        $page->addParagraph("Error status code: 405, Message:'Method not allowed', Reason: GET method used");
        $page->addParagraph("Example request: 'http://unn-w18013532.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate'");
        $page->addParagraph("Example JSON response: Would give error since a GET request is used, programme such as postman is needed to handle POST requests");
        $page->addLink("api/readingList");
        $page->addParagraph("api description: using login token from authenticate displays users reading list giving the option to add and remove");
        $page->addParagraph("api HTTP methods: only POST method supported");
        $page->addParagraph("parameters supported: token(string, needed): is used to authenticate which user is logged in");
        $page->addParagraph("add(string, optional): id entered is compared with paper id on papers and added to the reading list");
        $page->addParagraph("remove(string, optional): id entered is compared with readinglist table and then removed");
        $page->addParagraph("Expected status code: 200, Message:'ok'");
        $page->addParagraph("Error status code: 401, Message:'Unauthorized', Reason: Login is incorrect");
        $page->addParagraph("Error status code: 405, Message:'Method not allowed', Reason: GET method used");
        $page->addParagraph("Example request: 'http://unn-w18013532.newnumyspace.co.uk/kf6012/coursework/part1/api/readingList'");
        $page->addParagraph("Example JSON response: Would give error since a GET request is used, programme such as postman is needed to handle POST requests");
        return $page->generateWebpage();
    }
}