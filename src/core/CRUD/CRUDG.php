<?php

namespace App\core\CRUD;

abstract class CRUDG
{
    abstract public function create($name);
    abstract public function read($id);
    abstract public function update($id,$name);
    abstract public function delete($id);
}

?>