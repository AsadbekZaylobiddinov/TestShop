<?php

namespace App\Helpers;

class ResponseBody
{
    public function __construct($statusCode, $message, $body){

        $this->statusCode = $statusCode;

        $this->message = $message;

        $this->body = $body;

    }

    public int $statusCode;

    public string $message;

    public $body;    

}