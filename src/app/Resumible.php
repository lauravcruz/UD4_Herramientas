<?php
declare(strict_types=1);

namespace src\app;

interface Resumible
{
    /*No hace falta que las clases hijas de Dulce implementen muestraResumen() porque
    Dulce ya la implementa. Si un objeto de una clase hija de Dulce muestraResumen imprimirá
    la función definida en la clase padre Dulce*/
    public function muestraResumen(): void;
}
