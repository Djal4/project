<?php

use \App\API\Intern;
use \App\core\User;
use \App\DB\Database;

//Instances Intern class
$intern=new Intern(new User(new Database()));

//Checks uri data
if(count($data=explode("/",$uri))>1){
    $id=$data[1];
} else
    $id=NULL;

//Calls Intern instance's method by server request.
switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        $intern->get($id);
        break;
    case "POST":
        $intern->post();
        break;
    case "PUT":
        $intern->put();
        break;
    case "DELETE":
        $intern->delete($id);
        break;
}

//Dumps data.
echo $intern->response_data;
?>