<?php
namespace App\core;

use \App\DB\Database;
use \App\core\CRUD\CRUD;

class Group extends CRUD
{
    /**
     * Database class instance
     * 
     * @var object
     */
    private $db;

    //Sets Database class instance
    public function __construct(Database $db)
    {
        $this->db=$db;
    }

    /**
     * Creates Group and saves it
     */
    public function create(...$params)
    {
        $sql="INSERT INTO
        group_n
        (title)
        VALUES
        (?)";
        //Prepares and executes statement.
        $stmt=$this->db->prepare($sql);
        $stmt->execute($params);
        //Checks affected rows.
        if($stmt->rowCount()){
            return true;
        } else{
            return false;
        }
    }

    /**
     * Read group data
     * 
     * @param int $id Group ID
     */
    public function read($id)
    {
        $sql="SELECT
        title
        FROM
        group_n
        WHERE ID=?";
        //Prepares, executes and returns data fetched.
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetch(\PDO::FETCH_BOTH);
    }

    /**
     * Reads all groups data
     */
    public function readAll()
    {
        $sql="SELECT title FROM group_n";
        //Prepares, executes and returns data fetched.
        $stmt=$this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_BOTH);
    }

    /**
     * Updates group data
     * 
     * @param int $id Group ID
     * @param mixed $params
     */
    public function update($id,...$params)
    {
        //Breaks down params in two separated arrays.
        $values=[];
        foreach($params as $key => $val){
            $values[]= $val;
        }
        $values[]=$id;
        //Generates SQL statement.
        $sql="UPDATE group_n SET title=? WHERE ID=?";
        //Prepares and executes statement
        $stmt=$this->db->prepare($sql);
        $stmt->execute($values);
        //Checks for affected rows.
        if($stmt->rowCount()){
            return true;
        } else{
            return false;
        }
    }

    /**
     * Deletes Group
     * 
     * @param int $id Group ID
     */
    public function delete($id)
    {
        $sql="DELETE FROM
        group_n
        WHERE ID=?";
        //Prepares and executes statement.
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        //Checks for affected rows.
        if($stmt->rowCount()){
            return true;
        } else{
            return false;
        }
    }
}
?>