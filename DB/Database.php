<?php

namespace DB;

use \PDO;


    class Database extends PDO
    {
        private $host;
        private $db_name;
        private $user;
        private $pass;
        private $conn_str;

        public function __construct($host="localhost",$db_name="project",$user="root",$password="")
        {
            $this->host=$host;
            $this->db_name=$db_name;
            $this->user=$user;
            $this->pass=$password;
            $this->conn_str="mysql:host=".$this->host.";dbname=".$this->db_name;
            parent::__construct($this->conn_str,$this->user,$this->pass);
        }
    }
?>