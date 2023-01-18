<?php

declare(strict_types=1);
include_once("autoload.php");
use src\app\Bollo;

$bollo = new Bollo("Donut", 2, 1.30, "Chocolate");

$bollo->muestraResumen();
