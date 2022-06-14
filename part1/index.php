<?php

include "config/config.php";

$request = new Request();

/*
* If statement to see if the url has an api endpoint. If so a JSON response is used
* else HTML will be the default
*/
if (substr($request->getPath(),0,3) === "api") {
   $response = new JSONResponse();
} else {
    set_exception_handler("HTMLexceptionHandler");
    $response = new HTMLResponse();
}

/*
* Switch statement which retrieves the path and redirects the user to the 
* correct controller depending on the URL endpoint. If no such end point exists an exception is thrown
*/
switch ($request->getPath()) {
    case '':
    case 'home':
        $controller = new HomeController($request, $response);
        break;
    case 'documentation':
        $controller = new DocumentationController($request, $response);
        break;
    case 'api':
        $controller = new ApiBaseController($request, $response);
        break;
    case 'api/authors':
        $controller = new ApiAuthorsController($request, $response);
        break;
    case 'api/papers':
        $controller = new ApiPapersController($request, $response);
        break;
    case 'api/authenticate':
        $controller = new ApiAuthenticateController($request, $response);
        break;
    case 'api/readinglist':
        $controller = new ApiReadingListController($request, $response);
        break;
    default:
        throw new exception("NO SUCH WEBPAGE");
        break;
}
 
echo $response->getData();