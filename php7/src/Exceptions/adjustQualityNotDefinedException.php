<?php

namespace App\Exceptions;

class adjustQualityNotDefinedException extends \Exception
{
    public function __construct($className)
    {
        $message = 'Adjust quality not defined in "' . $className . '"';
        parent::__construct($message);
    }
}