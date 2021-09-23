<?php
    use \App\core\User;
    use \App\DB\Database;

    require_once("../../vendor/autoload.php");

    $usr=new User(new Database());
?>