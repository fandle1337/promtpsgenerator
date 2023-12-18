<?php

namespace App\Exception;

class ExceptionPrompt extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}