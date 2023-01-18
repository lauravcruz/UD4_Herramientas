<?php

declare(strict_types=1);

namespace src\app;

include_once("./autoload.php");

use src\util\ClienteNoEncontradoException;
use src\util\DulceNoEncontradoException;
use src\util\LogFactory;
use Monolog\Logger;

class Pasteleria
{
    private Logger $log;
    private $productos = [];
    private $clientes = [];
    //numProductos y clientes devuelve el tamaño del array
    //private $numProductos;
    //private $numClientes;

    public function __construct(
        public $nombre,
    ) {
        $this->log = LogFactory::getLogger();
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNumProductos()
    {
        return count($this->productos);
    }

    public function getNumClientes()
    {
        return count($this->clientes);
    }

    public function incluirProducto(Dulce $producto)
    {
        array_push($this->productos, $producto);
    }

    public function incluirTarta($nombre, $precio, $numPisos, $minC, $maxC, $rellenos)
    {
        if (count($rellenos) != $numPisos) {
            echo "No es posible crear la tarta. Debe tener el mismo número de relleno que de pisos";
        } else {
            $tarta = new Tarta($nombre, $this->getNumProductos(), $precio, $numPisos, $minC, $maxC);
            $tarta->setRellenos($rellenos);
            $this->incluirProducto($tarta);
        }
    }
    public function incluirBollo($nombre, $precio, $relleno)
    {
        $bollo = new Bollo($nombre, $this->getNumProductos(), $precio, $relleno);
        $this->incluirProducto($bollo);
    }
    public function incluirChocolate($nombre, $precio, $porcentajeCacao, $peso)
    {
        $chocolate = new Chocolate($nombre, $this->getNumProductos(), $precio, $porcentajeCacao, $peso);
        $this->incluirProducto($chocolate);
    }

    public function incluirCliente($nombre)
    {
        $cliente = new Cliente($nombre, $this->getNumClientes());
        array_push($this->clientes, $cliente);
    }

    public function getClientes()
    {
        return $this->clientes;
    }

    public function getProductos()
    {
        return $this->productos;
    }

    public function listarProductos()
    {
        $listarProducto = "<p>PRODUCTOS: </p><ul>";
        foreach ($this->getProductos() as $producto) {
            $listarProducto .= "<li>$producto->nombre</li>";
        }
        $listarProducto .= "</ul>";
        echo $listarProducto;
    }
    public function listarClientes()
    {
        $listarCliente = "<p>CLIENTES: </p><ul>";

        foreach ($this->getClientes() as $cliente) {
            $listarCliente .= $cliente->muestraResumen();
        }
        $listarCliente .= "</ul>";
        echo $listarCliente;
    }

    public function comprarClienteProducto($numeroCliente, $numeroDulce)
    {
        $existeDulce = false;
        $clienteExiste = false;
        try {
            foreach ($this->getClientes() as $cliente) {
                if ($cliente->getNumero() == $numeroCliente) {
                    $c = $cliente;
                    $clienteExiste = true;
                }
            }
            if (!$clienteExiste) {
                $this->log->error("Cliente no encontrado", [$numeroCliente]);
                throw new ClienteNoEncontradoException("<p>Cliente no encontrado</p>");
            }
            foreach ($this->getProductos() as $dulce) {
                if ($dulce->getNumero() == $numeroDulce) {
                    $p = $dulce;
                    $existeDulce = true;
                    //Una vez encontrados ambos, realizamos la acción de comprar
                    if ($c->comprar($p)) {
                        echo "<p>Se ha realizado la compra</p>";
                    } else {
                        echo "<p>Error en la compra</p>";
                    }
                }
            }
            if (!$existeDulce) {
                $this->log->error("Dulce no encontrado", [$numeroDulce]);
                throw new DulceNoEncontradoException("<p>Dulce no encontrado</p>");
            }
        } catch (DulceNoEncontradoException $e) {
            echo $e->getMessage();
        } catch (ClienteNoEncontradoException $e) {
            echo $e->getMessage();
        }
    }
}
