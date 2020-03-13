<?php

namespace App\Exceptions;

use Exception;

class BasicInfoException extends Exception
{
    public function __construct($msg = '')
    {
        parent::__construct($msg);
    }
}
