<?php

namespace App\DB;

use \PDO;

/**
 * Database extends PDO,
 * with predefined set values, connects to database just by object instancing
 */
    class Database extends PDO
    {
        public function __construct($host="localhost",$db_name="project",$user="root",$password="")
        {
            $conn_str="mysql:host=".$host.";dbname=".$db_name;
            parent::__construct($conn_str,$user,$password);
        }
    }
?>