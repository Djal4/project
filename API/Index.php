<?php

namespace API;

require_once("../autoload.php");

use \core\User;
use \DB\Database;


$usr=new \core\User(new Database());

switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        if(!isset($_GET['id']))
        {
            $response=400;
            break;
        }
        $data=$usr->read($_GET['id']);
        $data=array(
            'name' => $data[0],
            'lastname' => $data[1],
            'role' => $data[2],
            'group' => $data[3]
        );
        $response=json_encode($data);
        break;
    case "DELETE":
        if(isset($_GET['id']))
        {
            if($usr->read($_GET['id']))
            {
                $usr->delete($_GET['id']);
            }
            else 
            {
                $response=400;
                break;
            }
        }
        else {
            $response=400;
            break;
        }
        $response=200;
        break;
    case "PUT":
        if(isset($_GET['id'])) $id=$_GET['id'];
        else 
        {
            $response=400;
            break;
        }
        if(!$usr->read($id)) 
        {
            $response=400;
            break;
        }
        $json=file_get_contents("php://input");
        $data=json_decode($json);
        if( isset($data['name'])||
            isset($data['lastname'])||
            isset($data['role_id'])||
            isset($data['group_id']))
            $usr->update($data['name'],$data['lastname'],$data['role_id'],$data['group_id']);
        else 
        {
            $response=400;
            break;
        }
        $response=200;
        break;
    case "POST":
        $json=file_get_contents("php://input");
        $data=json_decode($json);
        if( isset($data['name'])||
            isset($data['lastname'])||
            isset($data['role_id'])||
            isset($data['group_id']))
            {
                $usr->create($data['name'],$data['lastname'],$data['role_id'],$data['group_id']);
                $response=200;
            }
        else $response=400;
        break;
    }
//echo $response;
?>