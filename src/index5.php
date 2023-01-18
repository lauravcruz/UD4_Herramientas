<?php

declare(strict_types=1);
include_once("autoload.php");

use src\app\Pasteleria;
use src\app\Cliente;

$pasteleria = new Pasteleria("Pastelería");
$cliente = new Cliente("Peter", 1);
$cliente2 = new Cliente("Dani", 2);

$pasteleria->incluirCliente($cliente);
$pasteleria->incluirCliente($cliente2);
$pasteleria->incluirChocolate("Chocolate negro", 1, 84, 200);
$pasteleria->incluirBollo("Donut", 1.30, "Chocolate");
$pasteleria->incluirTarta("Tarta de chocolate", 20, 3, 5, 5, ["Vainilla", "Chocolate", "Nata"]);

$pasteleria->comprarClienteProducto(0, 1);
$pasteleria->comprarClienteProducto(0, 2);
$pasteleria->comprarClienteProducto(0, 4);
$pasteleria->comprarClienteProducto(1, 2);
$pasteleria->listarProductos();
$pasteleria->listarClientes();
$cliente->listarPedidos();
$cliente2->listarPedidos();
