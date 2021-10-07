<?php

namespace App\API;

    /**
     * 
     * REST API Interface
     * 
     */
interface REST
{
    /**
     * Processes get request.
     * 
     * @param int $id Unique DB identifier. 
     */
    public function get($id);

    /**
     * Processes post request.
     */
    public function post();
    
     /**
     * Processes delete request.
     *     
     * @param int $id Unique DB identifier. 
     */
    public function delete($id);
    /**
     * Processes put request.
     */
    public function put();
}