<?php

namespace App\Exceptions;

class DatabaseException extends \Exception
{
    private $message;

    function __construct(string $message = "")
    {
        $this->message = $message;
    }
}
