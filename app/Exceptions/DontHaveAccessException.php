<?php

namespace App\Exceptions;

use Exception;

class DontHaveAccessException extends Exception
{
    public function __construct($message = "You don't have ability to perform that task!") {
        parent::__construct($message);
    }
}
