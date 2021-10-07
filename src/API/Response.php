<?php

namespace App\API;

class Response
{   
    /**
     * Error request name holder.
     * 
     * @var string
    */
    protected const ERROR="Error";


    /**
     * Error message.
     * 
     * @var string
     */
    protected const ERROR_DISP="Request cant be done.";


    /**
     * Success request name holder.
     * 
     * @var string
     */
    protected const SUCCESS="Success";

    
    /**
     * Success message.
     * 
     * @var string
     */
    protected const SUCCESS_DISP="Request done.";  
    

    /**
     * Returns error message in json
     * 
     * @return [int,json]
     */
    public function error()
    {
        //error status code
        $response=404;

        //error message json encoding.
        $response_data=json_encode(
            array(
                self::ERROR =>self::ERROR_DISP
            ));
        return [$response,$response_data];
    }

    /**
     * Returns success message in json
     * 
     * @return [int,json]
     */
    public function success()
    {
        //success status code
        $response=200;
        
        //success message json encoding
        $response_data=json_encode(
            array(
                self::SUCCESS=>self::SUCCESS_DISP
            ));
        return [$response,$response_data];
    }
}