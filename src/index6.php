<?php

declare(strict_types=1);

include_once(__DIR__ . "/vendor/autoload.php");
include_once("autoload.php");
/*include_once("vendor/autoload.php");
include_once("app/autoload.php");
include_once("app/Pasteleria.php"); */

use src\app\Pasteleria;

//Lo único que cambia con la clase abstracta es que ya no podemos instanciar un dulce: 
//$dulce = new Dulce("dulce", 2, 4); 

$pasteleria = new Pasteleria("Pastelería");
$pasteleria->incluirCliente("Peter");
$pasteleria->incluirCliente("Dani");
$pasteleria->incluirCliente("Lui");
$pasteleria->incluirChocolate("Chocolate negro", 2, 84, 200);
$pasteleria->incluirBollo("Donut", 1.30, "Chocolate");
$pasteleria->incluirTarta("Tarta de chocolate", 20, 3, 5, 5, ["Vainilla", "Chocolate", "Nata"]);

$pasteleria->comprarClienteProducto(0, 0);
$pasteleria->comprarClienteProducto(0, 1);
$pasteleria->comprarClienteProducto(0, 2);
$pasteleria->comprarClienteProducto(1, 2);
$pasteleria->listarProductos();
$pasteleria->listarClientes();
$pasteleria->getClientes()[0]->listarPedidos();
$pasteleria->getClientes()[1]->listarPedidos();

//Probando excepciones: 
$pasteleria->comprarClienteProducto(100, 0);
$pasteleria->comprarClienteProducto(0, 500);
$pasteleria->getClientes()[2]->valorar($pasteleria->getProductos()[0], "No me gusta");
$pasteleria->getClientes()[0]->valorar($pasteleria->getProductos()[0], "Es mi favorito");
