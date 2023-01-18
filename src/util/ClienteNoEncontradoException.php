<?php

declare(strict_types=1);

namespace src\util;

use Exception;
use src\util\PasteleriaException;

class ClienteNoEncontradoException extends PasteleriaException
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
