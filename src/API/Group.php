<?php

namespace App\API;

use \App\core\Group as Grp;
use \App\DB\Database;
use \App\API\Response;
use \App\API\REST;

require_once("../../vendor/autoload.php");

class Group extends Response implements REST
{
    /**
     * Group class instance
     * 
     * @var object
     */
    private $grp;
    /**
     * Request response data/status code.
     * 
     * @var json,int
     */
    public $response_data=NULL,$response;

    //Sets Group class instance.
    public function __construct(Grp $grp)
    {
        $this->grp=$grp;
    }

    /**
     * REST API get request.
     * 
     * @param int $id Unique group Identifier.
     */
    public function get($id=NULL)
    {
        if(!isset($id) || $id==NULL){
            $data=$this->grp->readAll();
            $toJson=[];
            foreach($data as $row){
                $toJson[]=array(
                    "Name:"=>$row[0]
                );
            }
            $this->response=200;
            $this->response_data=json_encode($toJson);
            //Checks is $id set and is there Group with ID=$id
        }elseif(empty($data=$this->grp->read($id))){
            //Error message.
            [$this->response,$this->response_data]=$this->error();
        }else{
            $this->response_data=json_encode(
                array(
                    "name"  => $data[0]
                ));
            $this->response=200;
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
        $this->data=json_decode($json);

        //Checks is everything set
        if(isset($this->data->title)){
            if($this->grp->create($this->data->title)){
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
     * REST API delete request
     * 
     * @param int $id Unique Group Identifier
     */
    public function delete($id=NULL)
    {
        //Checks is ID set and is there Group with ID=$d
        if(!isset($id) || empty($this->grp->read($id))){
            //Error message.
            [$this->response,$this->response_data]=$this->error();
        }else{
            if($this->grp->delete($id)){
                //Success message.
                [$this->response,$this->response_data]=$this->success();
            } else{
                //Error message.
                //Success message.
                [$this->response,$this->response_data]=$this->error();
            }
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

        //Checks is ID set and is there Group with that ID
        if(isset($data['ID']) && !empty($this->grp->read($data['ID']) && isset($data['title']))){
            
            //Tries to update group and returns answer.
            if($this->grp->update($data['ID'],$data['title'])){
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
}
?>