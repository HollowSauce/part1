<?php
/**
 *  Generic HTML format for the webpages created
 * 
 * 
 * @author Bob Auchterlounie
 */
abstract class Webpage 
{
    private $head;
    private $foot;
    private $body;

    public function __construct($title, $heading) {
        $this->setHead($title);
        $this->addHeading1($heading);
        $this->setFoot();
    }
    /** 
    * Header
    *
    * This function creates the base header for the webpages by using the HEREDOC syntax and assigning
    * it to the $head variable. The title of the webpage and style sheet can be passed in to change.
    *
    * @param string $css    this string holds the css directory location 
    * @param string $title  this string is passed to from where the webpage is requested changing the
    *                       title of the HTML page to this
    *
    */
    protected function setHead($title) {
        $css = BASEPATH . "assets/style.css";
        $this->head = <<<EOT
<!DOCTYPE html>
<html lang="en-gb">
<head>
    <title>$title</title>
    <meta charset="utf-8">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href=$css>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="home">Home</a>
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="documentation">Documentation</a>
        </li>
        </ul>
    </nav>
</head>
<body>
EOT;
    }

    /*
    * Getter for the head variable
    */
    private function getHead() {
        return $this->head;
    }

    /** 
    * Setter for the HTML body with the option to accept a text variable to append to the body
    *
    * @param string $text   this string can be customised and sent to this function to add text to the body of the webpage
    */
    protected function setBody($text) {
        $this->body .= $text;
    }

    /*
    * Getter for the HTML body
    */
    private function getBody() {
        return $this->body;
    }

    /*
    * Setter for the foot of the HTML page using the HEREDOC syntax
    */
    protected function setFoot() {
	      $this->foot = <<<EOT
</body>
</html>
EOT;
    }

    /*
    * Getter for the foot of the HTML page
    */
    private function getFoot() {
        return $this->foot;
    }

    /** 
    * This function is passed a string of text which is then put in a H1 tag and appended to body to make a heading
    *
    * @param string $text   this string can be customised and sent to this function to add a heading to the body of the webpage
    */
    protected function addHeading1($text) {
        $this->setBody("<h1>$text</h1>");
    }

    /** 
    * This function is passed a string of text which is then put in a p tag and appended to body to make a paragraph
    *
    * @param string $text   this string can be customised and sent to this function to add a paragraph to the body of the webpage
    */
    public function addParagraph($text) {
        $this->setBody("<p class=info>$text</p>");
    }

    /** 
    * This function is passed a string of text which is then put in div with an a tag then appended to body to make a link
    *
    * @param string $text   this string can be customised and sent to this function to add a link to the body of the webpage
    */
    public function addLink($text) {
        $link = BASEPATH . $text;
        $this->setBody("<div class=apiLinks><a href=$link>$text</a></div>");
    }
    
    public function generateWebpage() {
        return $this->head . $this->body . $this->foot;
    }

}