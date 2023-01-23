<?php

declare(strict_types=1);
include_once("autoload.php");
use src\app\Tarta;

$tarta = new Tarta("Tarta de chocolate", 4, 20, 3, 5, 5);

$rellenos = ["Vainilla", "Chocolate", "Nata"]; 
$tarta->setRellenos($rellenos);

$tarta->muestraResumen();

