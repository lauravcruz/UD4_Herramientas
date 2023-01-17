<?php

declare(strict_types=1);
include_once("autoload.php");

class Bollo extends Dulce
{

    public function __construct(
        string $nombre,
        int $numero,
        float $precio,
        private string $relleno
    ) {
        parent::__construct($nombre, $numero, $precio);
    }

    public function getRelleno(): string
    {
        return $this->relleno;
    }


    public function setRelleno($relleno): void
    {
        $this->relleno = $relleno;
    }

    public function muestraResumen(): void
    {
        echo parent::muestraResumen() . "<p>Relleno: " . $this->getRelleno() . "</p>";
    }
}
