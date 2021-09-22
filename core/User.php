<?php

namespace core;

use \core\UsrInterface;
class User implements UsrInterface
{
    protected $db;
    public function __construct($db)
    {
        $this->db=$db;
    }
    public function create($name,$lastname,$role,$group)
    {
        $sql="INSERT INTO user (name,lastname,role_id,group_id) VALUES (?,?,?,?)";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($name,$lastname,$role,$group));
    }
    public function read($id)
    {
        $sql="SELECT
        user.name,
        user.lastname,
        role.title,
        group_n.title
        FROM user LEFT JOIN role ON user.role_id=role.id LEFT JOIN group_n ON user.group_id=group_n.id WHERE user.id=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetch(\PDO::FETCH_BOTH);
    }
    public function delete($id)
    {
        $sql="DELETE FROM user WHERE id=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        return true;
    }
    public function update($id,$name,$lastname,$role,$group)
    {
        $sql="UPDATE user SET name=?,lastname=?,role_id=?,group_id=? WHERE id=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($name,$lastname,$role,$group,$id));
    }
}
?>