<?php

use \App\Route\Router;
use \App\API\Comment;
use \App\API\Group;
use \App\API\Intern;
use \App\API\Mentor;

require_once("../../vendor/autoload.php");


require_once "../Route/routes.php";

//Gets current Uri.
$uri=$router->getUri();

//Checks current uri.
$router->routeMatch($uri);
?>