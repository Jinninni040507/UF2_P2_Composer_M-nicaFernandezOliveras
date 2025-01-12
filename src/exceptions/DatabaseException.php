<?php

namespace App\Exceptions;

class DatabaseException extends \Exception
{
    public $message;

    function __construct(string $message = "")
    {
        $this->message = $message;
    }
}
