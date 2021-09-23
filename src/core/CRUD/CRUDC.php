<?php

namespace App\core\CRUD;

abstract class CRUDC
{
    abstract public function create($mentor_id,$intern_id,$comment);
    abstract public function read($id);
    abstract public function update($id,$mentor_id,$intern_id,$comment);
    abstract public function delete($id);
}

?>