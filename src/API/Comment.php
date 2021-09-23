<?php

namespace App\API;

use \App\DB\Database;
use \App\core\Comment;

require_once("../../vendor/autoload.php");

$cmnt=new Comment(new Database());

$response_data=NULL;

switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        if(!isset($_GET['ID']) || empty($cmnt->read($_GET['ID']))){
            $response=404;
            $data=array("Error"=>"Request cant be finished");
        }else{
            $c_data=$cmnt->read($_GET['ID']);
            $data=array(
                "name"      =>  $c_data[0],
                "lastname"  =>  $c_data[1],
                "date"      =>  $c_data[4],
                "comment"   =>  $c_data[3],
            );
            $response=200;
        }
        break;
    case "POST":
        $json=file_get_contents("php://input");
        $c_data=json_decode($json);
        if(isset($c_data->mentor_id) &&
           isset($c_data->intern_id) &&
           isset($c_data->comment)){
               $cmnt->create($c_data->mentor_id,$c_data->intern_id,$c_data->comment);
               $response=201;
               $data=array("Success"=>"Request done."); 
           }else{
            $response=400;
            $data=array("Error"=>"Request cant be finished.");
            }
        break;
    case "DELETE":
        if(isset($_GET['ID']) &&
           !empty($cmnt->readComm($_GET['ID']))){
                $response=200;
                $data=array("Success"=>"Request done.");
                $cmnt->delete($_GET['ID']);
           }else{
                $response=404;
                $data=array("Error" =>"Request cant be finished");
           }
        break;
    case "PUT":
        $json=file_get_contents("php://input");
        $c_data=json_decode($json);
        if(isset($c_data->ID)        &&
           isset($c_data->mentor_id) &&
           isset($c_data->intern_id) &&
           isset($c_data->comment)){
               $cmnt->update($c_data->ID,$c_data->intern_id,$c_data->mentor_id,$c_data->comment);
               $data=array("Success"=>"Request done.");
               $response=200;
           }else{
               $response=400;
               $data=array("Error"=>"Request cant be finished.");
           }
        break;
}
$response_data=json_encode($data);
echo $response_data;
?>