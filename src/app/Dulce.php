<?php

declare(strict_types=1);

namespace src\app;

include_once("./autoload.php");
/* include_once("Resumible.php"); */

abstract class Dulce implements Resumible
{
    private const IVA = 0.21;

    public function __construct(
        public $nombre,
        protected $numero,
        private $precio
    ) {
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getPrecioConIva(): float
    {
        return $this->getPrecio() * (1 + self::IVA);
    }

    public function muestraResumen(): void
    {
        echo "<p>Nombre: $this->nombre</p>        
        <p>Precio: " . $this->getPrecio() . " euros</p>
        <p>Precio con IVA: " . $this->getPrecioConIva() . " euros</p>";
    }
}
