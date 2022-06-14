<?php

/**
 *  Information displayed on the homepage
 * 
 * @author Bob Auchterlounie
 */
class HomeController extends Controller 
{   
    /** 
    * Home page
    *
    * This function process the request for the home page using addparagraph 
    * to make the contents of the page
    *
    * @param class $page    this contains an instance of the home page holding all information
    *                       passed to it
    */
    protected function processRequest() {
        $page = new HomePage("Home", "HOME");
        $page->addParagraph("Bob Auchterlounie W18013532");
        $page->addParagraph("This work is university coursework and not associated with or endorsed by the DIS conference");
        return $page->generateWebpage();
    }
}