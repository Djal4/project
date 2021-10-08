<?php

namespace App\API;

use \App\DB\Database;
use \App\core\Comment as Cmt;
use \App\API\Response;
use \App\API\REST;

require_once("../../vendor/autoload.php");

class Comment extends Response implements REST
{
    /**
     * User class instance
     * 
     * @var object
     */
    private $pcmt;

    /**
     * Request response data/status code.
     * 
     * @var json,int
     */
    public $response_data=NULL,$response;
    
    //Sets Comment class instance
    public function __construct(Cmt $cmnt)
    {
        $this->pcmt=$cmnt;
    }
    
    /**
     * REST API get request
     * 
     * @param int $id Unique Intern Identifier
     */
    public function get($id=NULL)
    {
        if($id==NULL){
            //Error message.
            [$this->response,$this->response_data]=$this->error();
        }
        //Checks is $id set and is there intern
        else if(isset($id) && !empty([$user,$data]=$this->pcmt->read($id))){
            //Converts data to json
            $toJson=[];
            $toJson[]=array(
                "name:"=>$user[0],
                "lastname:"=>$user[1],
                "group:"=>$user[3]
            );
            foreach($data as $row){
                $toJson[]=array(
                    "name:"=>$row[0],
                    "lastname:"=>$row[1],
                    "date"=>$row[3],
                    "comment"=>$row[2]
                );
            }
            $this->response_data=json_encode($toJson);
            //Response status code.
            $this->response=200;
        }else{
            //Error message.
            [$this->response,$this->response_data]=$this->error();
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
        if( isset($data->mentor_id) &&
            isset($data->intern_id) &&
            isset($data->comment)){
                if($this->pcmt->create($data->mentor_id,$data->intern_id,$data->comment)){
                    //Success message
                    [$this->response,$this->response_data]=$this->success();
                }else{
                    //Error message
                    [$this->response,$this->response_data]=$this->error();
                }
        }else{
            //Error message
            [$this->response,$this->response_data]=$this->error();
        }
    }

    /**
     * REST API delete request
     * 
     * @param int $id Unique Comment Identifier
     */
    public function delete($id)
    {
        //Checks is $id set and is there Comment with that ID
        if(isset($id) && !empty($this->pcmt->readComm($id))){
            if($this->pcmt->delete($id)){
                //Success message
                [$this->response,$this->response_data]=$this->success();
            } else{
                //Error message
                [$this->response,$this->response_data]=$this->Error();
            }
        }else{
            //Error message
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
        if( isset($data['ID'])          &&
            !empty($this->pcmt->readComm($data['ID']))){

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
                if($this->pcmt->update($data['ID'],$fields)){
                    //Success message
                    [$this->response,$this->response_data]=$this->success();
                }else{
                    //Error message
                    [$this->response,$this->response_data]=$this->error();
                }
        }else{
            //Error message
            [$this->response,$this->response_data]=$this->error();
        }
    }
}
?>