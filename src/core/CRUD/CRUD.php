<?php

namespace App\core\CRUD;

/**
 * 
 * CRUD Classes Interface
 *
 */
abstract class CRUD
{
    /**
     * Processes create request
     * 
     * @param mixed $params
     */
    abstract public function create(...$params);

    /**
     * Processes read request
     * 
     * @param int $id Unique Identifier
     */
    abstract public function read($id);

    /**
     * Processes update request
     * 
     * @param int $id Unique identifier
     * @param mixed $params
     */
    abstract public function update($id,...$params);

    /**
     * Processes delete request
     * 
     * @param int $id Unique identifier
     */
    abstract public function delete($id);
}