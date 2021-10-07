<?php

use \App\Route\Router;

require_once "Router.php";

//Instances Router class
$router=new Router();

//Adds routes.
$router->addRoute("Intern","../Controllers/Intern.php");
$router->addRoute("Mentor","../Controllers/Mentor.php");
$router->addRoute("Group","../Controllers/Group.php");
$router->addRoute("Comment","../Controllers/Comment.php");
?>