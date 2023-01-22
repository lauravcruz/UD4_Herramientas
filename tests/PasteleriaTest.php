<?php

declare(strict_types=1);

namespace UD4_Herramientas\tests;

include_once("./src/app/Pasteleria.php");
include_once("./src/vendor/autoload.php");

use src\app\Pasteleria;
use PHPUnit\Framework\TestCase;
//PROBLEMA CON LAS RUTAS: no me encuentra LogFactory

class PasteleriaTest extends TestCase
{
    public function testIncluirCliente()
    {
        $pasteleria = new Pasteleria("Pastelería");
        $pasteleria->incluirCliente("Peter");

        $this->assertArrayHasKey("Peter", $pasteleria->getClientes());
    }
}
