<?php
namespace App\core;

use \App\DB\Database;
use \App\core\CRUD\CRUDG;

class Group extends CRUDG
{
    private $db;
    public function __construct(Database $db)
    {
        $this->db=$db;
    }
    public function create($name)
    {
        $sql="INSERT INTO
        group_n
        (title)
        VALUES
        (?)";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($name));
    }
    public function read($id)
    {
        $sql="SELECT
        title
        FROM
        group_n
        WHERE ID=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetch(\PDO::FETCH_BOTH);
    }
    public function update($id,$name)
    {
        $sql="UPDATE
        group_n
        SET
        title=? WHERE ID=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($name,$id));
    }
    public function delete($id)
    {
        $sql="DELETE FROM
        group_n
        WHERE ID=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        return true;
    }
}