<?php

declare(strict_types=1);

namespace tests;

include_once("src/autoload.php"); 
use src\app\Tarta;
use PHPUnit\Framework\TestCase;

class TartaTest extends TestCase
{
    public function testConstructor()
    {
        $tarta = new Tarta("Tarta de chocolate", 4, 20, 3, 5, 5);
        $this->assertSame($tarta->getNombre(), "Tarta de chocolate");
    }
}
