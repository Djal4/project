<?php

namespace App\core;

use \App\DB\Database;
use \App\core\CRUD\CRUD;
use \App\core\User;

class Comment extends CRUD
{
    /**
     * Database class instance
     * 
     * @var object
     */
    private $db;

    /**
     * User class instance
     * 
     * @var object
     */
    private $usr;

    //Sets Database and User class instances
    public function __construct(Database $db)
    {
        $this->db=$db;
        $this->usr=new User($db);
    }

    /**
     * Creates Comments and saves it into Database
     * 
     * @param mixed $params
     */
    public function create(...$params)
    {
        //Sets params values in new array.
        $values=[];
        foreach($params as $param)
            $values[]=$param;
        $values[]=date("y-m-d");

        //Gets Mentor's data from Database.
        $data=$this->usr->read($values[0]);
        //Gets Intern's data from Database.
        $data2=$this->usr->read($values[1]);

        //Checks is data valid and does Mentor and Intern belong to same group.
        if($data['role']=="Mentor" && $data2['role']=="Intern" 
        && $data['group_id']==$data2['group_id']){
        $sql="INSERT INTO comments (mentor_id,intern_id,comment,date) VALUES (?,?,?,?)";
        //Prepares and executes SQL statement
        $stmt=$this->db->prepare($sql);
        $stmt->execute($values);
        //Checks affected columns
        if($stmt->rowCount()){
            return true;
        } else{
            return false;
        }
        } else{
            return false;
        }
    }

    /**
     * Read comments from database for specific intern.
     * 
     * @param int $intern_id Unique Intern identifier.
     */
    public function read($intern_id)
    {
        $sql="SELECT user.name,user.lastname,comments.comment,comments.date FROM comments LEFT JOIN user ON comments.mentor_id=user.ID WHERE comments.intern_id=? ORDER BY comments.date ASC";
        
        //Prepares and executes sql statement.
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($intern_id));
        //Fetches data into index array
        $data=$stmt->fetchAll(\PDO::FETCH_NUM);
        //Reads Intern data
        $user=$this->usr->read($intern_id);
        //Returns Intern data and his comments
        return [$user,$data];
    }

    /**
     * Read comment for its ID
     * 
     * @param int $id Comment's Unique Identifier 
     */
    public function readComm($id)
    {
        $sql="SELECT * FROM comments WHERE ID=?";
        //Prepares and executes SQL statement
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        //Returns fetched data
        return $stmt->fetch(\PDO::FETCH_BOTH);
    }

    /**
     * Dynamic Comment Update method
     * 
     * @param int $id Unique Comment Identifier
     * @param mixed $params Comment data
     */
    public function update($id,...$params)
    {
        //Checks is key mentor if yes reads data by key
        if(isset($params[0]["mentor_id"])){
            $mentor=$this->usr->read($params[0]['mentor_id']);
        } else{
            //if there is no mentor gets mentor from current Comment data
            $mentor=$this->readComm($id);
            $mentor=$this->usr->read($mentor['mentor_id']);
        }
        //Checks is key intern if yes reads data by key
        if(isset($params[0]['intern_id'])){
            $intern=$this->usr->read($params[0]['intern_id']);
        } else{
            //If there is no intern gets intern from current comment data.
            $intern=$this->readComm($id);
            $intern=$this->usr->read($intern['intern_id']);
        }
        //Breaks down params into two separated arrays.
        $fields=[];
        $values=[];
        foreach($params[0] as $key => $val){
            $fields[]= $key."=?";
            $values[]= $val;
        }
        //Appends $id as last member of array
        $values[]=$id;
        //Checks is mentor & intern data valid
        if($mentor['role']=="Mentor" && 
        $intern['role']=="Intern" &&
        $mentor['group_id']==$intern['group_id'] &&
        !empty($this->readComm($id))){
            $sql="UPDATE comments SET ";
            //Generates sql statement
            $sql=$sql.implode(",",$fields)." WHERE ID=?";
            //Prepares statement and executes statement
            $stmt=$this->db->prepare($sql);   
            $stmt->execute($values);
            //Checks for affected rows
            if($stmt->rowCount()){
                return true;
            } else{
                return false;
            }
        }
        return false;
    }
    /**
     * Deletes Comment from Database
     * 
     * @param int $id Comment Identifier
     */
    public function delete($id)
    {
        $sql="DELETE FROM
        comments
        WHERE ID=?";
        //Prepares and executes sql statement
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        //Checks affected rows.
        if($stmt->rowCount()){
            return true;
        } else{
            return false;
        }
    }
}
?>