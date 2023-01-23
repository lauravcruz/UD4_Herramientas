<?php

declare(strict_types=1);

namespace src\util;

include_once("./autoload.php"); 
/* include_once("PasteleriaException.php"); */

use Exception;

class PasteleriaException extends Exception
{
    public function __construct($msj, $codigo  = 0, Exception $previa = null)
    {
        parent::__construct($msj, $codigo, $previa);
    }
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
