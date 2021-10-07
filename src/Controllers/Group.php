<?php

use \App\API\Group;
use \App\core\Group as Grp;
use \App\DB\Database;

//Instances Group class
$group=new Group(new Grp(new Database()));

//Checks uri data
if(sizeof($data=explode("/",$uri))>1)
    $id=$data[1];
else
    $id=NULL;

//Calls Group instance's method by server request.
switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        $group->get($id);
        break;
    case "POST":
        $group->post();
        break;
    case "PUT":
        $group->put();
        break;
    case "DELETE":
        $group->delete($id);
        break;
}
//Dumps data.
echo $group->response_data;
?>