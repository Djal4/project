<?php

use App\DB\Database;
use App\core\User;

require_once("../../autoload.php");

$names=array("Kason","Lizzie","Marius","Jovan","Rosina","Sherri","Lilly-Grace","Crystal","Macey","Brent");
$lastNames=array("Riddle","Boone","Paul","Stubbs","Mckay","Luna","Nairn","Traynor","Weber","Strong");

$usr=new User(new Database());
for($i=0;$i<30;$i++)
{
    $id=rand(0,9);
    $id2=(30-$id)%10;
    $usr->create($names[$id],$lastNames[$id2],rand(1,2),rand(1,2));
}
?>