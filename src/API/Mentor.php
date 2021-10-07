<?php

namespace App\API;

use \App\core\User;
use \App\DB\Database;
use \App\API\Response;
use \App\API\REST;

require_once("../../vendor/autoload.php");

class Mentor extends Response implements REST
{   
    /**
     * User class instance
     * 
     * @var object
     */
    private $usr;

    /**
     * Request response data/status code.
     * 
     * @var json,int
     */
    public $response_data=NULL,$response;

    //Sets User class instance
    public function __construct(User $usr)
    {
        $this->usr=$usr;
    }

    /**
     * REST API get request
     * 
     * @param int $id Unique User Identifier.
     */
    public function get($id=NULL)
    {
        //Checks if $id is not set
        if(!isset($id) || $id==NULL){

        //Gets all Interns from DB
        $data=$this->usr->readAll(2);
        $toJson=[];
        //Converts all data to matrix
        foreach($data as $row){
            $toJson[]=array(
                "name"=>$row[0],
                "lastname"=>$row[1],
                "group"=>$row[2]
            );
        }
                //Parses data to json.
        $this->response_data=json_encode($toJson);
        $this->response=200;
            
        // Checks is $id set and is there user with ID=$id
        }elseif(empty($data=$this->usr->read($id))){
            //Error message.
            [$this->response,$this->response_data]=$this->error();
        }else{
            //Checks is user Mentor.
            if($data[2]=="Mentor"){
                //Encodes response data to json.
                $this->response_data=json_encode(
                    array(
                        "name"    =>    $data[0],
                        "lastname"=>    $data[1],
                        "role"    =>    $data[2],
                        "group"   =>    $data[3]
                    ));
                //Response status code.
                $this->response=200;
            }else{ 
                //Error message.
                [$this->response,$this->response_data]=$this->error();
            }
            
        }
    }
    /**
     * REST API post request
     */
    public function post()
    {
        //Gets json data.
        $json=file_get_contents("php://input");

        //Decodes json data.
        $data=json_decode($json);
        
        //Checks is everything set.
        if( isset($data->name)    &&
            isset($data->lastname)&&
            isset($data->group_id)){
                //Creates user and checks is created.
                if($this->usr->create($data->name,$data->lastname,2,$data->group_id)){
                    //Success message.
                    [$this->response,$this->response_data]=$this->success();
                } else{
                    //Error message.
                    [$this->response,$this->response_data]=$this->error();        
                }
        }else{
            //Error message.
            [$this->response,$this->response_data]=$this->error();
        }
    }   

    /**
     * REST API put request
     */
    public function put()
    {
        //Gets json data.
        $json=file_get_contents("php://input");

        //Converts json data to array.
        $data=get_object_vars(json_decode($json));
        
        //Checks is ID set and is there User with that ID
        if( isset($data['ID']) && !empty($this->usr->read($data['ID'])) && $this->usr->read($data['ID'])['role']=="Mentor"){
            
            /**
             * Transforms data array in other array
             * To be able to send data to method 
             * in ($id,...$params) shape.
             */
            $fields=[];
            foreach($data as $key => $val){
                if($key!="ID"){
                    $fields[$key]=$val;
                }
            }

            //Tries to update data and returns answer.
            if($this->usr->update($data['ID'],$fields)){
                //Success message.
                [$this->response,$this->response_data]=$this->success();
            } else{
                //Error message.
                [$this->response,$this->response_data]=$this->error();
            }
        } else{
            //Error message.
            [$this->response,$this->response_data]=$this->error();
        }
    }

    /**
     * REST API delete request
     * 
     * @param int $id Unique User Identifier
     */
    public function delete($id=NULL)
    {
        //Checks is ID set and is there User registered as Mentor
        if(isset($id) && !empty($this->usr->read($id)) && $this->usr->read($id)[2]=="Mentor"){
            //Deletes user and checks is deleted.
            if($this->usr->delete($id)){
                //Success message.
                [$this->response,$this->response_data]=$this->success();
            } else{
                //Error message.
                [$this->response,$this->response_data]=$this->error();
            }    
        }else{
            //Error message.
            [$this->response,$this->response_data]=$this->error();
        }
    }
}
?>