<?

namespace core;

use \core\UsrInteface;
class User implements UsrInteface
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
        FROM user LEFT JOIN role ON user.role_id=role.id LEFT JOIN group_n ON user.group_id=group_n.id WHERE id=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function delete($id)
    {
        $sql="DELETE FROM user WHERE id=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($id));
        return true;
    }
    public function update($id,$data)
    {
        $sql="UPDATE user SET name=?,lastname=?,role_id=?,group_id=? WHERE id=?";
        $stmt=$this->db->prepare($sql);
        $stmt->execute(array($data['name'],$data['lastname'],$data['role_id'],$data['group_id'],$id));
    }
}
?>