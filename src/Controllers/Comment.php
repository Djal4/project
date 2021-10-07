<?php

use \App\API\Comment;
use \App\core\Comment as Cmt;
use \App\DB\Database;

//Instances Comment class
$comment=new Comment(new Cmt(new Database()));

//Checks uri data
if(sizeof($data=explode("/",$uri))>1)
    $id=$data[1];
else
    $id=NULL;

//Calls Comment instance's method by server request.
switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        $comment->get($id);
        break;
    case "POST":
        $comment->post();
        break;
    case "PUT":
        $comment->put();
        break;
    case "DELETE":
        $comment->delete($id);
        break;
}

//Dumps data.
echo $comment->response_data;
?>