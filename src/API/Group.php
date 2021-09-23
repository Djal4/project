<?php

namespace App\API;

use \App\core\Group;
use \App\DB\Database;

require_once("../../vendor/autoload.php");

$grp=new Group(new Database());

$response_data=NULL;

switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        if(!isset($_GET['ID']) || empty($grp->read($_GET['ID']))){
            $response=404;
            $data=array("Error"=>"Request cant be finished");
        }else{
            $g_data=$grp->read($_GET['ID']);
            $data=array(
                "name" => $g_data[0]
            );
            $response=200;
        }
        break;
    case "POST":
        $json=file_get_contents("php://input");
        $g_data=json_decode($json);
        if(isset($g_data->title)){
            $grp->create($g_data->title);
            $response=201;
            $data=array("Success"=>"Request done."); 
        }else{
            $response=400;
            $data=array("Error"=>"Request cant be finished.");
        }
        break;
    case "DELETE":
        if(!isset($_GET['ID']) && !empty($grp->read($_GET['ID']))){
            $response=404;
            $data=array("Error"=>"Request cant be finished.");
        }else{
            $grp->delete($_GET['ID']);
            $data=array("Success"=>"Request done.");
            $response=200;
        }
        break;
    case "PUT":
        $json=file_get_contents("php://input");
        $g_data=json_decode($json);
        if(isset($g_data->title) &&
           isset($g_data->ID)){
               $grp->update($g_data->ID,$g_data->title);
               $data=array("Success"=>"Request done.");
               $response=200;
           }else{
               $response=404;
               $data=array("Error"=>"Request cant be finished");
           }
        break;
}
    $response_data=json_encode($data);
    $codes=array(200=>"OK",201=>"Created",400=>"Bad Request",404=>"Not Found");
    header("HTTP/1.1 ".$response." ".$codes[$response]);
    header("Content-Type: application/json");
    echo $response_data;
?>