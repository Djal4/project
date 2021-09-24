<?php

namespace App\core;

use \App\DB\Database;
use \App\core\CRUD\CRUDC;


class Comment extends CRUDC
{
    private $db;
    public function __construct(Database $db)
    {
        $this->db=$db;
    }
    public function readUser($id)
    {
        $sql="SELECT
        name,
        lastname,
        role_id,
        group_id
        FROM user
        WHERE id=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetch(\PDO::FETCH_BOTH);
    }
    public function create($mentor_id,$intern_id,$comment)
    {
        $mentor=$this->readUser($mentor_id);
        $intern=$this->readUser($intern_id);
        if($mentor['role_id']==2 && 
        $intern['role_id']==1 &&
        $mentor['group_id']==$intern['group_id'])
            {
                $sql="INSERT INTO comments 
                (mentor_id,intern_id,comment,date)
                values
                (?,?,?,?)";
                $stmt=$this->db->prepare($sql);
                $stmt->execute(array($mentor_id,$intern_id,$comment,date("Y-m-d")));
            }else{
                return false;
            }
    }
    public function readComm($id)
    {
        $sql="SELECT
        * FROM
        comments
        WHERE ID=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetch(\PDO::FETCH_BOTH);
    }
    public function read($intern_id)
    {
        $sql="SELECT
        user.name,
        user.lastname,
        user.role_id,
        comments.comment,
        comments.date FROM user LEFT JOIN comments ON user.ID=comments.intern_id
        WHERE comments.intern_id=? ORDER BY comments.date ASC";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($intern_id));
        return $stmt->fetch(\PDO::FETCH_BOTH);
    }
    public function update($id,$intern_id,$mentor_id,$comment)
    {
        $mentor=$this->readUser($mentor_id);
        $intern=$this->readUser($intern_id);
        if($mentor['role_id']==2 && 
        $intern['role_id']==1 &&
        $mentor['group_id']==$intern['group_id'] &&
        !empty($this->readComm($id))){
            $sql="UPDATE
            comments
            SET
            mentor_id=?,intern_id=?,comment=? WHERE ID=?";
            $stmt=$this->db->prepare($sql);   
            $stmt->execute(array($intern_id,$mentor_id,$comment,$id));
            return true;
        }
        return false;
    }
    public function delete($id)
    {
        $sql="DELETE FROM
        comments
        WHERE ID=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        return true;
    }
}
?>