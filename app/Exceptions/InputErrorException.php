<?php

namespace App\Exceptions;

use Exception;

class InputErrorException extends Exception
{
    public function __construct($msg = '')
    {
        parent::__construct($msg);
    }
}
