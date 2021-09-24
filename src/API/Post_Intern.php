<?php

namespace App\API;

use \App\core\User;
use \App\DB\Database;

require_once("../../vendor/autoload.php");

class Post_Intern
{
    private const ERROR="Error";
    private const ERROR_DISP="Request cant be done.";
    private const SUCCESS="Success";
    private const SUCCESS_DISP="Request done.";  
    private $usr,$response_data=NULL,$response,$data;

    public function __construct(User $usr)
    {
        $this->usr=$usr;
    }
    public function get($id=NULL)
    {
        if(!isset($id) || empty($this->usr->read($id))){
            $this->response=404;
            $this->response_data=json_encode(
                array(
                    self::ERROR =>self::ERROR_DISP
                ));
        }else{
            $this->data=$this->usr->read($id);
            if($this->data[2]=="Intern"){
                $this->response_data=json_encode(
                    array(
                        "name"    =>    $this->data[0],
                        "lastname"=>    $this->data[1],
                        "role"    =>    $this->data[2],
                        "group"   =>    $this->data[3]
                    ));
                $this->response=200;
            }else{
                $this->response=404;
                $this->response_data=json_encode(
                array(
                    self::ERROR =>self::ERROR_DISP
                ));
            }
            
        }
        return $this->response_data;
    }
    public function post()
    {
        $json=file_get_contents("php://input");
        $this->data=json_decode($json);
        if( isset($this->data->name)    &&
            isset($this->data->lastname)&&
            isset($this->data->group_id)){
                $this->usr->create($this->data->name,$this->data->lastname,1,$this->data->group_id);
                $this->response=201;
                $this->response_data=json_encode(
                    array(
                        self::SUCCESS=>self::SUCCESS_DISP
                    ));
        }else{
            $this->response=400;
            $this->response_data=json_encode(
                array(
                    self::ERROR=>self::ERROR_DISP
                ));
        }
        return $this->response_data;
    }
    public function put()
    {
        $json=file_get_contents("php://input");
        $this->data=json_decode($json);
        if( isset($this->data->ID)      &&
            isset($this->data->name)    &&
            isset($this->data->lastname)&&
            isset($this->data->group_id)&&
            !empty($this->usr->read($this->data->ID))){
                $this->usr->update($this->data->ID,$this->data->name,$this->data->lastname,$this->data->group_id);
                $this->response_data=json_encode(
                    array(
                        self::SUCCESS => self::SUCCESS_DISP
                    ));
                $this->response=200;
            }else{
                $this->response=400;
                $this->response_data=json_encode(
                    array(
                        self::ERROR   => self::ERROR_DISP
                    ));
            }
        return $this->response_data;
    }
    public function delete($id=NULL)
    {
        if(isset($id) && !empty($this->usr->read($id)) && $this->usr->read($id)[2]=="Intern"){
            $this->usr->delete($id);
            $this->response_data=json_encode(
                array(
                    self::SUCCESS     => self::SUCCESS_DISP
                ));
            $this->response=200;
        }else{
            $this->response_data=json_encode(
                array(
                    self::ERROR       => self::ERROR_DISP
                ));
            $this->response=404;
        }
    }
    public function printOut()
    {
        echo $this->response_data;
    }
}

?>