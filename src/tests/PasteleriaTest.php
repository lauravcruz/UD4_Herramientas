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

        $this->assertSame("Peter", $pasteleria->getClientes()[0]->getNombre());
    }

    public function testListarClientes()
    {
        $pasteleria = new Pasteleria("Pastelería");
        $pasteleria->incluirCliente("Peter");

        $this->expectOutputString("<p>CLIENTES: </p><ul><li>Nombre: Peter</li>        \r\n            <ul><li>Número de pedidos efectuados: 0</li></ul></ul>");
        $pasteleria->listarClientes();
    }
}
