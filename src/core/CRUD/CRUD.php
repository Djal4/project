<?php

namespace App\core\CRUD;

abstract class CRUD
{
    abstract public function create($name,$lastname,$role,$group);
    abstract public function read($id);
    abstract public function update($id,$name,$lastname,$group);
    abstract public function delete($id);
}