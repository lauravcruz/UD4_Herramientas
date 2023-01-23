<?php

declare(strict_types=1);

namespace src\tests;

include_once("./autoload.php");

use src\app\Tarta;
use PHPUnit\Framework\TestCase;

class TartaTest extends TestCase
{
    public function testConstructor()
    {
        $tarta = new Tarta("Tarta de chocolate", 4, 20, 3, 5, 5);
        $this->assertSame($tarta->getNombre(), "Tarta de chocolate");
        $this->assertSame($tarta->getNumero(), 4);
        $this->assertSame($tarta->getPrecio(), 20.0);
    }

    public function testSetRellenos(){
        $tarta = new Tarta("Tarta de chocolate", 4, 20, 3, 5, 5);
        $tarta->setRellenos(["Vainilla", "Chocolate"]);
        $this->expectOutputString("Error: la tarta debe tener el mismo número de rellenos que de pisos"); 
    }
}
