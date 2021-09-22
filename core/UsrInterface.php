<?php

namespace core;

interface UsrInterface
{
    public function create($name,$lastname,$role,$group);
    public function read($id);
    public function update($id,$name,$lastname,$role,$group);
    public function delete($id);
}