<?php

use DB\Database;

$names=array("Kason","Lizzie","Marius","Jovan","Rosina","Sherri","Lilly-Grace","Crystal","Macey","Brent");
$lastNames=array("Riddle","Boone","Paul","Stubbs","Mckay","Luna","Nairn","Traynor","Weber","Strong");

require_once("../../autoload.php");
$db=new \DB\Database();
$usr=new \core\User($db);
for($i=0;$i<30;$i++)
{
    $id=rand(0,9);
    $id2=(30-$id)%10;
    $usr->create($names[$id],$lastNames[$id2],rand(1,2),rand(1,2));
}
?>