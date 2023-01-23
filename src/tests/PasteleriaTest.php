<?php

declare(strict_types=1);

namespace src\tests;

include_once("./autoload.php");

use src\app\Pasteleria;
use PHPUnit\Framework\TestCase;

class PasteleriaTest extends TestCase
{
    public function testIncluirCliente()
    {
        $pasteleria = new Pasteleria("Pastelería");
        $pasteleria->incluirCliente("Peter");

        $this->assertArrayHasKey("Peter", $pasteleria->getClientes());
    }
}
