<?php

namespace App\core;

use \App\DB\Database;
use \App\core\CRUD\CRUD;
class User extends CRUD
{
    /**
     * Database class instance
     * 
     * @var object
     */
    private $db;

    //Sets Database class instance.
    public function __construct(Database $db)
    {
        $this->db=$db;
    }

    /**
     * Creates User and saves it in Database
     * 
     * @param mixed $params
     */
    public function create(...$params)
    {
        //Sets params values in new array.
        $values=[];
        foreach($params as $param){
            $values[]=$param;
        }

        $sql="INSERT INTO user (name,lastname,role_id,group_id) VALUES (?,?,?,?)";
        //Prepares and executes statement.
        $stmt=$this->db->prepare($sql);
        $stmt->execute($values);
        //Checks affected columns
        if($stmt->rowCount()){
            return true;
        } else{
            return false;
        }
    }

    /**
     * Reads all users data by specific role.
     * 
     * @param int role Role ID
     */
    public function readAll($role)
    {
        $sql="SELECT user.name,user.lastname,group_n.title 
        FROM user LEFT JOIN group_n ON 
        user.group_id=group_n.id WHERE user.role_id=?";
        //Prepares, executes and then returns fetched data.
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($role));
        return $stmt->fetchAll(\PDO::FETCH_BOTH);
    }

    /**
     * Read user's data
     * 
     * @param int $id User ID
     */
    public function read($id)
    {
        $sql="SELECT
        user.name,
        user.lastname,
        role.title as role,
        group_n.title as group_id
        FROM user LEFT JOIN role ON user.role_id=role.id LEFT JOIN group_n ON user.group_id=group_n.id WHERE user.id=?";
        //Prepares, executes and returns fetched data.
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetch(\PDO::FETCH_BOTH);
    }

    /**
     * Deletes User
     * 
     * @param int $id User ID
     */
    public function delete($id)
    {
        $sql="DELETE FROM user WHERE id=?";
        //Prepares and executes statement
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        //Checks for affected rows.
        if($stmt->rowCount()){
            return true;
        } else{
            return false;
        }
    }

    /**
     * Updates User's Data
     * 
     * @param int $id User ID
     * @param mixed $params
     */
    public function update($id,...$params)
    {
        //Breaks down params in two separated arrays.
        $fields=[];
        $values=[];
        foreach($params[0] as $key => $val){
            $fields[]= $key."=?";
            $values[]= $val;
        }
        $values[]=$id;

        $sql="UPDATE user SET ";
        //Generates SQL statement
        $sql=$sql.implode(",",$fields)." WHERE ID=?";
        //Prepares and executes SQL statement.
        $stmt=$this->db->prepare($sql);
        $stmt->execute($values);
        //Checks for affected rows.
        if($stmt->rowCount()){
            return true;
        } else{
            return false;
        }
    }
}
?>