<?php

namespace App\API;

use \App\DB\Database;
use \App\core\Comment;

require_once("../../vendor/autoload.php");

class Post_Comment
{
    private const ERROR="Error";
    private const ERROR_DISP="Request cant be done.";
    private const SUCCESS="Success";
    private const SUCCESS_DISP="Request done.";  
    private $pcmt,$response_data=NULL,$response,$data;
    
    public function __construct(Comment $cmnt)
    {
        $this->pcmt=$cmnt;
    }
    
    public function get($id)
    {
        if(!isset($id) || empty($this->pcmt->read($id))){
            $this->response=404;
            $this->response_data=json_encode(
                array(
                    self::ERROR => self::ERROR_DISP
                ));
        }else{
            $this->data=$this->pcmt->read($id);
            $this->response_data=json_encode(
                array(
                    "name"      =>    $this->data[0],
                    "lastname"  =>    $this->data[1],
                    "date"      =>    $this->data[4],
                    "comment"   =>    $this->data[3]
                ));
            $this->response=200;
        }
        return $this->response_data;
    }
    public function post()
    {
        $json=file_get_contents("php://input");
        $this->data=json_decode($json);
        if( isset($this->data->mentor_id) &&
            isset($this->data->intern_id) &&
            isset($this->data->comment)){
                if($this->pcmt->create($this->data->mentor_id,$this->data->intern_id,$this->data->comment)){
                    $this->response=201;
                    $this->response_data=json_encode(
                    array(
                        self::SUCCESS => self::SUCCESS_DISP
                ));
                }else{
                    $this->response=400;
                    $this->response_data=json_encode(
                        array(
                            self::ERROR=>self::ERROR_DISP
                        ));
                }
        }else{
            $this->response=400;
            $this->data=json_encode(
                    array(
                        self::ERROR   => self::ERROR_DISP
                ));
        }
        return $this->response_data;
    }
    public function delete($id)
    {
        if(isset($id) && !empty($this->pcmt->readComm($id))){
            $this->response=200;
            $this->pcmt->delete($id);
            $this->response_data=json_encode(
                array(
                    self::SUCCESS     => self::SUCCESS_DISP
                ));
        }else{
            $this->response=404;
            $this->response_data=json_encode(
                array(
                    self::ERROR     => self::ERROR_DISP
                ));
        }
        return $this->response_data;
    }
    public function put()
    {
        $json=file_get_contents("php://input");
        $this->data=json_decode($json);
        if( isset($this->data->ID)          &&
            isset($this->data->mentor_id)   &&
            isset($this->data->intern_id)   &&
            isset($this->data->comment)){

                if($this->pcmt->update($this->data->ID,$this->data->intern_id,$this->data->mentor_id,$this->data->comment)){
                    $this->response_data=json_encode(
                        array(
                            self::SUCCESS =>  self::SUCCESS_DISP  
                        ));
                    $this->response=200;
                }else{
                    $this->response=404;
                    $this->response_data=json_encode(
                    array(
                            self::ERROR   =>  self::ERROR_DISP
                    ));
                }
        }else{
            $this->response=404;
            $this->response_data=json_encode(
                array(
                        self::ERROR   =>  self::ERROR_DISP
                ));
        }
        return $this->response_data;
    }
    public function printOut()
    {
        echo $this->response_data;
    }
}
?>