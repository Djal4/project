<?php

use \App\API\Mentor;
use \App\core\User;
use \App\DB\Database;

//Instances Mentor class
$mentor=new Mentor(new User(new Database()));

//Checks uri data
if(sizeof($data=explode("/",$uri))>1)
    $id=$data[1];
else
    $id=NULL;

//Calls Mentor instance's method by server request.
switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        $mentor->get($id);
        break;
    case "POST":
        $mentor->post();
        break;
    case "PUT":
        $mentor->put();
        break;
    case "DELETE":
        $mentor->delete($id);
        break;
}   

//Dumps data.
echo $mentor->response_data;
?>