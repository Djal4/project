<?php

namespace App\API;


use \App\core\User;
use \App\DB\Database;

require_once("../../vendor/autoload.php");

$usr=new User(new Database());
$response_data=NULL;
switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        if(!isset($_GET['ID']) && empty($usr->read($_GET['ID']))){
            $response=404;
            $data=array("Error"=>"Request cant be finished.");
        }else{
            $data=$usr->read($_GET['ID']);
            if($data[2]=="Intern"){
                $response=404;
                $data=array("Error"=>"Request cant be finished.");
            }else{
                $data=array(
                    'name' => $data[0],
                    'lastname' => $data[1],
                    'role' => "Mentor",
                    'group' => $data[3]
                );
                $response=200;
            }
        
        }
        break;
    case "DELETE":
        if(isset($_GET['ID']) && !empty($usr->read($_GET['ID']))){
                $usr->delete($_GET['ID']);
                $data=array("Success"=>"Request done.");
                $response=200;
            }
            else{
                $response=404;
                $data=array("Error"=>"Request cant be finished.");
            }
        break;
    case "PUT":
        $json=file_get_contents("php://input");
        $data=json_decode($json);
        if( isset($data->ID)      &&
            isset($data->name)    &&
            isset($data->lastname)&&
            isset($data->group_id)){
                $usr->update($data->ID,$data->name,$data->lastname,2,$data->group_id);
                $data=array("Success"=>"Request done.");
                $response=200;
            }
        else{
            $response=400;
            $data=array("Error"=>"Request cant be finished.");
        }
        break;
    case "POST":
        $json=file_get_contents("php://input");
        $data=json_decode($json);
        if( isset($data->name)     &&
            isset($data->lastname) &&
            isset($data->group_id)){
                $usr->create($data->name,$data->lastname,2,$data->group_id);
                $response=200;
                $data=array("Success"=>"Request done.");
            }
        else{ 
            $response=400;
            $data=array("Error"=>"Request cant be finished.");
        }
        break;
    }
    $response_data=json_encode($data);
    $codes=array(200 => "OK",201=>"Created",400=>"Bad Request",404=>"Not Found");
    header("HTTP/1.1 ".$response.' '.$codes[$response]);
    header('Content-Type: application/json; charset=utf-8');
    echo $response_data;
?>