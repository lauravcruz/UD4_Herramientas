<?php

declare(strict_types=1);
namespace src\app;

include_once("./autoload.php");


class Tarta extends Dulce
{

    private $rellenos = [];
    public function __construct(
        string $nombre,
        int $numero,
        float $precio,
        private int $numPisos,
        //Por defecto son 2 comensales: 
        private int $minNumComensales = 2,
        private int $maxNumComensales = 2

    ) {
        parent::__construct($nombre, $numero, $precio);
    }

    public function getNumPisos(): int
    {
        return $this->numPisos;
    }

    public function setNumPisos($numPisos): void
    {
        $this->numPisos = $numPisos;
    }

    public function getMinNumComensales(): int
    {
        return $this->minNumComensales;
    }

    public function setMinNumComensales($minNumComensales): void
    {
        $this->minNumComensales = $minNumComensales;
    }

    public function getMaxNumComensales(): int
    {
        return $this->maxNumComensales;
    }

    public function setMaxNumComensales($maxNumComensales): void
    {
        $this->maxNumComensales = $maxNumComensales;
    }

    public function getRellenos()
    {
        return $this->rellenos;
    }

    public function setRellenos($rellenos): void
    {
        if (count($rellenos) == $this->getNumPisos()) {
            array_push($this->rellenos, $rellenos);
        } else {
            echo "Error: la tarta debe tener el mismo número de rellenos que de pisos";
        }
    }

    public function muestraComensalesPosibles()
    {
        if ($this->getMinNumComensales() == $this->getMaxNumComensales()) {
            echo "Para " . $this->getMaxNumComensales() . " comensales";
        } else {
            echo "Para entre " . $this->getMinNumComensales() . " y " . $this->getMaxNumComensales() . " comensales";
        }
    }

    public function muestraResumen(): void
    {
        echo parent::muestraResumen() . "<p>Número de pisos: " . $this->getNumPisos() . "</p>";
        print_r($this->getRellenos());
    }
}
