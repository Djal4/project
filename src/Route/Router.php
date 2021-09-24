<?php

namespace App\Route;

use App\DB\Database;
use \App\API\Post_Comment;
use \App\API\Post_Group;
use \App\API\Post_Intern;
use \App\API\Post_Mentor;
use \App\core\User;
use \App\core\Comment;
use \App\core\Group;

require_once("../../vendor/autoload.php");
class Router
{
    public $uri,$index;
    private $endpoints=array("Comment","Group","Intern","Mentor");
    public function __construct($a,$b=NULL)
    {
        if(isset($a))
            $this->uri=$a;
        else
            throw new \Exception("Bad Request.");
        if(isset($b))
            $this->index=$b;
    }
    public function run($method)
    {
        foreach($this->endpoints as $endpoint)
        {
            if($endpoint==$this->uri){
                switch($endpoint){
                    case "Intern":
                        $instance=new Post_Intern(new User(new Database()));
                        break;
                    case "Mentor":
                        $instance=new Post_Mentor(new User(new Database()));
                        break;
                    case "Group":
                        $instance=new Post_Group(new Group(new Database()));
                        break;
                    case "Comment":
                        $instance=new Post_Comment(new Comment(new Database()));
                        break;
                }
            }
        }
        switch($method){
            case "GET":
                $instance->get($this->index);
                break;
            case "POST":
                $instance->post();
                break;
            case "PUT":
                $instance->put();
                break;
            case "DELETE":
                $instance->delete($this->index);
                break;
        }
        $instance->printOut();
    }
}

?>