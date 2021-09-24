<?php

namespace App\API;

use \App\core\Group;
use \App\DB\Database;

require_once("../../vendor/autoload.php");

class Post_Group
{
    private const ERROR="Error";
    private const ERROR_DISP="Request cant be done.";
    private const SUCCESS="Success";
    private const SUCCESS_DISP="Request done.";
    private $grp,$response_data=NULL,$response,$data;
    public function __construct(Group $grp)
    {
        $this->grp=$grp;
    }
    public function get($id)
    {
        if(!isset($id) || empty($this->grp->read($id))){
            $this->response=404;
            $this->response_data=json_encode(
                array(
                    self::ERROR => self::ERROR_DISP
                ));
        }else{
            $this->data=$this->grp->read($id);
            $this->response_data=json_encode(
                array(
                    "name"  => $this->data[0]
                ));
            $this->response=200;
        }
        return $this->response_data;
    }
    public function post()
    {
        $json=file_get_contents("php://input");
        $this->data=json_decode($json);
        if(isset($this->data->title)){
            $this->grp->create($this->data->title);
            $this->response=201;
            $this->response_data=json_encode(
                array(
                    self::SUCCESS=>self::SUCCESS_DISP
                ));
        }else{
            $this->response=400;
            $this->response_data=json_encode(
                array(
                    self::ERROR  => self::ERROR_DISP
                ));
        }
        return $this->response_data;
    }
    public function delete($id)
    {
        if(!isset($id) || empty($this->grp->read($id))){
            $this->response=400;
            $this->response_data=json_encode(
                array(
                    self::ERROR  => self::ERROR_DISP
                ));
        }else{
            $this->grp->delete($id);
            $this->response_data=json_encode(
                array(
                    self::SUCCESS=> self::SUCCESS_DISP
                ));
            $this->response=200;
        }
        return $this->response_data;
    }
    public function put()
    {
        $json=file_get_contents("php://input");
        $this->data=json_decode($json);
        if(isset($this->data->title)&&
           isset($this->data->ID)){
               $this->grp->update($this->data->ID,$this->data->title);
               $this->response_data=json_encode(
                   array(
                        self::SUCCESS=>self::SUCCESS_DISP
                   ));
                $this->response=200;
           }else{
                $this->response=404;
                $this->response_data=json_encode(
                    array(
                        self::ERROR  =>self::ERROR_DISP
                    ));
           }
    }
    public function printOut()
    {
        echo $this->response_data;
    }
}
/*
$pgrp=new Post_Group(new Group(new Database()));

switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        $pgrp->get($_GET['ID']);
        break;
    case "POST":
        $pgrp->post();
        break;
    case "DELETE":
        $pgrp->delete($_GET['ID']);
        break;
    case "PUT":
        $pgrp->put();
        break;
}
    
$pgrp->printOut();*/
?>