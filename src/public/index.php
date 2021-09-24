<?php

use \App\Route\Router;
use \App\API\Post_Comment;
use \App\API\Post_Group;
use \App\API\Post_Intern;
use \App\API\Post_Mentor;

require_once("../../vendor/autoload.php");

$url=explode("/",$_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']);
$abs_path=explode("/",str_replace("\\","/",__DIR__)."/");

$size1=sizeof($url);
$size2=sizeof($abs_path);

$data=array();
for($i=$size2-1;$i<$size1;$i++)
{
    if($size2<$i){
        if($url[$i]!=$abs_path[$i]){
            $data[]=$url[$i];
        }
    }
    else{
        $data[]=$url[$i];
    }
}
if(empty($data[0])){
    echo json_encode(array("Error" => "Bad Request"));
}
if(isset($data[1])) $id=$data[1]; else $id=NULL;

$rtr=new Router($data[0],$id);
$rtr->run($_SERVER['REQUEST_METHOD']);


?>