<?php

declare(strict_types=1);
include_once("autoload.php");
use src\app\Chocolate;

$chocolate = new Chocolate("Chocolate negro", 3, 2, 84, 200);

$chocolate->muestraResumen();
