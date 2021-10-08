<?php

namespace App\Route;

use App\DB\Database;
use \App\API\Comment;
use \App\API\Group;
use \App\API\Intern;
use \App\API\Mentor;
use \App\core\User;
use \App\core\Comment as Cmt;
use \App\core\Group as Grp;

require_once("../../vendor/autoload.php");
class Router
{
    /**
     * Uri access routes.
     * 
     * @var array[string]=>string
     */
    private $routes=[];

    /**
     * Adds route to routes array.
     * 
     * @param string $uri current uri
     * @param string $loc file location of uri
     */
    public function addRoute($uri,$loc)
    {
        $this->routes[$uri]=$loc;
    }
    /**
     * Get Uri method.
     */
    public function getUri()
    {
        $url=str_replace("index.php","",$_SERVER['PHP_SELF']);
        return str_replace($url,"",$_SERVER['REQUEST_URI']);

    }
    /**
     * Matches routes and then requires files.
     * 
     * @param string $uri current uri
     */
    public function routeMatch($uri)
    {
        //Checks is $uri empty
        if(!empty($uri)){
            //If it isnt then checks is that uri recorded in routes array and if yes then requires file
            if(isset($this->routes[$uri]))
                require_once($this->routes[$uri]);
            //if file is not found then it breaks uri to components and search again
            elseif(!empty($data=explode("/",$uri)) && isset($this->routes[$data[0]]))
            {
                require_once($this->routes[$data[0]]);
            }
        }
    }
}

?>